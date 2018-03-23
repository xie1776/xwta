<?php  
	
	class LoginAction extends ApiAction{
		/**
		 * 登录接口
		 * @Author   zhibin
		 * @DateTime 2017-10-27
		 * @return   [type]     [description]
		 */
		public function up(){
			$code = I('get.code');

			$code = "\r\n".date('Y-m-d H:i:s').'------'.$code;
			$log = 'Databases/api.log';
			file_put_contents($log, $code, FILE_APPEND);
		}
		/**
		 * 意见提交
		 * @Author   zhibin
		 * @DateTime 2017-10-27
		 * @return   [type]     [description]
		 */
		public function suggest(){
			// $log = 'Databases/api.log';
			// file_put_contents($log, join('-',$_POST), FILE_APPEND);
			// var_dump($_REQUEST);die;

			$nickname = I('param.nickname');
			$username = I('param.username');
			$passwd = I('param.passwd');
			$sex = I('param.sex');
			$like = I('param.like');
			$score = I('param.score');
			$content = I('param.suggest');

			$time = time();

			$data = array(
				'nickname' => $nickname,
				'username' => $username,
				'passwd' => md5($passwd),
				'sex' => $sex,
				'like' => $like,
				'score' => $score,
				'content' => $content,
				'add_time' => $time,
				);

			$Model = M('suggest');

			$res = $Model->data($data)->add();

			if($res){
				echo json_encode(['code'=>'1000','msg'=>'success']);die;
			}
			echo json_encode(['code'=>'0','msg'=>'fail']);die;
		}
	}
?>