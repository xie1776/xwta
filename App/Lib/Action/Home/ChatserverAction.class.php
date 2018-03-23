<?php

/**
 * 聊天服务器
 */

class ChatserverAction extends BaseAction
{
	public $websocket = null;
	/**
	 * 后台进程及websocket入口
	 * @Author xiezhibin  <xiezhibin@yuanxin-inc.com>
	 * @Date   2018-03-23
	 * @return [type]     [description]
	 */
	public function index()
	{
		include APP_PATH."/Lib/Libs/Websocket.class.php";

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
            quit($this->websocket,$event);
        }elseif($type=='msg'){
                $userList = array(
                    'status' => 5, //状态专用
                );
            if(substr($event['msg'], 0, 8)=='userList'){ //获取用户列表
                
            } else {

            }
          
        }
	}

	public function access($event){
        //把所有用户ID发送到前台
        $this->websocket->log('客户进入id:'.$event['k']);
    }


}