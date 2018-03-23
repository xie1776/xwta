<?php
	
	//ob_start();
	
	/**
	 * php cli执行
	 * php index.php -c 控制器(Index) -a 方法名(index)
	 */
	if (php_sapi_name()=='cli') {
		$param = getopt('c:a:');
		$controller = $param['c'];
		$action = $param['a'];
		$_GET['s'] = $controller.'/'.$action;
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

