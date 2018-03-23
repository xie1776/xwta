<?php  
	class NovelAction extends CommonAction{

		public function index(){
			$model = M();

			import('ORG.Util.Page');
			$count = $model->table('pa_novel n')->where()->count();
			$rows = 20;
			$page = new Page($count,$rows);
			$list = $model->table('pa_novel n')->join('pa_chapter c on n.id=c.novel_id')->field('n.*,count(c.id) chaNum')->where()->group('c.novel_id')->order('id desc')->limit($page->firstRow,$rows)->select();
			// echo $model->_sql();die;var_dump($list);die;
			$status_list = NovelModel::$status_list;
			$this->assign('status_list',$status_list);
			$this->assign('list',$list);
			$this->assign('page',$page->show());
			$this->display();
		}

		/**
		 * 小说导入
		 * @author: zhibin1.xie
		 * @version 2016-12-20
		 * @return  [type]     [description]
		 */
		public function toLead(){
			set_time_limit(100); //100秒的执行时间
			if(IS_POST){
				$name = I('post.title');
				$author = I('post.author');
				$data = array(
					'name' => $name,
					'author' => $author,
					'status' => I('post.status',0,'intval'),
					);

				//数据检查
				//判断上传文件的编码方式
				$charset = mb_detect_encoding(file_get_contents($_FILES['txtFile']['tmp_name']), array("ASCII",'UTF-8',"GB2312","GBK",'BIG5'));
				if($charset!='UTF-8'){

					$this->error('上传文件格式不是UTF-8');die;
				} 

				import('@.ORG.Pinyin');
				$py = new Pinyin();
				$fullPy = $py->getAllPY($name);
				$time = time();
				$dir = WEB_ROOT.'Novel/'.$time.'_'.$fullPy;
				if(!is_dir($dir)){
					$rs = mkdir($dir,0777,true);
				}else{
					$this->error('目录已经存在');die;
				}

				if($rs){
					$data['add_time'] = $time;
					$data['dir'] = $dir;

					$Novel = M('novel');
					$novel_id = $Novel->add($data);
					//echo $Novel->_sql();//die;
				}else{
					$this->error('目录创建失败');die;
				}

				if($novel_id){ //创建小说成功 开始拆分小说 并存表
					
					$res = $this->_buildChather($_FILES['txtFile'],$novel_id,$dir);
					if(!$res['status']){
						$this->error($res['info']);die;
					}

					$this->success('success',U('Novel/index'));
					die;
				}
				
			}
			$this->display('add');
		}

		/**
		 * 生成文章章节
		 * @author: zhibin1.xie
		 * @version 2016-12-21
		 * @return  [type]     [description]
		 */
		private function _buildChather($txtFile,$novel_id,$dir){
			
			if($txtFile['error']!=0 || $txtFile['type']!='text/plain'){

				return array('status'=>0,'info'=>'上传失败或文件类型错误');
			}
			$big_text = file_get_contents($txtFile['tmp_name']);

			//判断上传文件的编码方式
			$charset = mb_detect_encoding($big_text, array("ASCII",'UTF-8',"GB2312","GBK",'BIG5'));
			if($charset!='UTF-8'){

				return array('status'=>0,'info'=>'上传文件格式不是UTF-8');
				//$this->error('上传文件格式不是UTF-8');die;
			} 
			// $arr = preg_split('/(\s){1,}第(.*?)章(\s|\r|\t|\v){1,}/', $big_text);//var_dump($arr[0]);die;
			preg_match_all('/(\s){1,}第(.*?)章(.*?)(\n|\r){1,}/', $big_text, $arr);
			//echo '<pre>';print_r($arr);die;

			$c_data = array(
				'novel_id' => $novel_id,
					);
			$st = 0;
			$title = '序幕';
			$file_count = mb_strlen($big_text,'UTF-8');
			foreach ($arr[0] as $key => $val) {
				//echo  mb_strpos($big_text, $val,0,'UTF-8');die;
				$end = mb_strpos($big_text, $val,$st,'UTF-8');
				$content = mb_substr($big_text,$st,($end-$file_count),'UTF-8');
				
				$c_data['title'] = $title;
				$filename = $key.'.txt'; //md5(uniqid().$key)
				//echo $filename;die;
				file_put_contents($dir.'/'.$filename, $content);
				$c_data['path'] = $filename;
				$c_data['up_time'] = time();
				$c_rs = M('chapter')->add($c_data);

				$st = $end;
				$title = trim($val);
				unset($key,$val);
			}

			return array('status'=>1);
		}




	}
?>