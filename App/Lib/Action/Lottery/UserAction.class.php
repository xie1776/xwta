<?php  
	
	/**
	 * 用户注册 登录相关
	 * 业务涉及的表 投注表 金币日志表
	 * 业务规则 首次注册奖励 50积分 每天登录奖励5积分
	 */
	class UserAction extends LotteryAction{

		/**
		 * 用户注册
		 * @Author   zhibin
		 * @DateTime 2017-09-11
		 * @return   [type]     [description]
		 */
		public function reg(){
			$this->_checkouIsLogin();
			if(IS_POST){
				$username = I('post.username', '', 'getSafeInputText');
				$password = I('post.passwd', '', 'getSafeInputText');
				$repass = I('post.repass', '', 'getSafeInputText');
				if(!$username || !$password){
					$this->error('用户名或者密码不能为空');
					die;
				}
				$this->_checkUsername($username);
				if($password != $repass){
					$this->error('两次密码不一致');die;
				}
				$data = array(
					'username' => $username,
					'password' => $password,
					);
				$_POST['email'] && $data['email'] = I('post.email', '', 'getSafeInputText');
				if(isset($data['email']) && !is_email($data['email'])){
					$this->error('邮箱格式错误');die;
				}
				$_POST['intr'] && $data['intr'] = I('post.intr', '', 'getSafeInputText');
				$_POST['sex'] && $data['sex'] = I('post.intr', 0, 'intval');
				$_POST['mobile'] && $data['mobile'] = I('post.mobile', '', 'getSafeInputText');
				$_POST['qq'] && $data['qq'] = I('post.qq', 0, 'intval');
				if(isset($data['mobile']) && !is_mobile($data['mobile'])){
					$this->error('手机号码格式错误');die;
				}

				$model = D('Member');
				$res = $model->signUp($data);
				if($res){
					$this->userInfo = $res;
					$this->success('注册成功',U('Index/index'));die;
				}
				$this->error('注册失败');die;

			}
			$this->display('reg');
		}

		/**
		 * 用户登录
		 * @Author   zhibin
		 * @DateTime 2017-09-11
		 * @return   [type]     [description]
		 */
		public function login(){
			$this->_checkouIsLogin();
			if(IS_POST){
				$username = I('post.user', '', 'getSafeInputText');
				$password = I('post.pass', '', 'getSafeInputText');

				if(!$username || !$password){
					$this->error('用户和密码不能为空');die;
				}
				$this->_checkUsername($username);
				$model = D('Member');
				$user = $model->login($username,$password); //var_dump($user);die;
				if($user){
					$this->userInfo = $user;
					$this->success('登录成功',U('Index/index'));
				}else{
					$this->error('登录失败');
				}
				die;
			}
			$this->display();
		}
		/**
		 * 用户首页
		 * @Author   zhibin
		 * @DateTime 2017-09-11
		 * @return   [type]     [description]
		 */
		public function index(){
			echo '<h1>Welcome</h1>';
		}

		/**
		 * 退出登录
		 * @Author   zhibin
		 * @DateTime 2017-09-12
		 * @return   [type]     [description]
		 */
		public function logout(){
			session('isLogin',0);
			$this->user = '';
			$this->success('退出成功',U('Index/index'));
		}
		
		/**
		 * 用户名验证
		 * @Author   zhibin
		 * @DateTime 2017-09-12
		 * @return   [type]     [description]
		 */
		private function _checkUsername($username){
			if(strlen($username)<5){
				$this->error('用户至少5位');die;
			}
			if(!preg_match('/^[a-zA-Z0-9]+$/', $username)){
				$this->error('用户名只能是字母和数字');die;
			}
		}
		/**
		 * 检测是否已经登录
		 * @Author   zhibin
		 * @DateTime 2017-09-12
		 * @return   [type]     [description]
		 */
		private function _checkouIsLogin(){
			if(session('isLogin') && $this->userInfo){ //检测是否已经登录
				$this->redirect('Index/index');
			}
		}
		/**
		 * 测试之用
		 * @Author   zhibin
		 * @DateTime 2017-09-12
		 * @return   [type]     [description]
		 */
		public function test(){
			$bets = array(
				'1,2,5,7,17,23,25+1',
				'2,3,5,7,17,25+12',
				);
			$lot = '1,2,5,17,23,25+12';

			$bets = win_hint($bets,$lot);
			pre($lot);
			pre($bets);
		}
		/**
		 * 投注列表
		 * @Author   zhibin1
		 * @DateTime 2017-09-20
		 * @return   [type]     [description]
		 */
		public function userCenter(){
			if(session('isLogin') && $this->userInfo){ //检测是否已经登录
				
				$model = D('BallOrder');
				$userInfo = $this->userInfo;
				$list = $model->getList(array('user_id'=>$userInfo['uid']),10);

				$this->assign('list',$list['list']);
				$this->assign('page',$list['page']);

				$this->display();
			}else{
				$this->redirect('Index/index'); //跳转到首页
			}
		}

	}
?>