<?php
	
	//ob_start();
	
	//判断执行方式
	if (php_sapi_name()=='cli') {
		$param = getopt('c:a:');
		$controller = $param['c'];
		$action = $param['a'];
		$_GET['s'] = $controller.'/'.$action;
		// echo $controller.'-'.$action;die;
	}

	ini_set('date.timezone', 'Asia/Shanghai');

	!isset($_SERVER['product']) && $_SERVER['product'] = 0;
	define('PRODUCT',$_SERVER['product']);//设置本地还是线上环境

	define('APP_NAME', 'App');
	define('APP_PATH', './App/');
	PRODUCT != 1 ? define('APP_DEBUG', true) : define('APP_DEBUG', true);
	//网站当前路径
	//define("RUNTIME_PATH", SITE_PATH . "/Cache/Runtime/Home/");
	define('RUNTIME_PATH','./Runtime/');
	define('WEB_CACHE_PATH','./Runtime/');

	define('THINK_PATH', './ThinkPHP/');
	define("WEB_ROOT", dirname(__FILE__) . "/");

	require(THINK_PATH . "ThinkPHP.php");

