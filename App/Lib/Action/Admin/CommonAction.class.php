<?php
//后台基类
class CommonAction extends BaseAction {

    public $loginMarked;
    protected $login_page = '';

    /**
      +----------------------------------------------------------
     * 初始化
     * 如果 继承本类的类自身也需要初始化那么需要在使用本继承类的类里使用parent::_initialize();
      +----------------------------------------------------------
     */
    public function _initialize() {
        header("Content-Type:text/html; charset=utf-8");
        //header('Content-Type:application/json; charset=utf-8');
        $this->login_page = U('/admin/Public/index');
        $token = C('TOKEN');
        $this->loginMarked = md5($token['admin_marked']);
        $this->checkLogin();
        // 用户权限检查

        if (C('USER_AUTH_ON') && !in_array(MODULE_NAME, explode(',', C('NOT_AUTH_MODULE')))) {
            import('ORG.Util.RBAC');
            if (!RBAC::AccessDecision()) {
                //检查认证识别号
                if (!$_SESSION [C('USER_AUTH_KEY')]) {
                    //跳转到认证网关
                    redirect(C('USER_AUTH_GATEWAY'));
                    //redirect(PHP_FILE . C('USER_AUTH_GATEWAY'));
                }
                // 没有权限 抛出错误
                if (C('RBAC_ERROR_PAGE')) {
                    // 定义权限错误页面
                    redirect(C('RBAC_ERROR_PAGE'));
                } else {
                    if (C('GUEST_AUTH_ON')) {
                        $this->assign('jumpUrl', C('USER_AUTH_GATEWAY'));
                    }
                    // 提示错误信息
                    //echo L('_VALID_ACCESS_');
                    $this->error(L('_VALID_ACCESS_'));
                }
            }
        }
        $this->assign("menu", $this->show_menu());
        $this->assign("sub_menu", $this->show_sub_menuV2());
        $this->assign("my_info", $_SESSION['my_info']);
        $this->assign("site", $systemConfig);

        //$this->getQRCode(); //关闭生成二维码
    }

    protected function getQRCode($url = NULL) {
        if (IS_POST) {
            $this->assign("QRcodeUrl", "");
        } else {
            //$url = empty($url) ? C('WEB_ROOT') . $_SERVER['REQUEST_URI'] : $url;
            $url = empty($url) ? C('WEB_ROOT') . U(MODULE_NAME . '/' . ACTION_NAME) : $url;
            import('@.ORG.QRCode');
            $QRCode = new QRCode('', 80);
            $QRCodeUrl = $QRCode->getUrl($url);
            $this->assign("QRcodeUrl", $QRCodeUrl);
        }
    }

    public function checkLogin() {
        if (isset($_COOKIE[$this->loginMarked])) {
            $cookie = explode("_", $_COOKIE[$this->loginMarked]);
            $timeout = C("TOKEN");
            if (time() > (end($cookie) + $timeout['admin_timeout'])) {
                setcookie("$this->loginMarked", NULL, -3600, "/");
                unset($_SESSION[$this->loginMarked], $_COOKIE[$this->loginMarked]);
                $this->error("登录超时，请重新登录", $this->login_page);
            } else {
                if ($cookie[0] == $_SESSION[$this->loginMarked]) {
                    setcookie("$this->loginMarked", $cookie[0] . "_" . time(), 0, "/");
                } else {
                    setcookie("$this->loginMarked", NULL, -3600, "/");
                    unset($_SESSION[$this->loginMarked], $_COOKIE[$this->loginMarked]);
                    $this->error("帐号异常，请重新登录", $this->login_page);
                }
            }
        } else {
            // echo $this->login_page;die;
            redirect($this->login_page);
        }
        return TRUE;
    }

    /**
      +----------------------------------------------------------
     * 验证token信息
      +----------------------------------------------------------
     */
    protected function checkToken() {
        if (IS_POST) {
            if (!M("Admin")->autoCheckToken($_POST)) {
                die(json_encode(array('status' => 0, 'info' => '令牌验证失败')));
            }
            unset($_POST[C("TOKEN_NAME")]);
        }
    }

