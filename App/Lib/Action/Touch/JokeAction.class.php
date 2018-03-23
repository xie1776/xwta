<?php
	class JokeAction extends TouchAction
	{
		public function __construct()
		{
			parent::__construct();
			$this->host = "http://".$_SERVER['HTTP_HOST'];
		}

		/**
		 * 首页
		 * @author: zhibin1.xie
		 * @version 2016-12-19
		 * @return  [type]     [description]
		 */
		public function index()
		{	
			$D = D("Joke");
			//$D->getData();
			$p = I('get.p',1,'int');
			$where = array(
				'type' => JokeModel::TYPE_IMG,
				);
			import("App.ORG.MyPage"); //类文件路径 App/Lib/ORG/Mypage.class.php
			$maxResult = 10;
			$count = $D->where($where)->count();
			$page = new MyPage($count,$maxResult);
			$this->totalpage = $page->show_total_pages();
			$this->pre = $p-1<=0?1:($p-1);
			$this->next = ($p+1)>$this->totalpage?$this->totalpage:($p+1); 
			$this->nowPage = $page->showNowPage();
			$list = $D->where($where)->page($p.','.$maxResult)->order('id desc,ct desc')->select();
			// var_dump($list,$D->_sql());exit;
			//$this->test(); //异步更新数据
			$this->siteUrl = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
			$this->siteTitle = '来揭秘—搞笑图片';
			$this->assign('joke_active','active');
			$this->assign('list',$list);
			$this->display('index');
		}


		public function JokeDetail()
		{
			$id = I('get.id',1,'intval');
			//echo $id;exit;
			$where = array(
				'id' => $id,
				'type' => JokeModel::TYPE_IMG,
				);
			$model = D('Joke');
			$joke = $model->where($where)->find();
			//判断是否有数据
			if(!$joke){
				$this->error('没有数据');die;
			}
			$where_base = array(
				'type' => JokeModel::TYPE_IMG,
				);
			$max = $model->field("id")->where($where_base)->order("id desc")->find();
			$next = $model->field("id")->where(array_merge($where_base,array('id'=>array('gt',$id))))->order("id asc")->find();
			$joke['nextId'] = $next['id']?$next['id']:1;
			$last = $model->field("id")->where(array_merge($where_base,array('id'=>array('lt',$id))))->order("id desc")->find();
			$joke['lastId'] = $last['id']?$last['id']:$max['id'];
			//var_dump($joke);exit;
			//$this->test(); //异步更新数据
			$this->assign('joke',$joke);
			$this->assign('siteUrl','http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
			$this->assign('siteTitle','来揭秘-搞笑图片-'.$joke['title']);
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
			$res = D('Joke')->where('id='.$id)->setInc($option);
			if($res)
				return $this->ajaxReturn(array('status'=>1,'info'=>'success'));
			else
				return $this->ajaxReturn(array('status'=>0,'info'=>'error'));
		}
		/**
		 * 图片切换 页面不变换 Ajax方式切换图片
		 * @return [type] [description]
		 */
		public function switchImg()
		{
			$id = I('get.id',1,'intval');
			$op = I('get.op','','string');
			//echo $id;exit;
			$model = D('Joke');
			$where = array(
				'type' => JokeModel::TYPE_IMG,
				);
			if($op == 'next')
			{	
				$where['id'] = array('gt',$id);
				$joke = $model->where($where)->order("id asc")->find();
				$joke?$joke:$joke=$model->where("id=1")->find();
			}
			else if($op == 'last')
			{
				$where['id'] = array('lt',$id);
				$joke = $model->where($where)->order("id desc")->find();
				$joke?$joke:$joke=$model->order("id desc")->find();
			}
			$joke['url'] = 'http://'.$_SERVER['HTTP_HOST'].U('Joke/detail',array('id'=>$id));
			$joke['add_time'] = date("Y-m-d H:i",$joke['add_time']);
			$joke['siteTitle'] = '来揭秘-搞笑图片-'.$joke['title'];
			//$this->test(); //异步更新数据
			$this->ajaxReturn(array('status'=>1,'info'=>'success','list'=>$joke));
		}
	}
?>