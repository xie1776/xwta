<?php

class RedisMan
{
	public $redis = null;
	public function __construct()
	{
		$config = C('REDIS');
		$this->redis = new Redis();
		$this->redis->connect($config['server'], $config['port']);
	}
}