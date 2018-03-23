<?php  
	class BaseAction extends Action{
		
		/**
		 * json返回
		 * @author zhibin1
		 * @version 2016-09-22
		 * @return  [type]     [description]
		 */
		public function jsonReturn($status=0,$info='',$data=array()){
			error_reporting(0);
			$arr = array(
				'status' => $status,
				'info' => $info,
				'data' => $data,
				);

			echo json_encode($arr);die;
		}
	}
?>