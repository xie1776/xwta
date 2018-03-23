<?php

// 本类由系统自动生成，仅供测试用途
class IndexAction extends HomeAction {
    /**
     * 首页
     * @return [type] [description]
     */
    public function index(){
        
        $Joke = D('Joke');
        $p = I('get.p',1,'intval');
        $type = I('get.type','');

        $where = array();
        $type && $where['type'] = $type;

        $data = $Joke->getList($where,$p,20);  //pre($data);die;

        //数据还原
        foreach ($data['list'] as $key => $val) {
            if($val['type']==1){
                $data['list'][$key]['content'] = htmlspecialchars_decode($val['content']);
            }
            $format = 'http://www.xwta.net/Joke/detail/%d.html';
            $data['list'][$key]['url'] = sprintf($format,intval($val['id']));            
        }

        $webInfo = C('WEB');
        $this->assign('web',$webInfo);
        $this->assign('title','_'.$webInfo['title']);
        $this->assign('list',$data['list']);
        $this->assign('page',$data['page']);
        $this->display();
    }
    /**
     * 显示视频
     * @return [type] [description]
     */
    public function we(){
        $News = D('News');
        $id = I('get.id', 0, 'intval');
        $info = $News->getWeInfo($id);

        if (!$info) {
            $this->error('文件不存在');die;
        }
        $info['content'] = htmlspecialchars_decode($info['content']);
        //echo $info['content'];die;
        $info['content'] = NewsModel::doVideo($info['content']); //处理视频
        $info['content'] = NewsModel::doImage($info['content']);
        //var_dump($info);die;
        
        $webInfo = C('WEB');
        $this->assign('web',$webInfo);
        $this->assign('title','_'.$webInfo['title']);
        $this->assign('info',$info);
        $this->display('video');
    }
    public function mail() {
        send_mail("zhibin3@qq.com", "zhibin.xie", "测试邮箱", "测试邮件是否能正常发送");
    }

    public function weList()
    {
        $p = I('get.p',1,'intval');
        $News = D('News');
        $list = $News->getWeList([],$p);
        if ($list) {
            foreach ($list['list'] as $key => &$info) {
                $info['content'] = htmlspecialchars_decode($info['content']);
                //echo $info['content'];die;
                $info['content'] = NewsModel::doVideo($info['content']); //处理视频
                $info['content'] = NewsModel::doImage($info['content']);
                $info['published'] = date('Y-m-d',$info['published']);
            }
        }
        $header = [
            'title' => '实况足球',
        ];

        // pre($list);die;
        $this->assign('header',$header);
        $this->assign('list', $list['list']);
        $this->assign('page',$list['page']);
        $this->display('weList');
    }
    /**
     * 生成二维码
     * @author zhibin1
     * @version 2016-09-22
     */
    public  function createQR(){
        $url = I('param.url','','string');
        if(!$url){
            return false;
        }
        $url = 'http://'.$url;
        //Vendor('QRcode.QRcode');
        import('@.ORG.QR');
        $errorCorrectionLevel = 'L';//容错级别 
        $matrixPointSize = 6;//生成图片大小 
        //生成二维码图片 
        QRcode::png($url, false, $errorCorrectionLevel, $matrixPointSize, 2);
    }
    /**
     * 发送邮件验证码
     * @author zhibin1
     * @version 2016-09-13
     * @return  [type]     [description]
     */
    public function sendCode(){
    	$arr = array(
    		'status'=>0,
    		'info' => '发送失败',
    		);
    	if(IS_POST){
    		$email = I('post.email','');
    		if(!preg_match('/^(\w)+(\.\w+)*@(\w)+((\.\w+)+)$/', $email)){
    			$this->error('邮箱错误');die;
    		}
    		$receive_name = 'xx用户';
    		$theme = '希望塔(xwta.net)-验证码';
    		$code = sprintf('%04d',mt_rand(0,9999));
    		$cache = Cache::getInstance();
    		$cache->set($email,$code,3600);
    		$content = '邮箱验证码：'.$code;
    		import('@.ORG.SaeMail');
            $mail = new SaeMail();
            $ret = $mail->quickSend($email, $theme, $content, 'jxxzb2010@sina.cn', 'xie495290930');
    		if(true===$ret){
    			echo json_encode(array('status'=>1,'info'=>'发送成功'));die;
    		}
    	}

    	echo json_encode($arr);
    }

    /**
     * 验证邮箱
     * @author zhibin1
     * @version 2016-09-13
     * @return  [type]     [description]
     */
    public function verifyEmail(){
    	if(IS_POST){
    		$email = I('post.email');
    		$code = I('post.code');

    		$cache = Cache::getInstance();
    		$server_code = $cache->get($email);
    		if($server_code==$code){
                $cache->set($email,NULL); //验证通过后即删除
                M('member')->where(array('email'=>$email))->limit(1)->save(array('verify_status'=>1));
                //echo M('member')->_sql();die;
    			$this->success('success');die;
    		}else{
    			$this->error('error');die;
    		}
    	}
    	$this->display('sendMailCode');
    }
    /**
     * 美女
     * @return [type] [description]
     */
    public function looker(){
        $looker = D('Looker');
        $data = $looker->getList();

        $p = I('get.p',1,'intval');

        $data = $looker->getList();//dump($data);die;

        foreach ($data['data'] as $key => $val) {
            # code...
        }

        $webInfo = C('WEB');
        $this->assign('web',$webInfo);
        $this->assign('title','_'.$webInfo['title']);
        $this->assign('list',$data['data']);
        $this->assign('page',$data['page']);
        $this->display('index');
    }
    /**
     * 脑筋急转弯
     * @return [type] [description]
     */
    public function mind(){

        $Mind = D('Mind');
        $data = $Mind->getList();
        // dump($data);die;
        $webInfo = C('WEB');
        $this->assign('web',$webInfo);
        $this->assign('title','_'.$webInfo['title']);
        $this->assign('list',$data['list']);
        $this->assign('page',$data['page']);
        $this->display();
        
    }

    /**
     * 测试
     * @Author   zhibin1
     * @DateTime 2017-04-06
     * @return   [type]     [description]
     */
    public function test(){

        $this->display();
    }

}