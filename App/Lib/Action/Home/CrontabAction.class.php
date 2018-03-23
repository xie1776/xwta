<?php  
	class CrontabAction extends HomeAction{

		/**
		 * 定时任务 更新搞笑图片
		 * @author: zhibin1.xie
		 * @version 2016-12-13
		 * @return  [type]     [description]
		 */
		public function getJoke(){
			$res = D('Joke')->getDataFromApi();
			if($res){
				echo date('Y-m-d H:i')."\n";
			}
		}

		/**
		 * 获取搞笑文字
		 * @return [type] [description]
		 */
		public function getjword(){
			$res = D('Joke')->getJokeWordApi();
			if($res){
				echo date('Y-m-d H:i')."\n";
			}
		}
		/**
		 * 定时任务 更新美女图片
		 * @author: zhibin1.xie
		 * @version 2016-12-13
		 * @return  [type]     [description]
		 */
		public function getlooker(){
			
			$res = D('Looker')->getDataFromApi();

			if($res){
				echo date('Y-m-d H:i')."\n";
			}
		}
		/**
		 * 定时任务 脑筋急转弯
		 * @return [type] [description]
		 */
		public function getmind(){
			$res = D('Mind')->getDataByApi();
			if($res){
				echo date('Y-m-d H:i')."\n";
			}
		}
		/**
		 * 通过来福岛更新数据
		 * @Author   zhibin1
		 * @DateTime 2017-03-21
		 * @return   [type]     [description]
		 */
		public function getJBylfd(){
			$res = D('Joke')->updateByLaifudao();
			if($res){
				echo date('Y-m-d H:i')."\n";
			}
		}
		/**
		 * 定时任务更新开奖数据
		 * @Author   zhibin
		 * @DateTime 2017-09-05
		 * @return   [type]     [description]
		 */
		public function upLottery(){
			set_time_limit(180);
			$Ball = D('Ball');
			$sn = $Ball->order('id desc')->limit(1)->getField('sn');
			for ($i=$sn+1; $i < 2020153; $i++) { 

				$result = $Ball->addByApi($i);
				//dump($result);die;
				if($result['showapi_res_body']['result']){
			    	$Ball->addNew($result['showapi_res_body']['result']);
			    }else{
			    	$after = substr($i, -3);
			    	$front = substr($i,0,4);
			    	if($after=='153' || $after=='154' || $after=='152'){
			    		//echo $after.'-'.$front;die;
			    		$i = ($front+1).'000';
			    	}else{
			    		// die('exit');
			    		echo date('Y-m-d H:i:s')."\n";
			    		die;
			    	}
			    }
			    //die;
			    sleep(1);
			}
		}
		/**
		 * 定时生成sitemap
		 * @Author   zhibin
		 * @DateTime 2017-11-02
		 * @return   [type]     [description]
		 */
		public function createSitemap(){
			$file_path = 'sitemap.txt';
			$content = file_get_contents($file_path);

			$lenth = 100; //最多写入10000条记录
			$model = M('news');

			$where = array();
			if($content){
				$temp = end(explode("\r\n", $content));
				$reg='/\d+/is';//匹配数字的正则表达式
    			preg_match_all($reg,$temp,$result);
    			$id = intval($result[0][0]);
				$where['id'] = array('gt',$id);	
			}
			unset($content);
			$list = $model->field('id')->where($where)->order('id asc')->limit($lenth)->select();

			if(!$list){
				echo 'Fail';die;
			}
			$fp = fopen($file_path, 'w');
			$format = "http://www.xwta.net/news-%d.html";
			$count = count($list);
			foreach ($list as $key => $val) {
				$suffix = $key+1>=$count?'':"\r\n";
				$data = sprintf($format,intval($val['id']));
				fwrite($fp, $data.$suffix);
			}
			fclose($fp);
			echo 'SUCCESS';
		}

		
		
	}
?>