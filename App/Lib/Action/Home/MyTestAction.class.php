<?php  
	class MyTestAction extends HomeAction{

		public function __construct(){
			$from_url = cookie('gz_from_host');
			echo $from_url;
			echo '<br/>';
			cookie('gz_from_host','abc',$expre,'http://www.xwta.net');
		}

		public function index(){
			$expre = 86400;
			if(cookie('gz_from_host')){
				echo cookie('gz_from_host');

			}
			cookie('gz_from_host','abc',$expre,'http://www.xwta.net');
			cookie('gz_from_host','abc',$expre,'http://www.xwta.net');
		}

		/**
		 * curl方法封装
		 * @author: zhibin1.xie
		 * @version 2017-03-14
		 * @return  [type]     [description]
		 */
		private function _curl(){
			
		} 

	}

?>