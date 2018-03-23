<?php
    include 'Include/websocket.class.php';
    include 'Include/File.class.php';
    $config = include('config.php');
    define('THE_ROOT',dirname(__FILE__));

    $userFile = THE_ROOT.'/Data/users.txt'; //用户记录
    $msgFile = THE_ROOT.'/Data/message.txt'; //聊天记录

    $config=array(
        'address'=>$config['server'],
        'port'=> $config['port'],
        'event'=>'WSevent',//回调函数的函数名
        'log'=>true,
    );
    $websocket = new websocket($config);
    $websocket->run();

    /**
     * [WSevent description]
     * @author: zhibin1.xie
     * @version 2016-12-28
     * @param   [type]     $type  [description]
     * @param   $event = array(k=>'用户id',sign=>'资源id','msg'=>'用户发送过来的消息')
     * @param   [用户id]=>array('socket'=>[标示],'hand'=[是否握手-布尔值]),
     */
    function WSevent($type,$event){
        global $websocket;
        global $msgFile;
        if($type == 'in'){ //用户连接
            access($websocket,$event);
        }elseif($type=='out'){ //用户退出
            quit($websocket,$event);
        }elseif($type=='msg'){
                $userList = array(
                    'status' => 5, //状态专用
                );
            if(substr($event['msg'], 0, 8)=='userList'){ //获取用户列表
                $username = substr($event['msg'], 8);
                updataUsers($websocket,$event,$username);
                addUserFile($username,$event['k']); //添加用户到文件
                $userList['users'] = getUsers($websocket);
                $userList['info'] = getUserName($websocket,$event['sign']).'('.$event['k'].')来了';
                //向所有用户发送当前的用户列表
                sendUsers($websocket,$userList);

                //想当前用户发送消息
                $cur_ev = array(
                    'status' => 6,
                    'info' => getUserName($websocket,$event['sign']).'('.$event['k'].')',
                    );
                $websocket->write($event['sign'],json_encode($cur_ev));
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


                $websocket->log($event['k'].'消息:'.$accapt['msg']); //print消息在cmd显示
                $username = usernameByFile($event['k']);
                File::save($msgFile,$username.'说:'.$accapt['msg']); //记录文件
                $data = array(
                    'status' => 1,
                    'info' => getUserName($websocket,$event['sign']).' 说:'.$accapt['msg'],
                    );
                if(empty($accapt['toUser'])){
                    foreach ($websocket->users as $key => $val) { //循环发给所有用户
                        $websocket->write($val['socket'],json_encode($data)); //返回消息给websocket
                        unset($key,$val);
                    }
                }else{
                    $data['info'] = getUserName($websocket,$event['sign']).' 对wo说:'.$accapt['msg'];
                    preg_match_all('/\((\d+)\)/', $accapt['toUser'],$arr_k);
                    $k = $arr_k[1][0];
                    $websocket->idwrite($k,json_encode($data)); //给对方发
                    $data['info'] = '你对'.$accapt['toUser'].' 说:'.$accapt['msg'];
                    $websocket->idwrite($event['k'],json_encode($data)); //给自己发
                    
                }

            }
          
        }
    }
    /**
     * 进入处理
     * @author: zhibin1.xie
     * @version 2016-12-29
     * @return  [type]     [description]
     */
    function access($websocket,$event){
        //把所有用户ID发送到前台
        $websocket->log('客户进入id:'.$event['k']);
    }

    function addUserFile($username,$k){
        global $userFile;
        //把用户存入文件
        $users = json_decode(File::read($userFile),true);
        $users[$k] = $username;
        File::save($userFile,$users,'w');
    }
    //获取所有用户
    function getUsers($websocket,$id=false){
        
        $users = array();
        foreach ($websocket->users as $key => $val) {
            $l_id = $websocket->search($val['socket']);
            if($l_id!==$id)
                $users[] = $val['username'].'('.$l_id.')';
        }

        return $users;
    }

    //退出
    function quit($websocket,$event){
        $websocket->log('客户退出id:'.$event['k']);

        //通知所有服务器
        $userList = array(
            'status' => 5,
            'users' => getUsers($websocket,$event['k']), //不包含即将退出的用户
            'info' => usernameByFile($event['k']).'('.$event['k'].')离开了',
            );
        sendUsers($websocket,$userList);
    }
    //更新用户列表
    function updataUsers($websocket,$event,$username){

        foreach ($websocket->users as $key => $val) {
            if($val['socket']==$event['sign'])
                $websocket->users[$key]['username'] = $username;
        }
 
    }
    //发送用户列表
    function sendUsers($websocket,$userList=array()){
        foreach ($websocket->users as $key => $val) {
            //处理users数组
            $list = $userList;
            foreach ($list['users'] as $k => $v) {
                if($v==$val['username'].'('.$k.')'){
                    unset($list['users'][$k]);
                }
                unset($k,$v);
            }
            File::save('Data/userLogin.txt', serialize($list).'-'.$val['username']."\r\n");

            $websocket->write($val['socket'],json_encode($list));
            unset($key,$val,$list);
        }
    }
    //返回指定用户的用户名
    function getUserName($websocket,$sign){
        foreach ($websocket->users as $key => $val) {
            
            if($sign==$val['socket'])
                return $val['username'];
        }
        return '游客';
    }
    //通过文件返回用户
    function usernameByFile($k){
        global $userFile;
        $users = json_decode(File::read($userFile),'true');
        if(isset($users[$k]))
            return $users[$k];
        else 
            return '游客';
    }
?>