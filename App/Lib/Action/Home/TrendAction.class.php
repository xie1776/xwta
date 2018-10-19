<?php  
	/**
	 * 彩票分析模块
	 */
class TrendAction extends BaseAction
{
	/**
	 * 红1球分析
	 * @author: zhibin1.xie
	 * @version 2017-02-23
	 * @return  [type]     [description]
	 */
	public function index(){
		$sn = I('param.sn','','string');
		$this->assign('search',$_GET);
		$Ball = D('Ball');

		if(!$sn){
			$info  = $Ball->order('id desc')->find();
		}else{
			$info = $Ball->where(array('sn'=>$sn))->find();
		}
		// dump($info);die;
		$next_info = $Ball->where(array('id'=>array('gt',$info['id'])))->order('id asc')->limit(1)->find();
		$this->assign('next',$next_info);

		//红1分析
		$one = $this->_statOne(array('r_one','r_two'),array('r_one'=>$info['r_one']));
		// $one_serial = $Ball->statOne($one['r_one']);
		$one['count'] = $Ball->where(array('r_one'=>$info['r_one']))->count();
		$this->assign('one',$one);

		//红6分析
		$six = $this->_statOne(array('r_five','r_six'),array('r_six'=>$info['r_six']));
		$six['count'] = $Ball->where(array('r_six'=>$info['r_six']))->count();
		$this->assign('six',$six);
		//dump($six);die;

		//篮球分析
		$blue = array();
		$blue['list'] = $this->_statOne('blue',array('blue'=>$info['blue']));
		$blue['count'] = $Ball->where(array('blue'=>$info['blue']))->count();
		$this->assign('blue',$blue);

		//统计所有期号
		$sn_list = $Ball->field('sn')->order('id desc')->select();
		$this->assign('sn_list',$sn_list);

		//上一期
		$pre_sn = $Ball->where('id<'.$info['id'])->order('id desc')->limit(1)->getField('sn');
		$this->assign('pre_sn',$pre_sn);

		$this->assign('info',$info);
		$this->display('index');
	}

	/**
	 * 刷周几
	 * @author: zhibin1.xie
	 * @version 2017-02-23
	 * @return  [type]     [description]
	 */
	public function brushWeek(){
		die('exit');
		ini_set('memory_limit', '256M');
		set_time_limit(180);
		$week_list = array('日','一','二','三','四','五','六');
		
		$Ball = M('ball');
		$list = $Ball->field('sn,lottery_date')->select();
		$where = array();
		foreach ($list as $key => $val) {
			$where['sn'] = $val['sn'];
			$time = strtotime($val['lottery_date']);
			$data = array(
				'lottery_date' => date('Y-m-d',$time),
				'week' => $week_list[date('w',$time)],
				);
			$Ball->where($where)->limit(1)->save($data);
			//break;
		}
	}

	/**
	 * 统计函数
	 * @author: zhibin1.xie
	 * @version 2017-02-23
	 * @param   [type]     $field [description]
	 * @param   [type]     $val   [description]
	 * @return  [type]            [description]
	 */
	private function _statOne($field,$where){
		if(empty($field) || empty($where)){
			return false;
		}
		$Ball = M('ball');
		$list = $Ball->field('id')->where($where)->select();
		$r_one = array();
		$r_two = array();
		foreach ($list as $key => $val) {
			$info = $Ball->field($field)->where('id>'.$val['id'])->order('id asc')->limit(1)->find();
			if($info){
				if(is_array($field)){
					$r_one[] = $info[$field[0]];
					$r_two[] = $info[$field[1]];
				}else{
					$r_one[] = $info[$field];
				}
			}
		}
		if(is_array($field)){
			$data = array();
			$data[$field[0]] = array_count_values($r_one);
			$data[$field[1]] = array_count_values($r_two);
			arsort($data[$field[0]]);
			arsort($data[$field[1]]);
		}else{
			$data = array_count_values($r_one);
			arsort($data);
		}
		return $data;
	}
	/**
	 * 从接口更新数据
	 * @author: zhibin1.xie
	 * @version 2017-02-23
	 * @return  [type]     [description]
	 */
	public function update(){
		set_time_limit(180);
		$Ball = D('Ball');
		$sn = $Ball->order('id desc')->limit(1)->getField('sn');
		for ($i=$sn+1; $i < 2020153; $i++) { 

			$result = $Ball->addByApi($i);
			// dump($result);die;
			if($result['showapi_res_body']['result']){
		    	$Ball->addNew($result['showapi_res_body']['result']);
		    }else{
		    	$after = substr($i, -3);
		    	$front = substr($i,0,4);
		    	if($after=='153' || $after=='154' || $after=='152'){
		    		//echo $after.'-'.$front;die;
		    		$i = ($front+1).'000';
		    	}else{
		    		die('exit');
		    	}
		    }
		    //die;
		    sleep(1);
		}
		
	}
	/**
	 * 手动添加数据
	 * @return [type] [description]
	 */
	public function addate()
	{
		if(IS_POST){
			$sn = I('post.sn','');
			$lottery = I('post.lottery','');
			$lottery_date = I('post.lottery_date','');
			if(!$sn || !$lottery || !$lottery_date){
				$this->error('数据不能为空');die;
			}
			$time = strtotime($lottery_date);
			$lottery_date = date('Y-m-d',$time);
			$week = date('w',$lottery_date);
			$l = explode('+', $lottery);
			$lo = explode(',', $l[0]);
			$data = array(
				'sn' => $sn,
				'r_one' => $lo[0],
				'r_two' => $lo[1],
				'r_three' => $lo[2],
				'r_four' => $lo[3],
				'r_five' => $lo[4],
				'r_six' => $lo[5],
				'blue' => $l[1],
				'lotter_date' => $lotter_date,
				'week' => $week,
				'add_time' => time(),
				);

			$res = M('ball')->data($data)->add();
			if($res){
				$this->success('添加成功');die;
			}
			$this->error('发布失败');die;
		}
		$this->display('add');
	}


	/**
	 * 定时任务更新开奖数据
	 * @Author   zhibin
	 * @DateTime 2017-09-05
	 * @return   [type]     [description]
	 */
	public function upLottery()
	{
		set_time_limit(180);
		$Ball = D('Ball');
		$data = $Ball->apiplus();
		// pre($data);die;
		foreach ($data as $key => $val) {
			$info = $Ball->getOneByMap(['sn'=>$val['expect']]);
			if ($info) {
				continue;
			}
			$Ball->addNew($val);
			// sleep(1);
		}
	}

	/**
	 * 产生一组随机号码
	 * @Author zhibin
	 * @Date   2018-10-19
	 * @return [type]     [description]
	 */
	public function randssq()
	{
		$redball = range(1, 33);
		$blueball = range(1, 16);

		$red = [];
		for($i=1; $i<=6; $i++){
			shuffle($redball);
			$red[] = array_pop($redball);
		}
		sort($red);
		shuffle($blueball);
		$blue = array_pop($blueball);

		$str = implode(',', $red).' +'.$blue;
		echo $str;
	}

	/**
	 * 相关查询
	 * @Author zhibin
	 * @Date   2018-10-19
	 * @return [type]     [description]
	 */
	public function series()
	{
		$one = I('param.r_one','','intval');
		$Ball = D('Ball');
		$series = $Ball->statOne($one);

		$this->assign('series', $series);
		$this->display('series');
	}

}
?>