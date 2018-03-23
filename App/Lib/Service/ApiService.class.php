<?php  
	class ApiService{

		//创建参数(包括签名的处理)
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
	         $signStr .= $showapi_secret;
	         $sign = strtolower(md5($signStr));
	         $paraStr .= 'showapi_sign='.$sign;
	       
	         return $paraStr;
	    }
	    /**
	     * 聊天入口
	     * @author: zhibin1.xie
	     * @version 2016-12-22
	     * @param   [type]     $keyword [description]
	     * @return  [type]              [description]
	     */
	    public function chat($keyword,$userId=''){
	    	$showapi_appid = '29426';  
		    $showapi_secret = '37adc71658fd43b7bc548fc0ba3e981d';
		    $paramArr = array(
		         'showapi_appid'=> $showapi_appid,
		         'info'=> $keyword,
		         'userid'=> $userId, //
		         //添加其他参数
		    );

		    $param = $this->_createParam($paramArr,$showapi_secret);
    		$url = 'http://route.showapi.com/60-27?'.$param;
    		$result = self::_curl($url);
    		return $result;
	    }

	    /**
	     * 使用curl方法 保证请求可靠性
	     * @author: zhibin1.xie
	     * @version 2016-12-22
	     * @param   [type]     $url       [description]
	     * @param   string     $type      [description]
	     * @param   array      $post_data [description]
	     * @param   array      $header    [description]
	     * @return  [type]                [description]
	     */
	    private static function _curl($url, $type = 'GET',$post_data = array(), $header = array()){

	    	$curl = curl_init();
			curl_setopt($curl, CURLOPT_URL, $url);
			curl_setopt($curl, CURLOPT_TIMEOUT, 30);
			curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 30);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl,CURLOPT_REFERER,"http://www.laijiemi.cn/");

			if (!empty($header)) {
				curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
			}

			if($type == 'POST'){
				curl_setopt($curl, CURLOPT_POST, true);
				curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
			}

			$result = curl_exec($curl);
			curl_close($curl);
			return $result;
	    }
	}
?>