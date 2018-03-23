<?php 
	//会员Model 
	class MemberModel extends Model{

		/**
		 * 用户列表
		 * @author zhibin1
		 * @version 2016-09-12
		 * @return  [type]     [description]
		 */
		public function getList($where=array()){
			//分页
			import('ORG.Util.Page');
			$rows = 20; //每页显示20条信息
			$count = $this->where($where)->count();
			$page = new Page($count,$rows);
			$list = $this->where($where)->limit($page->firstRow.','.$rows)->order('uid desc')->select();
			$res['page'] = $page->show();
			$res['list'] = $list;
			return $res;
		}

		/**
		 * 用户登录缓存
		 * @Author   zhibin
		 * @DateTime 2017-09-11
		 * @return   [type]     [description]
		 */
		public function loginCache($user_id){
			$key = $user_id;
			$cache = Cache::getInstance();
			if($cache->get($key)){ //今天已经登录
				return false;
			}else{
				$expire = todayEffect(); //过期时间=从现在到明日凌晨
				$cache->set($key,1,$expire);
				return true;
			}
		}
		/**
		 * 用户登录
		 * @Author   zhibin
		 * @DateTime 2017-09-12
		 * @return   [type]     [description]
		 */
		public function login($username,$pwd){
			if(!$username || !$pwd){
				return false;
			}
			$where = array(
				'username' => $username,
				'pwd' => encrypt($pwd),
				);
			$info = $this->where($where)->find();//var_dump($info);die;
			if(!$info){
				return false;
			}
			if($this->loginCache($info['uid'])){ //表示当天第一次登录
				$this->_addBalance($info['uid']);
			}
			session('isLogin',1);
			session('userInfo',$info);
			return $info; //登录成功
		}
		/**
		 * 第一次登录
		 * @Author   zhibin
		 * @DateTime 2017-09-12
		 */
		private function _addBalance($uid){
			if(!$uid){
				return false;
			}
			$log_point = C('LOG_POINT');
			$balance = $log_point; //登录送5积分
			$remark = '登录赠送';

			$model = M('ball_amount_log');
			$res = $model->data(array('user_id'=>$uid,'amount'=>$balance,'type'=>1,'remark'=>$remark,'add_time'=>time()))->add();
			$res && M('member')->where(array('uid'=>$uid))->setInc('balance',$balance);
			// return true;
		}
		/**
		 * 注册
		 * @Author   zhibin
		 * @DateTime 2017-09-12
		 * @return   [type]     [description]
		 */
		public function signUp($data=array()){

			$reg_point = C('REG_POINT');
			$input_data = array(
				'username' => $data['username'],
				'pwd' =>  encrypt($data['password']),
				'status' => 0,
				'balance' => $reg_point,
				'add_time' => time(),
				);
			$data['email'] && $input_data['email'] = $data['email'];
			$data['nickname'] && $input_data['nickname'] = $data['nickname'];
			$data['mobile'] && $input_data['mobile'] = $data['mobile'];
			$data['qq'] && $input_data['qq'] = $data['qq'];
			$data['sex'] && $input_data['sex'] = $data['sex'];
			$data['intr'] && $input_data['intr'] = $data['intr'];

			//城市code
			$ip = $_SERVER['REMOTE_ADDR'];
			$city_name = $this->getCityByIp($ip);
			if($city_name){
				$city = D('City')->getInfoByCond(array('name'=>$city_name));
				$input_data['city'] = $city['code'];
			}
			$res = $this->data($input_data)->add();
			if($res){

				$this->loginCache($res); //创建缓存
				$info = $this->where(array('uid'=>$res))->find();
				D('BallAmountLog')->addLog($info['uid']); //添加积分日志
				session('isLogin',1);
				session('userInfo',$info);
				return $info;
			}
			return false;
		}
		/**
		 * 通过ip获取所在的数据
		 * @Author   zhibin
		 * @DateTime 2017-09-19
		 * @param    [type]     $ip [description]
		 * @return   [type]         [description]
		 * {
    "code": 0,
    "data": {
        "country": "中国",
        "country_id": "CN",
        "area": "华东",
        "area_id": "300000",
        "region": "江西省",
        "region_id": "360000",
        "city": "南昌市",
        "city_id": "360100",
        "county": "",
        "county_id": "-1",
        "isp": "电信",
        "isp_id": "100017",
        "ip": "218.64.55.207"
    }
}
		 */
		public function getCityByIp($ip){
			$url = 'http://ip.taobao.com/service/getIpInfo.php?ip='.$ip;
			$result = curlGet($url);
			$result = json_decode($result,true);
			if($result['code']===0){
				$city = $result['data']['city'];
				return mb_substr($city, 0, -1, 'UTF-8');
			}
			return false;
		}

	}
?>