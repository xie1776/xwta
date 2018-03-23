<?php  
	//美女查看
	class LookerAction extends TouchAction{

		public function detail(){

			$id = I('get.id',0,'intval');
			$Looker = D('Looker');
			$where = array(
				'id' => $id,
				);

			$info  = $Looker->field()->where($where)->find();

			$this->assign('info',$info);
			$this->display('detail');
		}
	}
?>