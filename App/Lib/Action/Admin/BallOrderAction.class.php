<?php  
	class BallOrderAction extends CommonAction{
		/**
		 * 投注列表
		 * @Author   zhibin1
		 * @DateTime 2017-09-13
		 * @return   [type]     [description]
		 */
		public function index(){

			$model = D('BallOrder');
			$list = $model->getList();

			$this->assign('list',$list['list']);
			$this->assign('page',$list['page']);
			$this->display();
		}

		/**
		 * 彩票财务
		 * @Author   zhibin1
		 * @DateTime 2017-09-16
		 * @return   [type]     [description]
		 */
		public function income(){

			$model = D('BallOrder');

			$total = $model->getTotal(); //统计所有的收支
			$list = $model->countByIssue(); //统计每期收支

			$this->assign('total',$total);
			$this->assign('list',$list);
			$this->display();
		}
	}
?>