<?php  
	/**
	 * 测试类
	 */
	class TestAction extends HomeAction{

		/**
		 * 测试发邮件
		 * @Author   zhibin
		 * @DateTime 2017-09-20
		 * @return   [type]     [description]
		 */
		public function send_email(){
		    if(IS_POST){
		    	$config = C('EMAIL');
			    // C('TOKEN_ON', false);
		        $return = send_mail($_POST['to'], $_POST['name'], '这是标题', "这是邮件内容", "", $config);
		        if ($return == 1) {
		            echo json_encode(array('status' => 1, 'info' => "测试邮件已经发往你的邮箱" . $_POST['to'] . "中，请注意查收"));
		        } else {
		            echo json_encode(array('status' => 0, 'info' => "$return"));
		        }
		    }
	    }
	    /**
	     * 小程序接口数据
	     * @Author   zhibin
	     * @DateTime 2017-09-28
	     * @return   [type]     [description]
	     */
	    public function index(){

	    	$arr = array(
	    		['title'=>'Hi,a'],
	    		['title'=>'Hi,b'],
	    		['title'=>'Hi,c'],
	    		['title'=>'Hi,d'],
	    		['title'=>'Hi,e'],
	    		);

	    	$this->jsonReturn(1000,'SUCCESS',$arr);
	    }


	    public function uniCode(){
	    	$len = 100000;
	    	$len_arr = [];
	    	for($i=0; $i<$len; $i++){
    			$key = sprintf('%x',crc32(microtime().rand(0,99999)));
    			$len_arr[$key] = 1;
    		}
    		echo '长度：'.$len.'<br/>';
    		echo '结果长度：'.count($len_arr);
	    }


	}
?>