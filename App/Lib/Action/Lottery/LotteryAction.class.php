<?php  
	class LotteryAction extends BaseAction{
		protected $userInfo = ''; //用户信息
		protected $issue = ''; //当前期数

		public function __construct(){
			parent::__construct();
			$this->issue();
			$this->isLogin();
		}
		/**
		 * 获取当前期数
		 * @Author   zhibin
		 * @DateTime 2017-09-12
		 * @return   [type]     [description]
		 */
		public function issue(){
			$ball = D('Ball')->getNewBall();
			$c_issue = $ball['sn'];
			$week = date('w');
			$time = date('H:i');
			$date = date('d');
			$month = date('m');
			$year = date('Y');

			$stop_week = C('STOP_WEEK');
			$stop_time = C('STOP_TIME');

			if(in_array($week, $stop_week) && $time>=$stop_time){
				$issue = $c_issue + 2;
			}else{
				$issue = $c_issue + 1;
			}

			$remain = 31-$date; //12月离年底的天数
			if($month == 12 && $remain<3){
				if($week==4 || ($remain<2) && in_array($week, array(0,2))){
					if(in_array($week, $stop_week) && $time>=$stop_time){
						$issue = (date('Y')+1).'002';
					}else{
						$issue = (date('Y')+1).'001';
					}
				}
			}

			$this->issue = $issue;
		}
		/**
		 * 判断是否登录
		 * @Author   zhibin
		 * @DateTime 2017-09-12
		 * @return   boolean    [description]
		 */
		public function isLogin(){
			if(session('isLogin')){
				$userInfo = session('userInfo');
				$User = D('Member');
				$userInfo = $User->field('*')->find($userInfo['uid']);
				$this->userInfo = $userInfo;
			}
		}
	}
?>