    /**
      +----------------------------------------------------------
     * 显示一级菜单
      +----------------------------------------------------------
     */
    private function show_menu() {
        $cache = C('admin_big_menu');
        $cache_sub = C('admin_sub_menu');
        $count = count($cache);
        $i = 1;
        $menu = "";

        $current = MODULE_NAME.'/'.ACTION_NAME;
        foreach ($cache_sub as $key => $val) {
            foreach ($val as $k => $v) {
                if(is_array($v)){
                    //var_dump($current,$v);die;
                    if(array_key_exists($current, $v)){
                        $module = $key;
                        break;
                    }else{
                        if(MODULE_NAME == $k){
                            $module = $key;
                            break;
                        }
                    }
                }else{
                    if($k == $current){
                        $module = $key;
                        break;
                    }
                }
            }
        }
        unset($key,$val,$k,$v);

        !isset($module) && $module = MODULE_NAME;
        //echo $module;die;
        foreach ($cache as $url => $name) {
            if ($i == 1) {
                $css = $url == $module || !$cache[$module] ? "fisrt_current" : "fisrt";
                $menu.='<li class="' . $css . '"><span><a href="' . U('/admin/'.$url . '/index') . '">' . $name . '</a></span></li>';
            } else if ($i == $count) {
                $css = $url == $module ? "end_current" : "end";
                $menu.='<li class="' . $css . '"><span><a href="' . U('/admin/'.$url . '/index') . '">' . $name . '</a></span></li>';
            } else {
                $css = $url == $module ? "current" : "";
                $menu.='<li class="' . $css . '"><span><a href="' . U('/admin/'.$url . '/index') . '">' . $name . '</a></span></li>';
            }
            $i++;
        }
        unset($url,$name);
        return $menu;
    }

    /**
      +----------------------------------------------------------
     * 显示二级菜单
      +----------------------------------------------------------
     */
    private function show_sub_menu() {
        $big = MODULE_NAME == "Index" ? "Common" : MODULE_NAME;
        $cache = C('admin_sub_menu');
        $sub_menu = array();
        if ($cache[$big]) {
            $cache = $cache[$big];
            foreach ($cache as $url => $title) {
                $url = $big == "Common" ? $url : "$big/$url";
                $sub_menu[] = array('url' => U("$url"), 'title' => $title);
            }
            return $sub_menu;
        } else {
            return $sub_menu[] = array('url' => '#', 'title' => "该菜单组不存在");
        }
    }

    /**
     * 显示二级菜单V2
     * @author zhibin1
     * @version 2016-09-21
     * @return  [type]     [description]
     */
    private function show_sub_menuV2(){

        $cache = C('admin_sub_menu');
        $sub_menu = array();
        $current = MODULE_NAME.'/'.ACTION_NAME;

        foreach ($cache as $key => $val) {
            foreach ($val as $k => $v) {
                if(is_array($v)){
                    //var_dump($current,$v);die;
                    if(array_key_exists($current, $v)){
                        $menu = $key;
                        break;
                    }else{
                        if(MODULE_NAME == $k){
                            $menu = $key;
                            break;
                        }
                    }
                }else{
                    if($k == $current){
                        $menu = $key;
                        break;
                    }
                }
            }
        }
        unset($key,$val,$k,$v);
        //echo $menu;die;

        !isset($menu) && $menu = MODULE_NAME;

        if($cache[$menu]){
            $i = 0;
            foreach ($cache[$menu] as $url => $title) {
                
                if(strpos($url, '/')!==false){
                    $url = U('/admin/'.$url);
                    $sub_menu[$i] = array('url' => $url, 'title' => $title);
                }else{
                    if(is_array($title)){
                        $sub_menu[$i] = array('url' => 'javascript:;', 'title' => $title['name'], 'sub' => array());
                        foreach ($title as $k => $v) {
                            if($k!='name')
                                $sub_menu[$i]['sub'][] = array('url' => U('/admin/'.$k), 'title' => $v);
                        }
                    }
                }
                $i++;
            }
            unset($url,$title,$k,$v);
            return $sub_menu;
        }else{
            //return $sub_menu[] = array('url' => '#', 'title' => "nobody");
        }
        return $sub_menu = array();
    }

}