<?php  
	
	class NewsAction extends HomeAction{

		/**
		 * 文章详细
		 * @author zhibin1
		 * @version 2016-09-23
		 * @return  [type]     [description]
		 */
		public function detail(){

			$id = I('get.id',0,'intval');
			//echo $id;die;
			
			$News = D('News');
			$info = $News->getInfo($id);
			// var_dump($info);die;
			// if($info){
				$info['content'] = htmlspecialchars_decode($info['content']);
				$info['content'] = str_replace("\r\n", '</br>', $info['content']);
				$info['content'] = NewsModel::doImage($info['content']);
				
				//获取推荐文章
				$recommend = $News->getTitleList();

				//实况
				$we_list = $News->getTitleList(['cid'=>61]);

				$this->assign('we_list', $we_list);
				$this->assign('recommend', $recommend);
				$this->assign('info',$info);
				$this->display("detail");
			// } else {
			// 	$this->error('文章不存在');
			// }

		}

		/**
		 * 文章列表 新版
		 * @Author   zhibin3
		 * @DateTime 2018-01-07
		 * @return   [type]     [description]
		 */
		public function index(){

			$model = D('News');
			$list = $model->listNewsV2();

			// pre($list);die;
			$this->assign('list',$list['list']);
			$this->assign('page', $list['page']);
			$this->display('index');
		}

		public function show(){
			$this->display('show');
		}
	}
?>