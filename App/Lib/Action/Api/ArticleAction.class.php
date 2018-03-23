<?php

class ArticleAction extends ApiAction
{
	public function index(){
		$model = M('article');
		import('ORG.Util.Page');

		$list = $model->field()->where()->limit(5)->order('id desc')->select();
		// pre($list);die;
		$this->jsonReturn(1000,'success',$list);
	}
}