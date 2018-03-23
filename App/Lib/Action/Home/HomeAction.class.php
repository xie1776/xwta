<?php  
	//前台基类
	class HomeAction extends BaseAction{

		/**
		 * 构造方法
		 * @author: zhibin1.xie
		 * @version 2016-12-22
		 */
		public function __construct(){

			parent::__construct();
			$this->recordVis(); //记录访问
		}

		/**
		 * 记录访问
		 * @author: zhibin1.xie
		 * @version 2016-12-22
		 * @return  [type]     [description]
		 */
		public function recordVis(){
			//echo '<pre>';print_r($_SERVER);die;
			$clientIp = get_client_ip();
			//设置缓存 每个ip 5s记录一次
			$cache = Cache::getInstance();
			$key = str_replace('.', '_', $clientIp);
			$num = $cache->get($key);

			if(!$num){
				$userAgent = $_SERVER['HTTP_USER_AGENT'];
				$requestUrl = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

				$Vis = M('vis');
				$data = array(
					'client_ip' => $clientIp,
					'add_time' => time(),
					'request_url' => $requestUrl,
					);
				if(!empty($userAgent)) $data['user_agent'] = $userAgent;

				$res = $Vis->data($data)->add();
				//echo $Vis->_sql();die;
				$cache->set($key,($num+1),5);
			}

			//ip访问限制
			$forbid = explode(',', file_get_contents(WEB_ROOT.C('FORBID_FILE')));
			$flag = false;
			//兼容ip网段模式
			foreach ($forbid as $val) {
				if(strpos($val, '*')!==false){
					$cli = substr($clientIp, 0, strrpos($clientIp, '.'));//echo $cli;die;
					if($cli==rtrim($val,'.*')) $flag = true;
				}else{
					if($clientIp==$val) $flag = true;
				}
			}
			unset($forbid,$val);

			if($flag){
				header('content-type:text/html;charset=utf-8');
				echo '<h2>禁止访问</h2>';die;
			}

		}


	}
?>