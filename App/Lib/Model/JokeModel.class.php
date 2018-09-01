<?php  
	class JokeModel extends Model{
		const TYPE_IMG = 2; //图片
		const TYPE_WORD = 1; //文字


		private function createSign ($paramArr) {
		     $sign = "";
		     ksort($paramArr);
		     foreach ($paramArr as $key => $val) {
		         if ($key != '' && $val != '') {
		             $sign .= $key.$val;
		         }
		     }
		     $sign.=$this->showapi_sign;
		     $sign = strtoupper(md5($sign));
		     return $sign;
		}

		private function createStrParam ($paramArr) {
		     $strParam = '';
		     foreach ($paramArr as $key => $val) {
		     if ($key != '' && $val != '') {
		             $strParam .= $key.'='.urlencode($val).'&';
		         }
		     }
		     return $strParam;
		}
		//从接口获取数据 并存入到数据库
		/**
		 * 返回数据格式
		 * [showapi_res_body] => Array
         *(
         *   [allNum] => 8831
         *  [allPages] => 442
         *   [contentlist] => Array
         *       (
         *           [0] => Array
         *               (
         *                   [ct] => 2015-09-17 13:10:26.489
         *                   [img] => http://img.hao123.com/data/3_db8414a69bbb940783320d7e8a3c561a_0
         *                   [title] => 打一顿就好了
         *                   [type] => 2
         *               )
		 */
		public function getDataFromApi($maxResult=20)
		{
			set_time_limit(60);
			$p = 1;
			//$maxResult = 50; //最大支持50条

			$this->showapi_appid = '9423';  //替换此值
			$this->showapi_sign = 'f773e13dd1de4a898d838386eaa93107';  //替换此值。
			$this->showapi_timestamp = date('YmdHis');
			$paramArr = array(
			     'showapi_appid'=> $this->showapi_appid,
			     'time' => '' , //从这个时间以来最新的笑话.格式：yyyy-MM-dd
			     'page' => $p , //获取页数
			     'maxResult' => $maxResult, //每页获取多少
			     'showapi_timestamp' => $this->showapi_timestamp
			    // other parameter
			);
			$sign = $this->createSign($paramArr);
			$strParam = $this->createStrParam($paramArr);
			$strParam .= 'showapi_sign='.$sign;
			$url = 'http://route.showapi.com/341-2?'.$strParam; 
			$result = file_get_contents($url);
			$result = json_decode($result,true);//var_dump($result);die;
			if($result['showapi_res_code'] != 0)
			{
				return false;
			}
			foreach ($result['showapi_res_body']['contentlist'] as $key => $val) {
				$imgArr = getimagesize($val['img']);
				$data = array();
				if($imgArr[0]>=200){ //图片宽度按小于200则不采集
					$data['add_time'] = time();
					$data['img'] = $val['img'];
					$data['title'] = $val['title'];
					$data['ct'] = $val['ct'];
					$data['type'] = $val['type'];
					$this->data($data)->add();
				}
			}
			return true;
		}
		/**
		 * 搞笑文字
		 * @param  integer $maxResult [description]
		 * @return [type]             [description]
		 */
		public function getJokeWordApi($maxResult=20)
		{
			set_time_limit(60);
			$p = 1;
			//$maxResult = 50; //最大支持50条

			$this->showapi_appid = '9423';  //替换此值
			$this->showapi_sign = 'f773e13dd1de4a898d838386eaa93107';  //替换此值。
			$this->showapi_timestamp = date('YmdHis');
			$paramArr = array(
			     'showapi_appid'=> $this->showapi_appid,
			     'time' => '' , //从这个时间以来最新的笑话.格式：yyyy-MM-dd
			     'page' => $p , //获取页数
			     'maxResult' => $maxResult, //每页获取多少
			     'showapi_timestamp' => $this->showapi_timestamp
			    // other parameter
			);
			$sign = $this->createSign($paramArr);
			$strParam = $this->createStrParam($paramArr);
			$strParam .= 'showapi_sign='.$sign;
			$url = 'http://route.showapi.com/341-1?'.$strParam; 
			$result = file_get_contents($url);
			$result = json_decode($result,true);//var_dump($result);die;
			if($result['showapi_res_code'] != 0)
			{
				return false;
			}
			foreach ($result['showapi_res_body']['contentlist'] as $key => $val) {
				//$imgArr = getimagesize($val['img']);
				$data = array();
				if(!empty($val['text'])){ //笑话内容不能为空
					$data['add_time'] = time();
					//$data['img'] = $val['img'];
					$data['content'] = $val['text'];
					$data['title'] = $val['title'];
					$data['ct'] = $val['ct'];
					$data['type'] = $val['type'];
					$this->data($data)->add();
					file_put_contents('sql.txt', $this->_sql()."\n");
				}
			}
			return true;
		}
		/**
		 * 读取文字+图片 各5条
		 * @author: zhibin1.xie
		 * @version 2017-03-09
		 * @return  [type]     [description]
		 */
		public function getJokeAword($p=1,$rows=5,$type=1){
			//$p = $p-1;
			$wordList = $this->where(array('type'=>self::TYPE_WORD))->order('id asc')->page($p,$rows)->select();
			if(2==$type){
				$lookerList = $this->where(array('type'=>self::TYPE_IMG))->order('id asc')->page($p,$rows)->select();
			} else {
				$lookerList = M('looker')->order('id asc')->page($p,$rows)->select();
			}
			//dump($lookerList);die;
			$list = array();
			$n = 0;
			for ($i=0; $i < 5; $i++) {
				$list[$n] = $lookerList[$i];
				$list[$n+1] = $wordList[$i];
				$n = $n+2;
			}
			return $list;
		}
		/**
		 * 获取列表
		 * @return [type] [description]
		 */
		public function getList($where=array(),$p=1,$rows=20, $module='home/index/index/p/'){
			import('ORG.Util.Page');
			$count = $this->where($where)->count();
			$page = new Page($count,$rows,'', $module);
			$data = array();
			$data['list'] = $this->where($where)->page($p,$rows)->order('id desc')->select();
			$data['page'] = $page->show();
			return $data;
		}

		/**
		 * 通过来福岛更新数据 每天更新一次
		 * @Author   zhibin1
		 * @DateTime 2017-03-21
		 * @return   [type]     [description]
		 */
		public function updateByLaifudao(){
			$res = false;
			$url_w = 'http://api.laifudao.com/open/xiaohua.json'; //文字
			$url_img = 'http://api.laifudao.com/open/tupian.json';//图片
			
			$json = curlGet($url_w);
			$arr = self::_toArr($json);

			$data = array();
			
			foreach ($arr as $key => $val) {
				$data['title'] = $val['title'];
				$val['poster'] && $data['img'] = $val['poster'];
				$data['content'] = $val['content'];
				$data['add_time'] = time();
				$data['type'] = self::TYPE_WORD;
				$data['source'] = 'laifudao';

				$res = $this->data($data)->add();
			}
			
			//处理图片
			$json = curlGet($url_img);
			$arr = self::_toArr($json);
			$data = array();
			// dump($arr);die;
			foreach ($arr as $key => $val) {
				$data['title'] = $val['title'];
				//$val['poster'] && $data['img'] = $val['poster'];
				$data['img'] = $val['thumburl'];
				$data['add_time'] = time();
				$data['type'] = self::TYPE_IMG;
				$data['source'] = 'laifudao';

				$res = $this->data($data)->add();
			}
			return $res;
		}

		/**
		 * 把错误的json格式转换成数组
		 * @Author   zhibin1
		 * @DateTime 2017-03-21
		 * @param    [type]     $str [description]
		 * @return   [type]          [description]
		 */
		private static function _toArr($str){

			$count = mb_strlen($str,'UTF-8');
			$str = mb_substr($str, 3,($count-3),'UTF-8'); 
			$str = mb_substr($str,0,-3,'UTF-8');
			$arr = explode('},{', $str);
			$ret = array();
			foreach ($arr as $key => $val) {
				$val = explode('","', $val); //var_dump($val);die;
				//$val = array_filter($val);
				foreach ($val as $k => $v) {
					$v = trim($v,'"');
					$v = explode('":', $v); 
					$v[0] = trim($v[0],'"');
					$v[1] = trim($v[1],'"');
					$ret[$key][$v[0]] = $v[1];
				}
				
			}
			return $ret;
		}



	}
?>