<?php
	class ApiAction extends BaseAction{

		CONST SIGN_KEY = 'api.xwta';
		private $no_need = array('Wechat','Index');

		public function _initialize(){
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
	}
?>