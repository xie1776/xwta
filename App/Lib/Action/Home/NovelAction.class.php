<?php  
	class NovelAction extends HomeAction{

		public function index(){
			$Novel = D('Novel');

			$list = $Novel->where()->order('id desc')->select();
			$status_list = NovelModel::$status_list;
			foreach ($list as $key => $val) {
				$list[$key]['status'] = $status_list[$val['status']];
			}
			$this->assign('list',$list);
			$this->display();
		}

		/**
		 * 查看章节
		 * @author: zhibin1.xie
		 * @version 2016-12-21
		 * @return  [type]     [description]
		 */
		public function chapter(){
			$id = I('get.id',0,'intval');
			$model = M();
			$where = array(
				'c.id' => $id,
				);
			$info = $model->table('pa_chapter c')->join('pa_novel n on n.id=c.novel_id')->field('c.*,n.dir,n.author')->where($where)->find();
			$Chapter = D('Chapter');
			$info['next'] = $Chapter->where(array('id'=>array('gt',$info['id']),'novel_id'=>$info['novel_id']))->order('id asc')->find();
			$info['prev'] = $Chapter->where(array('id'=>array('lt',$info['id']),'novel_id'=>$info['novel_id']))->order('id desc')->find();
			//dump($info,$Chapter->_sql());die;
			$content = file_get_contents($info['dir'].'/'.$info['path']);
			$info['content'] = preg_replace('/(\r|\n)+/', '</p><p>', $content);
			$this->assign('info',$info);
			$this->display();
		}
		/**
		 *  查看小说所有章节
		 * @author: zhibin1.xie
		 * @version 2016-12-21
		 * @return  [type]     [description]
		 */
		public function novel(){

			$id = I('get.id',0,'intval');
			$where = array(
				'novel_id' => $id,
				);
			$Chapter = D('Chapter');
			$novel = D('Novel')->where(array('id'=>$id))->find();
			$list = $Chapter->where($where)->order('id asc')->select();
			// var_dump($list);die;
			$this->assign('novel',$novel);
			$this->assign('list',$list);
			$this->display();
		}



	}
?>