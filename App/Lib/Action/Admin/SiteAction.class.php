<?php

// 本类设置项目一些常用信息
class SiteAction extends CommonAction {

    /**
     * 网站配置信息
     * @author zhibin1
     * @version 2016-09-09
     * @return  [type]     [description]
     */
    public function index() {
        $web = C('WEB');
        $this->assign('site',$web);
        $this->display();
    }

    /**
      +----------------------------------------------------------
     * 配置网站邮箱信息
      +----------------------------------------------------------
     */
    public function setEmailConfig() {
        $web = C('EMAIL');
        $this->assign('site',$web);
        $this->display();
        //stemConfig("SYSTEM_EMAIL");
    }

    /**
      +----------------------------------------------------------
     * 配置网站信息
      +----------------------------------------------------------
     */
    public function setSafeConfig() {
        $web = C('TOKEN');
        $this->assign('token',$web);
        $this->display();
    }

    /**
      +----------------------------------------------------------
     * 网站配置信息保存操作等
      +----------------------------------------------------------
     */
    private function checkSystemConfig($obj = "SITE_INFO") {
        if (IS_POST) {
            $this->checkToken();
            $config = WEB_ROOT . "Common/systemConfig.php";
            $config = file_exists($config) ? include "$config" : array();
            $config = is_array($config) ? $config : array();
            $config = array_merge($config, array("$obj" => $_POST));
            $str = $obj == "SITE_INFO" ? "网站配置信息" : $obj == "SYSTEM_EMAIL" ? "系统邮箱配置" : "安全设置";
            if (F("systemConfig", $config, WEB_ROOT . "Common/")) {
                delDirAndFile(WEB_CACHE_PATH . "Runtime/Admin/~runtime.php");
                if ($obj == "TOKEN") {
                    unset($_SESSION, $_COOKIE);
                    echo json_encode(array('status' => 1, 'info' => $str . '已更新，你需要重新登录', 'url' => __APP__ . '?' . time()));
                } else {
                    echo json_encode(array('status' => 1, 'info' => $str . '已更新'));
                }
            } else {
                echo json_encode(array('status' => 0, 'info' => $str . '失败，请检查', 'url' => __ACTION__));
            }
        } else {
            $this->display();
        }
    }

    /**
      +----------------------------------------------------------
     * 测试邮件账号是否配置正确
      +----------------------------------------------------------
     */
    public function testEmailConfig() {
        C('TOKEN_ON', false);
        $config = C('EMAIL');
        $return = send_mail($_POST['test_email'], "username", '标题', "测试配置是否正确", "这是一封测试邮件，如果收到了说明配置没有问题", "", $config);
        if ($return == 1) {
            echo json_encode(array('status' => 1, 'info' => "测试邮件已经发往你的邮箱" . $_POST['test_email'] . "中，请注意查收"));
        } else {
            echo json_encode(array('status' => 0, 'info' => "$return"));
        }
    }
    /**
     * ip黑名单管理
     * @author: zhibin1.xie
     * @version 2016-12-22
     * @return  [type]     [description]
     */
    public function forbid(){
      $file = WEB_ROOT.C('FORBID_FILE');

      if(IS_POST){
        $forbid = I('post.forbid','','string');
        $res = file_put_contents($file, $forbid);
        if($res){
          $this->success('SUCCESS',U('Site/forbid'));die;
        }
      }
      $forbid = file_get_contents($file);
      $this->assign('forbid',$forbid);
      $this->display('forbid');
    }
    /**
     * 查看访问记录 
     * @author: zhibin1.xie
     * @version 2016-12-22
     * @return  [type]     [description]
     */
    public function showVis(){

      import('ORG.Util.Page');
      $Vis = M('Vis');
      $count = $Vis->where()->count();
      $rows = 20;
      $page = new Page($count,$rows);
      $list = $Vis->where()->limit($page->firstRow,$rows)->order('id desc')->select();

      $this->assign('list',$list);
      $this->assign('page',$page->show());
      $this->display('showVis');
    }


}

?>
