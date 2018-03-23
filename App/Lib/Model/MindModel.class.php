<?php  
	/**
	 * 智力问答
	 */
	class MindModel extends Model{

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
	         $signStr .= $showapi_secret;//排好序的参数加上secret,进行md5
	         $sign = strtolower(md5($signStr));
	         $paraStr .= 'showapi_sign='.$sign;//将md5后的值作为参数,便于服务器的效验
	         
	         return $paraStr;
	    }
	    /**
	     * 请求数据
	     * @return [type] [description]
	     */
	    public function getDataByApi($page=1){
	    	$showapi_appid = '33909';  //替换此值,在官网的"我的应用"中找到相关值
		    $showapi_secret = 'ffe7f249ccb441ba87c7130f0ac44f0b';  //替换此值,在官网的"我的应用"中找到相关值
		    $paramArr = array(
		         'showapi_appid'=> $showapi_appid,
		         'typeId'=> "njmy",
		         'keyword'=> "",
		         'page'=> $page,
		         //添加其他参数
		    );
		    $param = $this->_createParam($paramArr,$showapi_secret);
		    $url = 'http://route.showapi.com/151-4?'.$param; 
		    
		    $result = file_get_contents($url);
		    
		    // print $result;die;
		    $result = json_decode($result,true);
		    if(''==$result['showapi_res_error']){
		    	return $this->addData($result['showapi_res_body']['pagebean']['contentlist']);
		    }
		    
	    }
	    /**
	     * 添加数据
	     * @param array $data [description]
	     */
	    public function addData($data=array()){
	    	$ret = false;
	    	if(!empty($data)){
	    		foreach ($data as $key => $val) {
	    			$res = $this->where(array('title'=>$val['title']))->find();
	    			if($res)
	    				continue;
	    			else{
		    			$newData = array(
		    				'title' => $val['title'],
		    				'content' => $val['title'],
		    				'answer' => $val['answer'],
		    				'add_time' => time(),
		    				'type' => 1,
	 	    				);
		    			$ret = $this->data($newData)->add();
		    		}
	    		}
	    	}
	    	return $ret;
	    }
	    /**
	     * 返回数据列表
	     * @param  array  $where [description]
	     * @return [type]        [description]
	     */
	    public function getList($where=array()){
	    	import('ORG.Util.Page');
	    	$count = $this->where($where)->count();
	    	$rows = 20;
	    	$p = I('get.p',1,'intval');
	    	$page = new Page($count,$rows);
	    	$data = array();
	    	$data['list'] = $this->where($where)->order('id desc')->page($p,$rows)->select();
	    	$data['page'] = $page->show();
	    	return $data; 
	    }
	    
	}
?>