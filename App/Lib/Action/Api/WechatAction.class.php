<?php
    error_reporting(0);
    define("TOKEN", "laijiemi");

	class WechatAction extends ApiAction{
		public $res_content = array(
                '啥呀',
                '有点不明白哦...亲，建议您换一个问题',
                '说话要说重点。',
                '我如果点头你又看不到。',
                '我都被你问住了，请你换个问题，我就能理解了',
                '说什么？',
                '哦',
                '说来就来',
            );
		public function index(){
			// $this->valid(); //第一次需要对接口进行验证
			$this->responseMsg(); //消息处理
		}

	    //接口对接验证 首次需要进行接口验证
	    public function valid()
	    {
	        $echoStr = $_GET["echostr"];
	        //valid signature , option
	        if($this->checkSignature()){
	            echo $echoStr;
	            //exit;
	        }
	    }
	    //验证详细方法
		private function checkSignature()
		{
	        // you must define TOKEN by yourself
	        if (!defined("TOKEN")) {
	            throw new Exception('TOKEN is not defined!');
	        }
	        
	        $signature = $_GET["signature"];
	        $timestamp = $_GET["timestamp"];
	        $nonce = $_GET["nonce"];
	        		
			$token = TOKEN;
			$tmpArr = array($token, $timestamp, $nonce);
	        // use SORT_STRING rule
			sort($tmpArr, SORT_STRING);
			$tmpStr = implode( $tmpArr );
			$tmpStr = sha1( $tmpStr );
			
			if( $tmpStr == $signature ){
				return true;
			}else{
				return false;
			}
		}
		//判断消息类型并调用回复方法
	     public function responseMsg()
	    {
	        //get post data, May be due to the different environments
	        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

	        //extract post data
	        if (!empty($postStr)){
	                
	                $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
	                $RX_TYPE = trim($postObj->MsgType);

	                switch($RX_TYPE)
	                {
	                    case "text":
	                        $resultStr = $this->handleText($postObj);
	                        break;
	                    case "event":
	                        $resultStr = $this->handleEvent($postObj);
	                        break;
	                    default:
	                        $resultStr = $this->otherReponse($postObj,$RX_TYPE);
	                        break;
	                }
	                echo $resultStr;
	        }else {
	            echo "";
	            exit;
	        }
    }
    //文本回复
    public function handleText($postObj){
        
        $fromUsername = trim($postObj->FromUserName); //代表用户
        $toUsername = trim($postObj->ToUserName); //代表自己
        $keyword = trim($postObj->Content);

        $time = time();
        $data = array(
        		'ToUserName' => $toUsername, 
                'FromUserName' => $fromUsername, 
                'CreateTime' => trim($postObj->CreateTime),
                'MsgType' => trim($postObj->MsgType),
                'Content' => $keyword,
                'MsgId' => trim($postObj->MsgId),
        	);
        // D('Wechat')->addData($data); //接收到信息写入到数据库中
        //file_put_contents('sql.txt', D('Wechat')->_sql()."\n".var_export($postObj,true)."\n");
        //文本消息
        $textTpl = "<xml>
                    <ToUserName><![CDATA[%s]]></ToUserName>
                    <FromUserName><![CDATA[%s]]></FromUserName>
                    <CreateTime>%s</CreateTime>
                    <MsgType><![CDATA[%s]]></MsgType>
                    <Content><![CDATA[%s]]></Content>
                    <FuncFlag>0</FuncFlag>
                    </xml>";
        //图文消息
        $imgTpl = "<xml>
                        <ToUserName><![CDATA[%s]]></ToUserName>
                        <FromUserName><![CDATA[%s]]></FromUserName>
                        <CreateTime>%s</CreateTime>
                        <MsgType><![CDATA[news]]></MsgType>
                        <ArticleCount>1</ArticleCount>
                        <Articles>
                            <item>
                            <Title><![CDATA[%s]]></Title> 
                            <Description><![CDATA[%s]]></Description>
                            <PicUrl><![CDATA[%s]]></PicUrl>
                            <Url><![CDATA[%s]]></Url>
                            </item>
                        </Articles>
                    </xml>"; 
        //图片消息
        $only_imgTpl = "<xml>
                            <ToUserName><![CDATA[%s]]></ToUserName>
                            <FromUserName><![CDATA[%s]]></FromUserName>
                            <CreateTime>%s</CreateTime>
                            <MsgType><![CDATA[image]]></MsgType>
                            <Image>
                                <MediaId><![CDATA[%s]]></MediaId>
                            </Image>
                    </xml>";  //MediaId 通过素材管理接口上传多媒体文件，得到的id
        if(!empty( $keyword ))
        {
            $msgType = "text";
            //天气
            $str = mb_substr($keyword,-2,2,"UTF-8");
            $str_key = mb_substr($keyword,0,-2,"UTF-8");
            
            if($str == '天气' && !empty($str_key)){
                $data = $this->weather($str_key);
                if(empty($data->weatherinfo)){
                    $contentStr = "抱歉，没有查到\"".$str_key."\"的天气信息！";
                } else {
                    $contentStr = "【".$data->weatherinfo->city."天气预报】"."\n".$data->weatherinfo->ptime."时发布\n".$data->weatherinfo->weather."\n最高温度 ".$data->weatherinfo->temp1."\n最低温度".$data->weatherinfo->temp2;
                }
            }

            //查看揭秘
            /*
            else if((strpos($keyword,'揭秘')!==false) || $keyword==3){
                $where = array(
                        'status' =>1,
                    );
                $art = M('article')->where($where)->order('rand()')->find();
                
                $art['content'] = strip_tags($art['content']); //过滤掉html标签
                $art['content'] = trim($art['content']);
                $art['content'] = trim($art['content'],'&nbsp;');
                if(mb_strlen($art['content'],'UTF-8')>80){
                    $content = mb_substr($art['content'], 0, 79,'UTF-8').'...';
                }else{
                    $content = $art['content'];
                }
                //输出图片
                $img_url = 'http://www.laijiemi.cn/Public/uploads/'.$art['pic_url'];
                if(!@fopen($img_url,'r')){ //判断图片是否存在
                    $img_url = 'http://www.laijiemi.cn/Public/images/ad3.png';
                }

                $result_img = sprintf($imgTpl, $fromUsername, $toUsername, $time, $art['title'], $content, $img_url, 'http://m.laijiemi.cn/article/'.$art['id'].'.html');
                echo $result_img;die;
                //$contentStr = "【".$art['title']."】"."\n"." ".$content." <a href='http://laijiemi.sinaapp.com'>点击查看</a>";
                
            }
            */
            //查看搞笑图片
            else if((strpos($keyword,'搞笑')!==false) || $keyword==1)
            {
                $where = array(
                    'type' => JokeModel::TYPE_IMG,
                    );
                $joke = D('Joke')->where($where)->order('rand()')->find();
                $result_img = sprintf($imgTpl, $fromUsername, $toUsername, $time, $joke['title'], $joke['title'], $joke['img'], 'http://dwto.99meiti.com/Joke/detail/id/'.$joke['id']);
                echo $result_img;exit;
            }
            //处理评论
            else if(mb_substr($keyword,0,3,"UTF-8")=='评论:'){
                $data['aid'] = $art['id'];
                $data['content'] = $this->filter_words($keyword);
                //$data['content'] = $keyword;
                $data['add_time'] = date('Y-m-d H:i:s',time());
                $data['ip'] = $_SERVER['REMOTE_ADDR'];
                $com_model = M('comment');
                if($com_model->data($data)->add()){
                    $contentStr = '发表成功';
                }else{
                    $contentStr = '发表失败';
                }
            }
            //查看美女图片
            else if((strpos($keyword,'美女')!==false) || $keyword==2)
            {
                $looker = D('Looker')->order('rand()')->find();
                $result_img = sprintf($imgTpl, $fromUsername, $toUsername, $time, $looker['title'], $looker['title'], $looker['picUrl'], 'http://dwto.99meiti.com/Joke/lookerDetail/id/'.$looker['id']);
                //$result_img = sprintf($only_imgTpl, $fromUsername, $toUsername, $time, 'http://m.laijiemi.cn/index.php/Looker/detail/id/'.$looker['id'],'1234567890123456');
                echo $result_img;die;
            }
            
            //查看笑话
            else if((strpos($keyword,'笑话')!==false) || $keyword==4)
            {
                $where = array(
                    'type' => JokeModel::TYPE_WORD,
                    );
                $joke = D('Joke')->where($where)->order('rand()')->find();
                $replace = array(
                    '<p>' => '',
                    //'</p>' => "\n",
                    '</p>' => '',
                    "\n\n" => "\n",
                    '<br/>' => "\n";
                    );
                $content = strtr($joke['content'], $replace);
                $content = trim($content);
                file_put_contents('content.txt', $joke['content']);
                $result_img = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $content);
                echo $result_img;die;
            }

            //其他消息
            else{
                //每个用户一个id
                import('@.Service.ApiService');
                $api = new ApiService();
                $res = json_decode($api->chat($keyword,$fromUsername),true);
                if($res['showapi_res_body']['code']==100000 && !empty($res['showapi_res_body']['text']))
                    $contentStr = $res['showapi_res_body']['text'];
                else{
                    $rand_key = array_rand($this->res_content);
                    $contentStr = $this->res_content[$rand_key];
                }
            }
            $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
            echo $resultStr;
        }else{
            echo "Input something...";
        }
    }
    //事件回复
    public function handleEvent($object){
        $contentStr = "";
        switch ($object->Event)
        {
            case "subscribe":
                $contentStr = "感谢您关注【来揭秘】"."\n"."微信号：laijiemi01"."\n"."目前平台功能如下："."\n"."1、查天气，如输入：北京天气"."\n"."2、揭秘，输入：揭秘或3"."\n"."3、搞笑图片,输入：搞笑或1"."\n"."4、美女图片，输入：美女或2";
                break;
            default :
                $contentStr = "Unknow Event: ".$object->Event;
                break;
        }
        $resultStr = $this->responseText($object, $contentStr);
        return $resultStr;
    }

    /**
     * 其他类型回复
     * @author: zhibin1.xie
     * @version 2016-12-20
     * @return  [type]     [description]
     */
    public function otherReponse($object,$RX_TYPE){

        $resultStr = $this->responseText($object, "Unknow msg type: ".$RX_TYPE);
        return $resultStr;
    }
    
    public function responseText($object, $content, $flag=0)
    {
        $textTpl = "<xml>
                    <ToUserName><![CDATA[%s]]></ToUserName>
                    <FromUserName><![CDATA[%s]]></FromUserName>
                    <CreateTime>%s</CreateTime>
                    <MsgType><![CDATA[text]]></MsgType>
                    <Content><![CDATA[%s]]></Content>
                    <FuncFlag>%d</FuncFlag>
                    </xml>";
        $resultStr = sprintf($textTpl, $object->FromUserName, $object->ToUserName, time(), $content, $flag);
        return $resultStr;
    }
    //天气查询
    private function weather($n){
        include("weather_cityId.php");
        $c_name=$weather_cityId[$n];
        if(!empty($c_name)){
            $json=file_get_contents("http://www.weather.com.cn/adat/cityinfo/".$c_name.".html");
            //{"weatherinfo":{"city":"北京","cityid":"101010100","temp1":"15℃","temp2":"5℃","weather":"多云","img1":"d1.gif","img2":"n1.gif","ptime":"08:00"}}
            //http://m.weather.com.cn/img/d1.gif
            return json_decode($json);
        } else {
            return null;
        }
    }
 

    //小九机器人
    public function xiaojo($keyword){

        $curlPost=array("chat"=>$keyword);
        $ch = curl_init();//初始化curl
        curl_setopt($ch, CURLOPT_URL,'http://www.xiaojo.com/bot/chata.php');//抓取指定网页
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_HEADER, 0);//设置header
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//要求结果为字符串且输出到屏幕上
        curl_setopt($ch, CURLOPT_POST, 1);//post提交方式
        curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);
        $data = curl_exec($ch);//运行curl
        curl_close($ch);
        if(!empty($data)){
            return $data;
        }else{
            $ran=rand(1,4);
            switch($ran){
                case 1:
                    return "小鸡鸡今天累了，明天再陪你聊天吧。";
                    break;
                case 2:
                    return "小鸡鸡睡觉喽~~";
                    break;
                case 3:
                    return "呼呼~~呼呼~~";
                    break;
                case 4:
                    return "你话好多啊，不跟你聊了";
                    break;
                default:
                    return "感谢您关注【来揭秘】"."\n"."微信号：laijiemi01";
                    break;
            }
        }
    }


}
?>