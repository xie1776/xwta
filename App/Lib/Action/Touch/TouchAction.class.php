<?php  
	/**
	 * 手机触屏版
	 */
	class TouchAction extends BaseAction{

		//手机页面 错误提示
		public function m_error($info='发生错误'){
			$this->assign('info',$info);
			$this->display('error');
			die;
		}

		
	}
?>