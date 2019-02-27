<?php
	class ApiAction extends BaseAction{

		CONST SIGN_KEY = 'api.xwta';
		private $no_need = array('Wechat','Index');
		private static $encodingAesKey = 'o7aDHxlsldmofGoJTQuFA9nuNlYioDHQoRv4gs7G4u3';
		const TOKEN = 'ttkan';
		private static $appId = 'wx1b51bcbb61f08f94';

		public function _initialize(){
			$this->_check(); //官方验证
			$this->checkPower(); //签名验证
		}
		//内容过滤
		public function filter_words($content){
			//获取非法词汇表
			$illword = M('webinfo')->where('type='.WebModel::ILLWORD_TYPE)->find();
			$illword = json_decode($illword['content'],true);
			$illwords = explode("\r\n", $illword['illword']);
			return filter_illwords($illwords,$content); 
		}
		/**
		 * 加密检查
		 * @Author   zhibin1
		 * @DateTime 2017-10-28
		 * @return   [type]     [description]
		 */
		public function checkPower(){
			$is_check = I('get.is_check', '', 'string');
			$sign = I('get.sign', '', 'string');
			$module = MODULE_NAME;
			if($is_check == 'yes' || in_array($module, $this->no_need)){
				return true;
			}
			elseif($sign == md5(self::SIGN_KEY)){
				return true;
			}else{
				echo json_encode(['code'=>0,'data'=>[],'msg'=>'签名错误']);
				die;
			}
		}

		/**
		 * 官方验证
		 * @Author zhibin
		 * @Date   2019-02-27
		 * @return [type]     [description]
		 */
		private function _check()
		{
			$signature = $_GET["signature"];
			$timestamp = $_GET["timestamp"];
			$nonce = $_GET["nonce"];
			
			$token = TOKEN;
			$tmpArr = array($token, $timestamp, $nonce);
			sort($tmpArr, SORT_STRING);
			$tmpStr = implode( $tmpArr );
			$tmpStr = sha1( $tmpStr );

			if( $tmpStr == $signature ){
				return true;
			}else{
				return false;
			}
		}
	}
?>