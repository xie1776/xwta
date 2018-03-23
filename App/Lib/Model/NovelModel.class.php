<?php 

	class NovelModel extends Model{

		const STATUS_NO = 0;
		const STATUS_COM = 1;

		static $status_list = array(
			self::STATUS_NO => '未完结',
			self::STATUS_COM => '已完结',
			);
	}
	
?>