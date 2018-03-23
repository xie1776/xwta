<?php  
	
	class CrondAction extends LotteryAction{
		/**
		 * 开奖结果统计 每周一 三 五 7:30执行 
		 * 30 7 * * 1,3,5 /usr/bin/curl http://lottery.xwta.net/Crond/LottCount
		 * @Author   zhibin
		 * @DateTime 2017-09-11
		 */
		public function LottCount(){

			// $lot = ['red'=>'1,6,7,18,23,29','blue'=>'2']; //开奖结果
			// $bet = ['red'=>'1,6,7,8,18,23,24','blue'=>'2,12,15']; //投注结果
			
			$lot_new = M('ball')->order('id desc')->limit(1)->find();
			$lot = array(
				'red' => $lot_new['r_one'].','.$lot_new['r_two'].','.$lot_new['r_three'].','.$lot_new['r_four'].','.$lot_new['r_five'].','.$lot_new['r_six'],
				'blue' => $lot_new['blue'],
				);

			$BallOrder = D('BallOrder');
			$limit = 10;
			$where = array(
				'issue'=>$lot_new['sn'],
				'is_finish' => 1,
				'pay_status' => BallOrderModel::PAY_STATUS_SUCC,
				// 'add_time' => array('gt',strtotime($lot_new['lottery_date'].' '.C('STOP_TIME'))), //投注时间必须在开奖时间之前
				);

			$config = C('EMAIL');
			$to = array(
				'email' => 'zhibin3@qq.com',
				'name' => '管理员',
				'title' => '有人中大奖了',
				'content' => '',
				);
			$bet_count = array(
				'count' => 0,
				'amount' => 0,
				);
			while (true) {
				//循环执行 知道所有都统计结束
				$list = $BallOrder->field('id,order_sn,bet,bet_times')->where($where)->limit($limit)->order('id asc')->select();
				if(!$list){
					break;
				}
				foreach ($list as $key => $val) {
					$bets = mb_unserialize($val['bet']);
					$amount = $this->calAmount($bets,$lot);
					$amount = $amount * $val['bet_times']; //乘以投注倍数
					$updata = array(
						'win_amount'=>$amount,
						'win_time' => time(),
						'is_finish' =>-1,
						);
					$BallOrder->where(array('id'=>$val['id']))->limit(1)->save($updata);
					if($amount>0){ //中奖改余额
						D('BallAmountLog')->createByWin($val['order_sn']);
						// echo D('BallAmountLog')->_sql();echo '<br/>';
					}
					if($amount>=3000){ //邮件提现
						$bet_count['count'] += 1;
						$amount>$bet_count['amount'] ? $bet_count['amount'] = $amount : '';
					}
				}
			}

			//最后发送邮件
			if($bet_count['count']>0){
				error_reporting(E_ALL);
				$to['content'] = '请注意！有'.$bet_count['count'].'人中了3000以上积分，最高中奖积分：'.$bet_count['amount'];
				$res = send_mail($to['email'], $to['name'], $to['title'], $to['content'], "", $config);
				echo $res === true ? '发送成功' : $res;
			}

		}

		/**
		 * 计算中奖额
		 * @Author   zhibin
		 * @DateTime 2017-09-11
		 * @param bet 二维数组
		 * @return   [type]     [description]
		 */
		private function calAmount($bets,$lot){
			if(!is_array($bets)){
				return false;
			}
			$award = C('AWARD');
			$amount = 0;
			foreach ($bets as $bet) {

				$bet = explode('+', $bet);
				//计算中奖结果 红球计算方式 数组交集的个数
				$lot_red = explode(',', $lot['red']);
				$lot_red = array_map('intval', $lot_red);
				$bet_red = explode(',', $bet[0]);
				$bet_red = array_map('intval', $bet_red);
				$red_count = count(array_intersect($lot_red, $bet_red));
				$blue_result = in_array($lot['blue'], explode(',', $bet[1])) ? true : false;
				$result = 0;
				//中奖判断
				if(!$blue_result){ //篮球未中
					switch ($red_count) {
						case 4:
							$result = 5;
							break;
						case 5:
							$result = 4;
							break;
						case 6:
							$result = 2;
							break;
						default:
							$result = 0;
							break;
					}
				}else{ //篮球中了
					switch ($red_count) {
						case 3:
							$result = 5;
							break;
						case 4:
							$result = 4;
							break;
						case 5:
							$result = 3;
							break;
						case 6:
							$result = 1;
							break;
						default:
							$result = 6;
							break;
					}				
				}
				$amount += $award[$result];
			}

			return $amount;
		}


	}
?>