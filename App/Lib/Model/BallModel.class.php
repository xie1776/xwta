<?php  
	class BallModel extends BaseModel
	{
		static $week_list = array('日','一','二','三','四','五','六');
		/**
		 * 查询数据
		 * @author: zhibin1.xie
		 * @version 2017-02-23
		 */
		public function addByApi($sn){

		    $showapi_appid = '32573';  //替换此值,在官网的"我的应用"中找到相关值
		    $showapi_secret = '47b6afaea0aa4533954e1510aba3dc8d';  //替换此值,在官网的"我的应用"中找到相关值
		    $paramArr = array(
		         'showapi_appid'=> $showapi_appid,
		         'code'=> "ssq",
		         'expect'=> $sn,
		         //添加其他参数
		    );
		    $param = $this->_createParam($paramArr,$showapi_secret);
		    $url = 'http://route.showapi.com/44-3?'.$param; 
		  
		    $result = file_get_contents($url);

		    $result = json_decode($result,true);
		    return $result;
		    
		}

		private function _createParam ($paramArr,$showapi_secret) {
	         $paraStr = "";
	         $signStr = "";
	         ksort($paramArr);
	         foreach ($paramArr as $key => $val) {
	             if ($key != '' && $val != '') {
	                 $signStr .= $key.$val;
	                 $paraStr .= $key.'='.urlencode($val).'&';
	             }
	         }
	         $signStr .= $showapi_secret;//排好序的参数加上secret,进行md5
	         $sign = strtolower(md5($signStr));
	         $paraStr .= 'showapi_sign='.$sign;//将md5后的值作为参数,便于服务器的效验
	         
	         return $paraStr;
	    }

	    /**
	     * 插入数据库
	     * @author: zhibin1.xie
	     * @version 2017-02-23
	     */
	    public function addNew($data=array()){
	    	$time = strtotime($data['time']);
	    	$week = date('w',$time);
	    	$lo = explode('+', $data['openCode']);
	    	$red = explode(',', $lo[0]);
	    	$newdata = array(
	    		'sn' => $data['expect'],
	    		'lottery_date' => date('Y-m-d',$time),
	    		'week' => self::$week_list[$week],
	    		'r_one' => $red[0],
	    		'r_two' => $red[1],
	    		'r_three' => $red[2],
	    		'r_four' => $red[3],
	    		'r_five' => $red[4],
	    		'r_six' => $red[5],
	    		'blue' => $lo[1],
	    		'add_time' => time(),
	    		);
	    	return $this->data($newdata)->add();
	    }
	    /**
	     * 获取最新一期的彩票
	     * @Author   zhibin
	     * @DateTime 2017-09-12
	     * @return   [type]     [description]
	     */
	    public function getNewBall(){
	    	$ball = $this->order('id desc')->limit(1)->find();
	    	return $ball;
	    }
	}
?>