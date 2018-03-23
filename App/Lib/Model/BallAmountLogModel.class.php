<?php
	/**
	 * 记录积分变化日志
	 */
	class BallAmountLogModel extends Model{

		//type
		const TYPE_INCOME = 1;
		const TYPE_PAYOUT = 2;
		static $type = array(
			self::TYPE_INCOME => '收入',
			self::TYPE_PAYOUT => '支出',
			);
		/**
		 * 通过下单创建一条日志
		 * @Author   zhibin
		 * @DateTime 2017-09-11
		 * @return   [type]     [description]
		 */
		public function createByOrder($sn){
			if(!$sn){
				return false;
			}
			$D = D('BallOrder');
			$order_info = $D->where(array('order_sn'=>$sn))->find();
			if($order_info['pay_status']!=BallOrderModel::PAY_STATUS_INIT){
				return false;
			}
			//事物处理
			//①扣除pa_member 余额 ②生成一条积分日志 ③订单更新为已支付
			$this->startTrans();
			$time = time();
			$res1 = M('member')->where(array('uid'=>$order_info['user_id']))->setDec('balance',$order_info['amount']);
			$res2 = $this->data(array('user_id'=>$order_info['user_id'],'amount'=>$order_info['amount'],'type'=>2,'issue'=>$order_info['issue'],'add_time'=>$time))->add();
			$res3 = $D->where(array('order_sn'=>$sn))->save(array('pay_status'=>BallOrderModel::PAY_STATUS_SUCC,'pay_time'=>$time));
			if($res1 && $res2 && $res3){
				$res = $this->commit();
			}else{
				$this->rollback();
			}
			return $res;
		}
		/**
		 * 通过中奖创建一条日志
		 * @Author   zhibin
		 * @DateTime 2017-09-21
		 * @return   [type]     [description]
		 */
		public function createByWin($sn){
			if(!$sn){
				return false;
			}
			$D = D('BallOrder');
			$order_info = $D->where(array('order_sn'=>$sn))->find();

			if($order_info['win_amount']>0){
				//事物处理
				//①增加pa_member 余额 ②生成一条积分日志 
				$this->startTrans();
				$time = time();
				$res1 = M('member')->where(array('uid'=>$order_info['user_id']))->setInc('balance',$order_info['win_amount']);
				$res2 = $this->data(array('user_id'=>$order_info['user_id'],'amount'=>$order_info['win_amount'],'type'=>1,'issue'=>$order_info['issue'],'remark'=>'中奖积分','add_time'=>$time))->add();
		
				if($res1 && $res2){
					$res = $this->commit();
				}else{
					$this->rollback();
				}
				return $res;
			}
			return false;
		}
		/**
		 * 获取用户的积分变化
		 * @Author   zhibin1
		 * @DateTime 2017-09-17
		 * @param    [type]     $user_id [description]
		 * @return   [type]              [description]
		 */
		public function getListByUserId($user_id){
			if(!$user_id){
				return false;
			}
			$where = array(
				'user_id' => $user_id,
				);
			import('ORG.Util.Page');
			$count = $this->where($where)->count();
			$rows = 20;
			$page = new Page($count,$rows);
			$list = $this->where($where)->limit($page->firstRow,$rows)->order('id desc')->select();
			if($list){
				foreach ($list as $key => &$val) {
					$val['type_str'] = self::$type[$val['type']];
					$val['pre'] = $val['type'] == self::TYPE_INCOME ? '<font color="green">+</font>' : '<font color="red">-</font>';
				}
			}

			return array('list'=>$list,'page'=>$page->show());
		}

		/**
		 * 通过注册用户添加日志
		 * @Author   zhibin
		 * @DateTime 2017-09-18
		 */
		public function addLog($user_id,$type=1,$remark='注册送50积分'){
			if(!$user_id){
				return false;
			}
			$data = array(
				'user_id' => $user_id,
				'amount' => 50,
				'type' => $type,
				'add_time'=>time(),
				'remark' => '注册送50积分',
			);
			return $this->data($data)->add();
		}
		/**
		 * 后台增加用户积分
		 * @Author   zhibin
		 * @DateTime 2017-09-21
		 * @return   [type]     [description]
		 */
		public function addBalanceByAdmin($uid,$balance){
			if(!$uid || !$balance){
				return false;
			}

			if($balance>0){
				//事物处理
				//①增加pa_member 余额 ②生成一条积分日志 
				$this->startTrans();
				$time = time();
				$res1 = M('member')->where(array('uid'=>$uid))->setInc('balance',$balance);
				$res2 = $this->data(array('user_id'=>$uid,'amount'=>$balance,'type'=>1,'remark'=>'后台增加','add_time'=>$time))->add();
		
				if($res1 && $res2){
					$res = $this->commit();
				}else{
					$this->rollback();
				}
				return $res;
			}
			return false;
		}


	}
?>