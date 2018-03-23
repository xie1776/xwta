<?php  
	class JokeAction extends HomeAction{

		/**
		 * rss输出
		 * @author: zhibin1.xie
		 * @version 2017-03-09
		 * @return  [type]     [description]
		 */
		public function rss(){
			$Joke = D('Joke');

			$list = $Joke->getJokeAword();
			// dump($list);die;
			self::_EchoXml($list);
			die;
		}
		/**
		 * 输出xml格式
		 * @author: zhibin1.xie
		 * @version 2017-03-09
		 * @param   [type]     $data [description]
		 * @return  [type]           [description]
		 */
		private static function _EchoXml($data){
			$xml = '<?xml version="1.0" encoding="UTF-8"?>';
			$xml .= '<rss xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:taxo="http://purl.org/rss/1.0/modules/taxonomy/" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" version="2.0">';
			$xml .= '<channel>';
			$xml .= '<title>来揭秘</title>'; //网站标题
			$xml .= '<link>http://www.xwta.net/</link>'; //网站首页地址
			$xml .= '<description>揭秘社会现实，力求公平真实</description>'; //描述
			$xml .= '<pubDate>'.date('D, d M Y H:i:s').' GMT</pubDate>'; // 发布的时间 Thu, 
			$xml .= '<lastBuildDate>'.date('D, d M Y H:i:s').' GMT</lastBuildDate>'; //最后更新的时间
			foreach ($data as $key => $val) {
				# code...
				if(!empty($val['content'])){
					$content = trim($val['content']);
					$content = trim($content,'&nbsp;');
					$content = strip_tags($content);
					$content = str_replace('&nbsp;', '', $content);
					// $content = mb_substr($content, 0, 100, 'UTF-8');
				}

				$timestamp = strtotime($val['add_time']);
				$xml .= '<item>';
					$xml .= '<title>'.$val['title'].'</title>'; //标题
					$xml .= '<link>'.'http://www.laijiemi.cn'.U('Index/art',array('id'=>$val['id'])).'</link>'; //链接地址
					if(!empty($val['content']))
						$xml .= '<description>'.$content.'</description>'; //内容简要描述
					else
						$xml .= '<img src="'.$val['img'].'" />';
					$xml .= '<pubDate>'.date('D, d M Y H:i:s',$timestamp).' GMT</pubDate>'; //发布时间
					$xml .= '<guid isPermaLink="false">'.'http://www.laijiemi.cn/'.U('Index/index',array('id'=>$val['id'])).'</guid>';
				$xml .= '</item>';
			}
			$xml .= '</channel>';
			$xml .= '</rss>';

			header('content-type:text/xml;charset=utf-8');
			echo $xml;
			die;
		}
		/**
		 * 显示
		 * @author: zhibin1.xie
		 * @version 2017-03-09
		 * @return  [type]     [description]
		 */
		public function index(){
			$p = I('get.p',1,'intval');
			$Joke = D('Joke');
			$list = $Joke->getJokeAword($p,3);
			// dump($list);die;
			$this->assign('list',$list);

			$this->display('index');
		}

		public function index2(){
			$p = I('get.p',1,'intval');
			$Joke = D('Joke');
			$list = $Joke->getJokeAword($p,3,$type=2);
			// dump($list);die;
			$this->assign('list',$list);

			$this->display('index');
		}
		/**
		 * 笑话详细
		 * @Author   zhibin
		 * @DateTime 2017-10-14
		 * @return   [type]     [description]
		 */
		public function detail(){
			$id = I('get.id', 0 ,'intval');
			$info = D('Joke')->where(['id'=>$id])->find();

			$this->assign('info',$info);
			$this->display('detail');
		}
		/**
		 * 美女详细
		 * @Author   zhibin
		 * @DateTime 2017-10-14
		 * @return   [type]     [description]
		 */
		public function lookerDetail(){
			$id = I('get.id', 0 ,'intval');
			$info = D('Looker')->where(['id'=>$id])->find();

			$this->assign('info',$info);
			$this->display('lookerDetail');			
		}

	}
?>