<?php  
	class File{
		private static $fp;

		/**
		 *  保存数据
		 * @author: zhibin1.xie
		 * @version 2016-12-30
		 * @param   [type]     $filename [description]
		 * @param   [type]     $data     [description]
		 * @param   string     $mode     [description]
		 * @return  [type]               [description]
		 */
		public static  function save($filename,$data,$mode='a+'){
			self::_buildFile($filename,$mode);
			if(is_array($data))
				$data = json_encode($data);
			fwrite(self::$fp, $data."\r\n");
			fclose(self::$fp);
		}
		/**
		 * 创建文件
		 * @author: zhibin1.xie
		 * @version 2016-12-30
		 * @param   [type]     $filename [description]
		 * @return  $mode r+ 覆盖式读取 a+ 追加式添加
		 */
		private static function _buildFile($filename,$mode){
			self::$fp = fopen($filename, $mode);
		}
		/**
		 * 读取文件内容
		 * @author: zhibin1.xie
		 * @version 2016-12-30
		 * @param   [type]     $file [description]
		 * @return  [type]           [description]
		 */
		public static function read($file){
			return file_get_contents($file);
		}

	}
?>