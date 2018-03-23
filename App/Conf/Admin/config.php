<?php

return array(
    'admin_big_menu' => array(
        'Index' => '首页',
        'Member' => '用户管理',
        'News' => '资讯管理',
        'SysData' => '数据管理',
        'Access' => '权限管理',
        'Site' => '站点管理',
        'Novel' => '小说管理',
        'BallOrder' => '彩票管理',
    ),
    'admin_sub_menu' => array(
        'Index' => array(
            'Index/myInfo' => '修改密码',
            'Index/cache' => '缓存清理',
            'News/add' => '新闻发布'
        ),
        'Site' => array(
            'Site/index' => '站点配置',
            'Site/setEmailConfig' => '邮箱配置',
            'Site/setSafeConfig' => '安全配置',
            'City' => array(
                'name' => '城市管理',
                'City/index' => '城市列表',
                'City/add' => '城市新增',
                ),
            'Site/forbid' => '访问ip黑名单',
            'Site/showVis' => '访问列表',
        ),
        'Member' => array(
            'Member/index' => '用户列表',
            'Member/reg' => '新增用户',
        ),
        'News' => array(
            'News' => array(
                'name' => '新闻管理',
                'News/index' => '新闻列表',
                'News/add' => '发布新闻',
                ),
            'Article' => array(
                'name' => '文章管理',
                'Article/index' => '文章列表',
                ),
            'News/category' => '分类管理',
            'Amusement' => array(
                'name' => '娱乐管理',
                'Amusement/word' => '文字笑话',
                'Amusement/joke' => '搞笑图片',
                'Amusement/looker' => '美女图片',
                'Amusement/mind' => '脑筋急转弯',
                // 'Amusement/jokeOne' => '搞笑一句话',
                ),
            
        ),
        'SysData' => array(
            'SysData/index' => '数据库备份',
            'SysData/restore' => '数据库导入',
            'SysData/zipList' => '数据库压缩包',
            'SysData/repair' => '数据库优化修复'
        ),
        'Access' => array(
            'Access/index' => '后台用户',
            'Access/addAdmin' => '添加用户',
            'Access/nodeList' => '节点管理',
            'Access/addNode' => '添加节点',
            'Access/roleList' => '角色管理',
            'Access/addRole' => '添加角色',
        ),
        'Novel' => array(
            'Novel/index' => '小说列表',
            'Novel/toLead' => '导入',
            ),
        'BallOrder' => array(
            'BallOrder/index' => '投注列表',
            'BallOrder/income' => '彩票财务',
            ),
    ),
    /*
     * 以下是RBAC认证配置信息
     */
    'USER_AUTH_ON' => true,
    'USER_AUTH_TYPE' => 2, // 默认认证类型 1 登录认证 2 实时认证
    'USER_AUTH_KEY' => 'authId', // 用户认证SESSION标记
    //'ADMIN_AUTH_KEY' => '448188161@qq.com',
    'USER_AUTH_MODEL' => 'Admin', // 默认验证数据表模型
    'AUTH_PWD_ENCODER' => 'md5', // 用户认证密码加密方式encrypt
    'USER_AUTH_GATEWAY' => '/index.php/Admin/Public/index', // 默认认证网关
    'NOT_AUTH_MODULE' => 'Public', // 默认无需认证模块 多个操作以逗号(,)链接 
    'REQUIRE_AUTH_MODULE' => '', // 默认需要认证模块
    'NOT_AUTH_ACTION' => '', // 默认无需认证操作 多个操作以逗号(,)链接 
    'REQUIRE_AUTH_ACTION' => '', // 默认需要认证操作
    'GUEST_AUTH_ON' => false, // 是否开启游客授权访问
    'GUEST_AUTH_ID' => 0, // 游客的用户ID
    'RBAC_ROLE_TABLE' => $DB_PREFIX . 'role',
    'RBAC_USER_TABLE' => $DB_PREFIX . 'role_user',
    'RBAC_ACCESS_TABLE' => $DB_PREFIX . 'access',
    'RBAC_NODE_TABLE' => $DB_PREFIX . 'node',
    /*
     * 系统备份数据库时每个sql分卷大小，单位字节
     */
    'sqlFileSize' => 5242880, //该值不可太大，否则会导致内存溢出备份、恢复失败，合理大小在512K~10M间，建议5M一卷
    //10M=1024*1024*10=10485760
    //5M=5*1024*1024=5242880
    

);

?>