<?php  

include "TopSdk.php";

$appkey = '23663600';
$secret = '3c12c620fb7676368af350fbbd79a91d';

$c = new TopClient;
$c->format = 'json';
$c->appkey = $appkey;
$c->secretKey = $secret;
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
$req->setPageSize("1");
$resp = $c->execute($req);
$resp = json_encode($resp);


echo $resp;
// echo '<pre>';
// print_r($resp);

?>