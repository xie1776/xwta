<?php  
	
	class BallOrderModel extends Model{

		const PAY_STATUS_INIT = 1;
		CONST PAY_STATUS_SUCC = 2;
		/**
		 * 生成16位订单号 测试10w不重复
		 * @Author   zhibin
		 * @DateTime 2017-09-11
		 * @return   [type]     [description]
		 */
		private static function _getSN(){

			list($micro,$time) = explode(' ', microtime());
			$sec = $time - mktime(0, 0, 0, date('m'),date('d'));
			$sec = str_pad($sec, 5, '0', STR_PAD_LEFT);
			$msec = substr($micro, 2, 1);
			$rand = str_pad(rand(1,99999), 5, '0', STR_PAD_LEFT);
			$order_sn = date('yz').$sec.$msec.$rand;
			// $order_sn = date('yz').$sec.$rand;

			return $order_sn;
		}
		/**
		 * 投注下单
		 * @Author   zhibin
		 * @DateTime 2017-09-11
		 * @return   [type]     [description]
		 */
		public function createOrder($bet=array(),$user_id,$issue,$bet_times){

			$amount = calCount($bet,$bet_times) * 2; //每注2积分
			$sn = self::_getSN();
			$data = array(
				'order_sn' => $sn,
				'amount' => $amount,
				'pay_status' => 1,
				'add_time' => time(),
				'user_id' => $user_id,
				'issue' => $issue,
				'bet' => serialize($bet), //记录投注防止后面的出错
				'bet_times' => $bet_times,
				);

			$res = $this->data($data)->add();
			if($res){
				return $sn;
			}
			return false;
		}
		/**
		 * 某期中奖前5单
		 * @Author   zhibin
		 * @DateTime 2017-09-12
		 * @param    [type]     $issue [description]
		 * @return   [type]            [description]
		 */
		public function issueTop($issue){

			$where = array(
				'o.issue' => $issue,
				'o.win_amount' => array('gt',0),
				'o.pay_status' => 2,
				);
			$field = 'o.*,m.username';
			$list = M()->table('pa_ball_order o')->join('pa_member m on m.uid=o.user_id')->field($field)->where($where)->order('o.win_amount desc')->limit(5)->select();

			return $list;
		}
		/**
		 * 历史中奖前5单
		 * @Author   zhibin
		 * @DateTime 2017-09-12
		 * @return   [type]     [description]
		 */
		public function top(){
			
			$where = array(
				'o.win_amount' => array('gt',0),
				'o.pay_status' => 2,
				);
			$field = 'o.*,m.username';
			$list = M()->table('pa_ball_order o')->join('pa_member m on m.uid=o.user_id')->field($field)->where($where)->order('o.win_amount desc')->limit(5)->select();
	
			return $list;
		}
		/**
		 * 投注列表
		 * @Author   zhibin1
		 * @DateTime 2017-09-13
		 * @return   [type]     [description]
		 */
		public function getList($where=array(),$rows=20){
			
			import('ORG.Util.Page');
	        		$count = $this->where($where)->count();
	        		$page = new Page($count,$rows);

			$field = 'o.*,m.username,b.r_one,b.r_two,b.r_three,b.r_four,b.r_five,b.r_six,b.blue';
			$list = M()->table('pa_ball_order o')->join('pa_member m on m.uid=o.user_id')->join('pa_ball b on b.sn=o.issue')->field($field)->where($where)->order('o.id desc')->limit($page->firstRow,$rows)->select();
			// echo M()->_sql();die;
			foreach ($list as &$val) {
				$val['bet'] = mb_unserialize($val['bet']);
				if($val['r_one']){
					$val['bet_res'] = $val['r_one'].','.$val['r_two'].','.$val['r_three'].','.$val['r_four'].','.$val['r_five'].','.$val['r_six'].'+'.$val['blue'];
					$val['bet'] = win_hint($val['bet'],$val['bet_res']);
				}

			}
			return array('list'=>$list,'page'=>$page->show());
		}
		/**
		 * 统计表中所有的收入和支出
		 * @Author   zhibin1
		 * @DateTime 2017-09-16
		 * @return   [type]     [description]
		 */
		public function getTotal(){

			$where = array(
				'pay_status' => 2,
				);

			$result = $this->field('sum(amount) as income,sum(win_amount) as payout')->where($where)->select();
			return $result[0];
		}
		/**
		 * 统计每期收入和支出
		 * @Author   zhibin1
		 * @DateTime 2017-09-16
		 * @return   [type]     [description]
		 */
		public function countByIssue(){
			$where = array(
				'pay_status' => 2,
				);

			$list = $this->field('sum(amount) as income,sum(win_amount) as payout,issue')->where($where)->group('issue')->order('issue desc')->select();
			return $list;
		}
	}
?>