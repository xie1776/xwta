<?php  

	class TaokeAction extends HomeAction{

		public function __construct(){
			parent::__construct();

			include APP_PATH."/Lib/Libs/taobao_sdk/TopSdk.php";
			$this->appkey = '23663600';
			$this->secret = '3c12c620fb7676368af350fbbd79a91d';
		}
		/**
		 * 淘客商品查询
		 * @Author   zhibin1
		 * @DateTime 2017-10-22
		 * @return   [type]     [description]
		 */
		public function index(){
			

			$c = new TopClient;
			$c->format = 'json';
			$c->appkey = $this->appkey;
			$c->secretKey = $this->secret;
			$req = new TbkItemGetRequest;
			$req->setFields("num_iid,title,pict_url,small_images,reserve_price,zk_final_price,user_type,provcity,item_url,seller_id,volume,nick,tk_tate");
			$req->setQ("女装"); //查询词
			// $req->setCat("16,18");
			// $req->setItemloc("杭州");
			// $req->setSort("tk_rate_des");
			// $req->setIsTmall("true");
			// $req->setIsOverseas("false");
			// $req->setStartPrice("10");
			$req->setEndPrice("10");
			// $req->setStartTkRate("123");
			$req->setEndTkRate("5");
			// $req->setPlatform("1");
			// $req->setPageNo("123");
			$req->setPageSize("10");
			$resp = $c->execute($req);
			$resp = json_encode($resp);


			echo $resp;
			// echo '<pre>';
			// print_r($resp);
		}
		/**
		 * 淘客链接转换
		 * @Author   zhibin1
		 * @DateTime 2017-10-22
		 * @return   [type]     [description]
		 */
		public function clickUrl(){

			$c = new TopClient;
			$c->appkey = $this->appkey;
			$c->secretKey = $this->secret;
			include APP_PATH."/Lib/Libs/taobao_sdk/top/request/TbkItemConvertRequest.php";
			$req = new TbkItemConvertRequest;
			$req->setFields("num_iid,click_url");
			$req->setNumIids("556598911988");
			$req->setAdzoneId("123");
			$req->setPlatform("1");
			// $req->setUnid("demo");
			// $req->setDx("1");
			$resp = $c->execute($req);

			$resp = json_encode($resp);


			echo $resp;
		}

		public function content(){
			$c = new TopClient;
			$c->appkey = $this->appkey;
			$c->secretKey = $this->secret;
			$req = new TbkContentGetRequest;
			$req->setAdzoneId("123");
			// $req->setType("1");
			// $req->setBeforeTimestamp("1491454244598");
			// $req->setCount("10");
			// $req->setCid("2");
			// $req->setImageWidth("300");
			// $req->setImageHeight("300");
			$resp = $c->execute($req);

			$resp = $c->execute($req);

			$resp = json_encode($resp);

		}

	}
?>