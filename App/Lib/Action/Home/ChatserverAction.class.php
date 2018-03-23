<?php

/**
 * 聊天服务器
 */

class ChatserverAction extends BaseAction
{
	public $websocket = null;
	public $redis = null;
	const REDIS_KEY = 'chat_set';
	const REDIS_User_KEY = 'chat_user_string';
	/**
	 * 后台进程及websocket入口
	 * @Author xiezhibin  <xiezhibin@yuanxin-inc.com>
	 * @Date   2018-03-23
	 * @return [type]     [description]
	 */
	public function index()
	{
		include APP_PATH."/Lib/Libs/Websocket.class.php";
		include APP_PATH."/Lib/Libs/RedisMan.class.php";

		$server = C('CHAT');
		$config = [
	        'address' => $server['server'],
	        'port' => $server['port'],
	        'event' => 'WSevent',//回调函数的函数名
	        'obj' => 'ChatserverAction',
	        'log' => true,
	    ];

	    $this->websocket = new websocket($config);
    	$this->websocket->run();
	}

	public function WSevent($type,$event, $obj)
	{
		$this->websocket = $obj;
		if($type == 'in'){ //用户连接
            $this->access($event);
        }elseif($type=='out'){ //用户退出
            $this->quit($event);
        }elseif($type=='msg'){
                $userList = array(
                    'status' => 5, //状态专用
                );
            if(substr($event['msg'], 0, 8)=='userList'){ //获取用户列表
                $username = substr($event['msg'], 8);
                $this->updataUsers($event,$username);
                $this->addUserFile($username,$event['k']); //添加用户到文件
                $userList['users'] = $this->getUsers();
                $userList['info'] = $this->getUserName($event['sign']).'('.$event['k'].')来了';
                //向所有用户发送当前的用户列表
                $this->sendUsers($userList);

                //想当前用户发送消息
                $cur_ev = array(
                    'status' => 6,
                    'info' => $this->getUserName($event['sign']).'('.$event['k'].')',
                    );
                $this->websocket->write($event['sign'],json_encode($cur_ev));
            }
            /*
            else if($event['msg']=='me_quit'){ //有用户退出 更新所有客户端
                $userList['users'] = getUsers($websocket,$event['k']); //不包含即将退出的用户
                sendUsers($websocket,$userList);
            }
            */
            else{
                //用户发送是json消息
                $accapt = json_decode($event['msg'],true);

                $this->websocket->log($event['k'].'消息:'.$accapt['msg']); //print消息在cmd显示
                $username = $this->usernameByFile($event['k']);
                // File::save($msgFile,$username.'说:'.$accapt['msg']); //记录文件
                $data = array(
                    'status' => 1,
                    'info' => $this->getUserName($event['sign']).' 说:'.$accapt['msg'],
                    );
                if(empty($accapt['toUser'])){
                    foreach ($this->websocket->users as $key => $val) { //循环发给所有用户
                        $this->websocket->write($val['socket'],json_encode($data)); //返回消息给websocket
                        unset($key,$val);
                    }
                }else{
                    $data['info'] = $this->getUserName($event['sign']).' 对wo说:'.$accapt['msg'];
                    preg_match_all('/\((\d+)\)/', $accapt['toUser'],$arr_k);
                    $k = $arr_k[1][0];
                    $this->websocket->idwrite($k,json_encode($data)); //给对方发
                    $data['info'] = '你对'.$accapt['toUser'].' 说:'.$accapt['msg'];
                    $this->websocket->idwrite($event['k'],json_encode($data)); //给自己发
                    
                }

            }
          
        }
	}

	public function access($event){
        //把所有用户ID发送到前台
        $this->websocket->log('客户进入id:'.$event['k']);
    }

    public function addUserFile($username,$k){

       	$config = C('REDIS');
		$redis = new Redis();
		$redis->connect($config['server'], $config['port']);

        $redis->hSet(self::REDIS_KEY,$k,$usernameByFile);
        // $users = json_decode(File::read($userFile),true);
        // $users[$k] = $username;
        // File::save($userFile,$users,'w');
    }
    
    //获取所有用户
    public function getUsers($id=false){
        
        $users = array();
        foreach ($this->websocket->users as $key => $val) {
            $l_id = $this->websocket->search($val['socket']);
            if($l_id!==$id)
                $users[] = $val['username'].'('.$l_id.')';
        }

        return $users;
    }

    //退出
    public function quit($event){
        $this->websocket->log('客户退出id:'.$event['k']);

        //通知所有服务器
        $userList = array(
            'status' => 5,
            'users' => $this->getUsers($websocket,$event['k']), //不包含即将退出的用户
            'info' => $this->usernameByFile($event['k']).'('.$event['k'].')离开了',
            );
        $this->sendUsers($userList);
    }
    //更新用户列表
    public function updataUsers($event,$username){

        foreach ($this->websocket->users as $key => $val) {
            if($val['socket']==$event['sign'])
                $this->websocket->users[$key]['username'] = $username;
        }
 
    }
    //发送用户列表
    function sendUsers($userList=array()){
        foreach ($this->websocket->users as $key => $val) {
            //处理users数组
            $list = $userList;
            foreach ($list['users'] as $k => $v) {
                if($v==$val['username'].'('.$k.')'){
                    unset($list['users'][$k]);
                }
                unset($k,$v);
            }
            // File::save('Data/userLogin.txt', serialize($list).'-'.$val['username']."\r\n");
            $this->redisConnect();
            $this->redis->set(self::REDIS_User_KEY, serialize($list));
            $this->websocket->write($val['socket'],json_encode($list));
            unset($key,$val,$list);
        }
    }
    //返回指定用户的用户名
    public function getUserName($sign){
        foreach ($this->websocket->users as $key => $val) {
            
            if($sign==$val['socket'])
                return $val['username'];
        }
        return '游客';
    }
    //通过文件返回用户
    function usernameByFile($k){

        // $users = json_decode(File::read($userFile),'true');
        $this->redisConnect();
        $user = $this->redis->hGet(self::REDIS_KEY, $k);
        if(isset($user))
            return $user;
        else 
            return '游客';
    }

    public function redisConnect(){
    	$config = C('REDIS');
		$this->redis = new Redis();
		$this->redis->connect($config['server'], $config['port']);
    }

}