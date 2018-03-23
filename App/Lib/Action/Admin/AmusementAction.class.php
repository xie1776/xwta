<?php  
	/**
	 * 接口数据管理
	 */
	class AmusementAction extends CommonAction{
		/**
		 * 搞笑图片管理
		 * @Author   zhibin1
		 * @DateTime 2017-03-21
		 * @Update
		 * @return   [type]     [description]
		 */
		public function word(){
			$Joke = D('Joke');
			$p = I('get.p',1,'intval');
			$where = array(
				'type' => 1,
				);

			$data = $Joke->getList($where,$p);
			// dump($data);die;
			$this->assign('list',$data['list']);
			$this->assign('page',$data['page']);
			$this->display();
		}
		/**
		 * 搞笑图片
		 * @Author   zhibin1
		 * @DateTime 2017-03-21
		 * @return   [type]     [description]
		 */
		public function joke(){
			$Joke = D('Joke');
			$p = I('get.p',1,'intval');
			$where = array(
				'type' => 2,
				);

			$data = $Joke->getList($where,$p);
			// dump($data);die;
			$this->assign('list',$data['list']);
			$this->assign('page',$data['page']);
			$this->display();
		}
		/**
		 * 美女图片
		 * @Author   zhibin1
		 * @DateTime 2017-03-21
		 * @return   [type]     [description]
		 */
		public function looker(){
			$Looker  = D('Looker');
			$p = I('get.p',1,'intval');
			$data = $Looker->getList();

			$this->assign('list',$data['data']);
			$this->assign('page',$data['page']);
			$this->display();
		}
		/**
		 * 脑筋急转弯
		 * @Author   zhibin1
		 * @DateTime 2017-03-21
		 * @return   [type]     [description]
		 */
		public function mind(){
			$Mind  = D('Mind');
			$data = $Mind->getList();

			$this->assign('list',$data['list']);
			$this->assign('page',$data['page']);
			$this->display();
		}
		/**
		 * 编辑笑话
		 * @Author   zhibin1
		 * @DateTime 2017-03-23
		 * @return   [type]     [description]
		 */
		public function editJoke(){
			$id = I('get.id',0,'intval');
			$joke = D('Joke');
			$info = $joke->where(array('id'=>$id))->find();
			if(!$info){
				$this->display('未发现');die;
			}
			
			$this->assign('info',$info);
			$this->display('edit');
		}
		/**
		 * 保存编辑
		 * @Author   zhibin1
		 * @DateTime 2017-03-23
		 * @return   [type]     [description]
		 */
		public function saveJoke(){
			if(IS_POST){
				$id = I('post.id',0,'intval');
				$title = I('post.title','','string');
				$content = I('post.content','','string');

				$info = D('Joke')->where(array('id'=>$id))->find();
				if(!$info){
					$this->error('数据未发现');die;
				}
				$res = D('Joke')->where(array('id'=>$id))->data(array('title'=>$title,'content'=>$content))->limit(1)->save();
				if($res){
					$this->success('修改成功');die;
				}
				$this->error('修改失败');die;
			}
		}


		

	}
?>