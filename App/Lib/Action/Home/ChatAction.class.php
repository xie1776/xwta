<?php

/**
 * chat客户端控制器
 */

class ChatAction extends BaseAction
{
	/**
	 * chat客户端入口
	 * @Author xiezhibin  <xiezhibin@yuanxin-inc.com>
	 * @Date   2018-03-23
	 * @return [type]     [description]
	 */
	public function index()
	{
		$server = C('CHAT');

		$this->assign('server', $server['server']);
		$this->assign('port', $server['port']);
		$this->display('index');
	}
}