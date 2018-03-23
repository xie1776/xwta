<?php

class ArticleAction extends CommonAction
{
	/**
	 * 文章列表
	 * @Author   zhibin1
	 * @DateTime 2017-11-24
	 * @return   [type]     [description]
	 */
	public function index(){
		$Art = D("Article");
        $data = $Art->getList();

        //dump($data);die;
        $this->assign("page", $data['page']);
        $this->assign("list", $data['list']);
        $this->assign('is_top',NewsModel::$is_top);
        $this->display();
	}

	public function edit(){
		$id = I('get.id', 0, 'intval');
		$model = M('article');

		if(IS_POST){

		}
		$info = $model->where(array('id'=>$id))->find();
		$this->assign('info',$info);
		$this->display('add');
	}
}