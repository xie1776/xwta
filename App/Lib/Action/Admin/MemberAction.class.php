<?php

class MemberAction extends CommonAction {

    public function index() {
    	$Member = D('Member');
    	$res = $Member->getList();
    	$citys = C('CITYS');

    	$this->assign('citys',$citys);
    	$this->assign('page',$res['page']);
    	$this->assign('list',$res['list']);
        $this->display();
    }

    public function reg(){
    	if(IS_POST){
    		$email = I('post.email');
    		$password = I('post.password');
    		$repass = I('post.repass');
    		$nickname = I('post.nickname');
    		$sex = I('post.sex');

    		if(!$email || !$password || $password!=$repass){
    			$this->error('数据错误');die;
    		}

    		$data = array(
    			'email' => $email,
    			'pwd' => encrypt($password),
    			'reg_date' => time(),
    			'reg_ip' => $_SERVER['REMOTE_ADDR'],
    			'avatar' => 'default.png',
    			'city' => 'bj',
    			);

    		isset($nickname)?$data['nickname'] = $nickname:'';
    		isset($sex)?$data['sex'] = $sex:'';

    		$Member = M('Member');

    		$res = $Member->data($data)->add();

    		if($res){
    			$this->success('注册成功',U('Member/index'));die;
    		}else{
    			$this->error('注册失败');die;
    		}
    	}
    	$this->display();
    }
    /**
     * 积分详情
     * @Author   zhibin1
     * @DateTime 2017-09-17
     * @return   [type]     [description]
     */
    public function balance(){

        $user_id = I('get.user_id',0,'intval');
        if(!$user_id){
            $this->error('用户不存在');die;
        }
        $balance = D('BallAmountLog');
        $data = $balance->getListByUserId($user_id);

        $this->assign('list',$data['list']);
        $this->assign('page',$data['page']);
        $this->display();
    }
    /**
     * 增加积分
     * @Author   zhibin1
     * @DateTime 2017-09-22
     */
    public function addBalance(){
        $id = I('get.id',0,'intval');
        if(!$id){
            $this->error('用户不存在');die;
        }
        if(IS_POST){
            $balance = I('post.balance',0,'intval');
            if(!$balance){
                $this->error('积分错误');die;
            }
            $res = D('BallAmountLog')->addBalanceByAdmin($id,$balance);
            if($res){
                $this->success('增加成功',U('Member/index'));die;
            }else{
                $this->error('增加失败');die;
            }
        }
        $info = M('member')->field('uid,username')->where(array('uid'=>$id))->find();
        $this->assign('info',$info);
        $this->display('addBalance');
    }

}
