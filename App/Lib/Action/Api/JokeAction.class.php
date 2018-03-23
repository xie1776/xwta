<?php  
	class JokeAction extends ApiAction{

		public function index(){
			if($_GET['callback']){

				$callback = $_GET['callback'];
				//$val = json_encode($_SERVER);
				$val = $_SERVER['HTTP_REFERER'];
				$arr = json_encode(array('status'=>1,'info'=>$val));
				echo $callback.'('.$arr.')';die;
			}
		}
		/**
		 * 获取搞笑图片
		 * @Author   zhibin
		 * @DateTime 2017-10-27
		 * @return   [type]     [description]
		 */
		public function  getListByImg(){
			$model = M('joke');
			$p = I('get.p', 1, 'intval');
			$rows = 10;
			$list = $model->field()->where(['type'=>2])->order('id desc')->page($p,$rows)->select();

			if(!$list){
				$list = array();
			}else{
				foreach ($list as &$val) {
					$val['ct'] = date('Y-m-d',$val['add_time']);
				}
			}

			$ret = array(
				'code' => 1000,
				'list' => $list
				);

			echo json_encode($ret);
		}
		/**
		 * 获取笑话 
		 * @Author   zhibin1
		 * @DateTime 2017-10-28
		 * @return   [type]     [description]
		 */
		public function getlistByWord(){
			$model = M('joke');
			$p = I('get.p', 1, 'intval');
			$rows = 10;
			$list = $model->field()->where(['type'=>1])->order('id desc')->page($p,$rows)->select();

			if(!$list){
				$list = array();
			}else{
				foreach ($list as &$val) {
					$val['ct'] = date('Y-m-d',$val['add_time']);
					$val['content'] = str_replace(['<br/>','<br>','<br />'], "\r\n", $val['content']);
				}
			}

			$ret = array(
				'code' => 1000,
				'list' => $list
				);

			echo json_encode($ret);
		}
		/**
		 * 图片详情
		 * @Author   zhibin
		 * @DateTime 2017-10-30
		 * @return   [type]     [description]
		 */
		public function getDetailImg(){
			$id = I('get.id', 0, 'intval');

			$model = M('joke');
			$info = $model->field()->where(['type'=>2,'id'=>$id])->find();

			$ret = array(
				'code' => 1000,
				'info' => $info
				);

			echo json_encode($ret);
		}
	}
?>