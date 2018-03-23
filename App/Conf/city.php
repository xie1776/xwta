<?php  
	
	$cache = Cache::getInstance();
	$key = 'citys';
	$citys = $cache->get($key);

	if(!$citys){
		$City = D('City');

		$list = $City->getList();
		$citys = array();
		foreach ($list as $key => $val) {
			$citys[$val['code']] = $val['name'];
		}
		unset($key,$val);
		$cache->set($key,$citys,24*3600);
	}

	return array(
		'CITYS' => $citys,
		);
?>