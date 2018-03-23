<?php  
	class CityAction extends CommonAction{

		/**
		 * 城市列表
		 * @author zhibin1
		 * @version 2016-09-22
		 * @return  [type]     [description]
		 */
		public function index(){
			$City = D('City');
			import('ORG.Util.Page');
			$count = $City->count();
			$rows = 20;
			$page = new Page($count,$rows);
			$list = $City->field('id,code,name,area_code,citypy')->limit($page->firstRow.','.$rows)->select();
			$this->assign('list',$list);
			$this->assign('page',$page->show());
			$this->display();
		}

		public function add(){

			$City = D('City');

			if(IS_POST){
				$pid = I('post.pid');
				$city = I('post.city');
				$code = I('post.code');
				$area_code = I('post.area_code');
				$citypy = I('post.citypy');

				$data = array(
					'pid' => $pid,
					'name' => $city,
					'code' => $code,
					'area_code' => $area_code,
					'citypy' => $citypy,
					'status' => 1,
					'add_time' => time(),
					'update_time' => time(),
					);

				$res = $City->data($data)->add();
				if($res){
					$this->success('添加成功',U('City/index'));die;
				}else{
					$this->error('添加失败');die;
				}
			}
			$citys = $City->getList();
			$this->assign('citys',$citys);
			$this->display();
		}

		/**
		 * 检测城市 存在
		 * @author zhibin1
		 * @version 2016-09-22
		 * @return  [type]     [description]
		 */
		public function checkName(){

			$city = I('post.name','','trim');

			$status = 0;
			$info = '城市不能为空';
			if(!$city){
				$this->jsonReturn($status,$info);
			}

			//兼容"市" 如果city字数大于2个且含有市则去掉市
			
			$map = array(
				'name' => $city,
				);
			$City = D('City');
			$res = $City->where($map)->find();
			//echo $City->_sql();die;

			if(!$res){
				$this->jsonReturn(1,'城市不存在');
			}

			$this->jsonReturn(0,'城市可能已经存在');
		}

		/**
		 *  检测城市编号 存在
		 * @author zhibin1
		 * @version 2016-09-22
		 * @return  [type]     [description]
		 */
		public function checkCode(){

			$code = I('post.code','','trim');

			$status = 0;
			$info = '请输入编码';
			if(!$code){
				$this->jsonReturn($status,$info);
			}

			$map = array(
				'code' => $code,
				);
			$City = D('City');
			$res = $City->where($map)->find();
			//echo $City->_sql();die;

			if(!$res){
				$this->jsonReturn(1,'编号可用');
			}

			$this->jsonReturn(0,'编号可能已经存在');
		}
	}
?>