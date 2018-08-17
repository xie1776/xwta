<?php

    if(PRODUCT != 1){ //测试环境
        $passwd = 'root';
        $trace_show = false;
        $error_msg = false;
        $trace_exce = false;
        $token_on = false;
        $asset_path = 'D:/360/';
    }else{ //线上
        $passwd = 'chenliu123';
        $trace_show = false;
        $error_msg = false;
        $trace_exce = false;
        $token_on = true;
        $asset_path = '/data/Asset/';
    }

return array(
    /* 数据库设置 */
    'DB_DSN'=>'mysql://root:'.$passwd.'@127.0.0.1/xwta',

    /*
    //改用线上数据
    'DB_TYPE'   => 'mysql', // 数据库类型
    'DB_HOST'   => 'rds8e52933d278457rl5.mysql.rds.aliyuncs.com', // 服务器地址
    'DB_NAME'   => 'r00949f37y', // 数据库名
    'DB_USER'   => 'xie1776', // 用户名
    'DB_PWD'    => 'Xie495290930', // 密码
    'DB_PORT'   => 3306, // 端口
    */
    
    'DB_PREFIX'=>'pa_',
    'SHOW_PAGE_TRACE' => $trace_show,
    'SHOW_ERROR_MSG' => $error_msg,
    'TRACE_EXCEPTION' => $trace_exce, //显示错误sql提示 线上请关闭

    'TOKEN_ON' => $token_on, // 是否开启令牌验证
    'TOKEN_NAME' => '__hash__', // 令牌验证的表单隐藏字段名称
    'TOKEN_TYPE' => 'md5', //令牌哈希验证规则 默认为MD5
    'TOKEN_RESET' => FALSE, //令牌验证出错后是否重置令牌 默认为true
    /* 开发人员相关信息 */
    'AUTHOR_INFO' => array(
        'author' => 'zhibin.xie',
        'author_email' => 'zhibin3@qq.com',
    ),

    //分组设置
    'APP_GROUP_LIST' => 'Home,Admin,Lottery,Api,Mall,Touch,Crod,Index', //项目分组设定
    'DEFAULT_GROUP'  => 'Home', //默认分组
    'URL_MODEL' => 2, //分组模式

    'SITE_INFO' => array ( 
        'name' => '通用内容管理系统后台', 
        'keyword' => '内容管理系统', 
        'description' => '分享自己写的php代码和收藏比较好的php代码，点滴PHP记录提升技术能力', 
        ), 
    'WEB_ROOT' => 'http://www.xwta.net/', 
    'AUTH_CODE' => '4Pfk4Z', 
    'ADMIN_AUTH_KEY' => 'admin@admin.com', 


    //站点配置
    'WEB' => array(
        'title' => '一个有关实况足球的视频网站',
        'version' => '1.0',
        'icp' => '454545',
        'email' => 'zhibin3@qq.com',
        'phone' => '0791-5508527',
        'fax' => '0791-5508527',
        'address' => '江西省进贤县',
        'zipcode' => '371111',
        'keywords' => '实况足球,实况足球8,实况,实况足球2017,实况足球2014,pes2017,pes2008',
        'description' => '希望塔(xwta.net)是一个做实况足球精彩进球的视频网站，这里收集了国内外玩家大量的精彩进球视频。爱实况，爱足球；为足球贡献力量！',
        ),

    //服务邮箱配置
    'EMAIL' => array(
        'smtp_host' => 'smtp.sina.cn',
        'smtp_port' => 465, //25
        'from_email' => 'jxxzb2010@sina.cn',
        'from_name' => 'zhibin.xie',
        'smtp_user' => 'jxxzb2010',
        'smtp_pass' => 'xie495290930',
        'reply_email' => '',
        'reply_name' => '',
        'test_email' => '',
        ),

    //安全配置
    'TOKEN' => array ( 
        'admin_marked' => 'zhibin3@qq.com', 
        'admin_timeout' => 3600, 
        'member_marked' => 'http://xwta.net', 
        'member_timeout' => 3600, 
    ),

    'LOAD_EXT_CONFIG' => 'city', //加载配置

    //reweite
    'URL_ROUTER_ON' => true,
    'URL_ROUTE_RULES' =>array(
        'news/:id\d'=>'News/detail',
        'Joke/detail/:id\d' => 'Joke/detail',
    ),

    //自定success与error页面
    'TMPL_ACTION_SUCCESS' => './App/Tpl/Home/Common/jump.html',
    'TMPL_ACTION_ERROR' => './App/Tpl/Home/Common/jump.html',

    'FORBID_FILE' => 'forbid.txt', //记录禁止访问的ip 多个ip以英文逗号分隔

    //开启子域名配置
    'APP_SUB_DOMAIN_DEPLOY'=>1, 
    'APP_SUB_DOMAIN_RULES'=>array(
        // 'lottery' => array('Lottery/'),
        // 'mall' => array('Mall/'),
        // 'admin' => array('Admin/'),
        'dwto' => array('Api/'),
        // 'm' => array('Touch/'),
        ),
    'URL_CASE_INSENSITIVE' =>true, //url不区分大小写

    'ASSET' => [
        'path' => $asset_path,
        'domain' => 'http://asset.xwta.net/',
    ],

    'CHAT' => [
        'server' => '192.168.33.10',
        'port' => '8032',
    ],

    'REDIS' => [
        'server' => '127.0.0.1', //192.168.33.10
        'port' => 6379,
    ],

);


?>