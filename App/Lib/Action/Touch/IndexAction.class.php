<?php 
	class IndexAction extends TouchAction{
		//首页方法 方法名不可更改
		public function index()
		{
			$model = M('category');
			$where = array(
				'status' => 1,
				);
			$list = $model->where($where)->order('id desc')->select();
			//echo $model->_sql();die;
			$D = D('Article');
			foreach ($list as $key => $val) {
				$list[$key]['arts'] = $D->where('status=1 and cid='.$val['id'])->order('add_time desc')->limit(5)->select();
			}
			//dump($list);exit;
			$this->assign('list',$list);
			$this->display('index');
		}
		//详情页方法　方法名不可更改
		public function art()
		{
			$id = I('get.id','','int');
			$where = array(
					'status' => ArticleModel::STATUS_SHOW,
					'id' =>$id,
				);
			$model = M('article');
			$article = $model->where($where)->find();
			if(!$article)
			{
				$this->m_error('文章不存在');
			}
			//dump($_SESSION);exit;
			if($article['pic_url']){ //如果图片存在
				$img_url = ArticleModel::getSavePath().$article['pic_url'];
				$article['img_url'] = '<img src="'.$img_url.'" onerror="javascript:this.src=\'http://www.laijiemi.cn/Public/images/ad3.png\';"/>';
			}
			$article['nextId'] = $model->where("status=1 and cid={$article['cid']} and id>$id")->order("id asc")->limit(1)->getField('id');
			$article['lastId'] = $model->where("status=1 and cid={$article['cid']} and id<$id")->order("id desc")->limit(1)->getField('id');
			$article['content'] = preg_replace("/<a[^>]*>(.*)<\/a>/isU",'${1}',$article['content']);
			$this->assign('art',$article);
			$this->display('detail');
		}
		//赞
		public function zan()
		{
			$id = I('post.id',0,'int');
			$option = I('post.c','','string');
			$ip = get_client_ip();
			if(!$id)
				return $this->ajaxReturn(array('status'=>0,'info'=>'ID不存在'));
			$name = $ip.$id;
			$time = time();

			$Cache = Cache::getInstance('Memcache',array('expire'=>'3600'));
			if($Cache->get($name))
				return $this->ajaxReturn(array('status'=>0,'info'=>'已赞过'));
			else 
				$Cache->set($name,$time);

			$where = array(
				'id'=>$id,
				);
			$res = D('article')->where('id='.$id)->setInc($option);
			if($res)
				return $this->ajaxReturn(array('status'=>1,'info'=>'success'));
			else
				return $this->ajaxReturn(array('status'=>0,'info'=>'error'));
		}
	}
 ?>