<?php  
	class IndexAction extends LotteryAction{

		/**
		 * 投注首页
		 * @Author   zhibin
		 * @DateTime 2017-09-11
		 * @return   [type]     [description]
		 */
		public function index(){
			
			$Ball = D('Ball');
			$lot = $Ball->getNewBall(); //最近的一条开奖数据
			$BallOrder  = D('BallOrder');

			//最近一期中奖排行
			$issueTop = $BallOrder->issueTop($lot['sn']);
			$this->assign('issueTop',$issueTop);
			//历史中奖排行
			$top = $BallOrder->top();
			$this->assign('top',$top);

			$give = array(
				'reg' => C('REG_POINT'),
				'login' => C('LOG_POINT'),
				);

			$issue = $this->issue;

			$this->assign('give',$give);
			$this->assign('lot',$lot);
			$this->assign('userInfo',$this->userInfo);
			$this->assign('issue',$issue);
			$this->display('index');
		}

		public function indexV2(){
			if(IS_POST){
				$this->success('投注成功','index2');die;
			}
			$this->display('index2');
		}

	}
?>