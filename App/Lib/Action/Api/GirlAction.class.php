<?php  
/**
 * 校花美女
 */
class GirlAction extends ApiAction
{
		/**
		 * 获取搞笑图片
		 * @Author   zhibin
		 * @DateTime 2017-10-27
		 * @return   [type]     [description]
		 */
		public function  getListByImg(){
			$model = M('girl');
			$p = I('get.p', 1, 'intval');
			$rows = 10;
			$list = $model->field()->order('rand()')->limit(10)->select();

			if(!$list){
				$list = array();
			}else{
				foreach ($list as &$val) {
					$val['ct'] = date('Y-m-d',$val['add_time']);
					$val['pic'] = 'http://www.xwta.net/Public/xh/'.$val['pic'];
				}
			}

			$ret = array(
				'code' => 1000,
				'list' => $list
				);

			echo json_encode($ret);
		}
}
?>
