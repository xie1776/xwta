<?php  

class GirlAction extends BaseAction
{
	public function brush(){
		$dir = 'D:\www\Python\pic\down';
		$temp = scandir($dir);
		// pre($temp);die;

		$model = M('girl');
		$data = ['add_time'=>time()];
		foreach ($temp as $key => $val) {
			if($val!='.' && $val!='..'){
				// echo $val.'<br/>';
				$val = iconv('gbk', 'UTF-8', $val);
				$data['pic'] = trim($val);
				$val = explode('.', $val);
				$data['name'] = $val[0];
				// $data['name'] = iconv('gb2312', 'utf-8', $data['name']);
				// pre($data);
				$model->add($data);
				// echo $model->_sql();die;
			}
			// if($key>10)
			// 	break;
		}
	}
}
?>