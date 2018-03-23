<?php  
	
	class CityModel extends Model{

		/**
		 * 获取所有的城市
		 * @author zhibin1
		 * @version 2016-09-21
		 * @return  [type]     [description]
		 */
		public function getList(){

			$list = $this->field('id,name,code')->order('id asc')->select();
	
			return $list;
		}
		/**
		 * 通过条件查询单条信息
		 * @Author   zhibin
		 * @DateTime 2017-09-19
		 * @return   [type]     [description]
		 */
		public function getInfoByCond($condition=array()){
			return $this->where($condition)->find();
		}
	}
?>