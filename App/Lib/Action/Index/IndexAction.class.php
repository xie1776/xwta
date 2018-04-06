<?php
/**
 * 默认首页
 */
class IndexAction extends CommonAction
{

	/**
	 * 首页方法
	 * @return [type] [description]
	 */
	public function index()
	{
		$this->display('index');
	}

	/**
	 * 详情方法
	 * @return [type] [description]
	 */
	public function detail()
	{
		$id = I('get.id', 0, 'intval');
		$this->display('detail');
	}
}