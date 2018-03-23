<?php  
	
	class LookerModel extends Model{

		/**
		 * 获取列表
		 * @author: zhibin1.xie
		 * @version 2016-12-13
		 * @return  [type]     [description]
		 */
		public function getList($where=array()){
			import('@.ORG.MyPage');
			$p = I('get.p',1,'intval');
			$count = $this->where($where)->count();
			$rows = 20;
			$page = new MyPage($count,$rows);
			$list = array();
			$list['data'] = $this->field()->where()->page($p,$rows)->order('id desc')->select();
			$list['page'] = $page->show();
			return $list;
		}

		/**
		 * 获取接口数据
		 * @author: zhibin1.xie
		 * @version 2016-12-13
		 * @param   integer    $maxResult [description]
		 * @return  [type]                [description]
		 */
		public function getDataFromApi($maxResult=20){
			set_time_limit(60);
			$p = 1;
			//$maxResult = 50; //最大支持50条

			$showapi_appid = '9898';  //替换此值
			$showapi_sign = '6ba8e6e25f6c47d790a123b271b9be5d';  //替换此值。
			$showapi_timestamp = date('YmdHis');
			$paramArr = array(
			     'showapi_appid'=> $showapi_appid,
			     'num' => $maxResult , //从这个时间以来最新的笑话.格式：yyyy-MM-dd
			     'page' => $p , //获取页数
			     'rand' => "", //每页获取多少
			    //'showapi_timestamp' => $this->showapi_timestamp
			    // other parameter
			);
			$sign = $this->_createParam($paramArr,$showapi_sign);
			//$strParam = $this->createStrParam($paramArr);
			//$strParam .= 'showapi_sign='.$sign;
			$url = 'http://route.showapi.com/197-1?'.$sign; 
			$result = file_get_contents($url);
			$result = json_decode($result,true);//var_dump($result);die;
			if($result['showapi_res_body']['code'] != 200)
			{
				return false;
			}
			foreach ($result['showapi_res_body']['newslist'] as $key => $val) {
				$imgArr = getimagesize($val['picUrl']);
				$data = array();
				if($imgArr[0]>=200){ //图片宽度按小于200则不采集
					$data['add_time'] = time();
					$data['picUrl'] = $val['picUrl'];
					$data['title'] = $val['title'];
					$data['description'] = $val['description'];
					$data['ctime'] = $val['ctime']; //表中增加了唯一索引
					$this->data($data)->add();
					//echo $this->_sql();die;
				}
			}
			return true;
		}

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
	         //echo "排好序的参数:".$signStr."<br>\r\n";
	         return $paraStr;
	    }
	}
?>