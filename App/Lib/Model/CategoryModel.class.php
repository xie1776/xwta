<?php

class CategoryModel extends BaseModel
{
	/**
	 * 获取一级分类列表
	 * @Author   zhibin1
	 * @DateTime 2018-01-16
	 * @return   [type]     [description]
	 */
	public function getListByOne()
	{	
		$where = [
			'pid' =>0,
		];
		$list = $this->field()->where($where)->select();
		// pre($list);die;
		return $list;
	}
}