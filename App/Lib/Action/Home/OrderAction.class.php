<?php  
/**
 * 彩票订单
 */
class BallOrderAction extends LotteryAction
{

	/**
	 * 下单入口 同时进行支付 防止下单而不支付的刷单行为
	 * @Author   zhibin
	 * @DateTime 2017-09-11
	 * @return   [type]     [description]
	 */
	public function order()
	{
		if(IS_POST){
			$user = $this->userInfo;
			if(!session('isLogin') || !$user){
				$this->jsonReturn(0, '请先登录');
			}
			$bet = I('post.bet'); //数组，每个元素 格式 1,2,3,4,5,6+7
			$bet = array_map(function($val){
				$temp_arr = explode(' [', $val);
				return str_replace(array(' ','|'), array(',','+'), $temp_arr[0]);
			}, $bet);
			// var_dump($bet);die;
			if(!$bet){
				$this->jsonReturn(0,'参数错误: bet');
				die;
			}
			foreach ($bet as $b) {
				$b = explode('+', $b);
				$red = explode(',', $b[0]);
				$blue = explode(',', $b[1]);
				if(count($red)<6 || count($blue)<1){
					$this->jsonReturn(0,'每注彩票必须至少有6个红球和1个篮球');
					die;
				}
			}
			
			$bet_times = I('post.bet_times', 1, 'intval');
			$issue = $this->issue;
			$user_id = $user['uid'];
			$userInfo = D('Member')->field('uid,balance')->where(array('uid'=>$user_id))->find();
			// echo D('Member')->_sql();die;

			$order_amount = calCount($bet,$bet_times)*2;

			if($userInfo['balance']<$order_amount){
				$this->jsonReturn(0,'积分余额不足，无法下单');
				die;
			}

			$BallOrder = D('BallOrder');
			$sn = $BallOrder->createOrder($bet,$user_id,$issue,$bet_times);
			if($sn){
				$ballAmountLog = D('BallAmountLog');
				$res = $ballAmountLog->createByOrder($sn);
				if($res){
					$this->jsonReturn(1000,'投注成功',array('amount'=>$order_amount));die;
				}
			}
			$this->jsonReturn(0,'投注失败，别问为什么');
			die;
		}
	}
}
?>