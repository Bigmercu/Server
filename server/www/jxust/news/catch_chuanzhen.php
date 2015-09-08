<?php
$p = isset($_GET["page"])?$_GET["page"]:"1";
//初始化一个curl
function catch_t($url){
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_HEADER, 0);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	$data = curl_exec($curl);
	curl_close($curl);
	return $data;
}
$url = "http://www.jxust.cn/list/11-".$p;
$rul = catch_t($url);
//理工新闻
preg_match_all('/<div class="article"[\w\W]*?>([\w\W]*?)<\/div>/',$rul,$out0);
$j_news = $out0[0][0];
//print_r($j_news);
preg_match_all('/<a href="([\w\W]*?)"/',$j_news,$out_a); //获取新闻的a链接
$a = count($out_a[1]);
for($i=0;$i<$a;$i++){
	$out_a[1][$i] = 'http://www.jxust.cn'.$out_a[1][$i]; //$out_a[1]为每条新闻的链接
}
preg_match_all('/<a href=[\w\W]*?>([\w\W]*?)<\/a>/',$j_news,$out_tops);
$j_news_top1 = $out_tops[1][0]; //热点新闻1
$j_news_top2 = $out_tops[1][1]; //热点新闻2
preg_match_all('/<a href=[\w\W]*?>([\w\W]*?)<\/a>/',$j_news,$out_news);
$j_news_all = $out_tops[1];
$str = array();
//用空值来替换掉日期
for($i=0;$i<=count($out_news[1]);$i++){
	@preg_match_all('/\[([\w\W]*?)\]/',$out_news[1][$i],$str[$i]);
	$str[$i] = $str[$i][0];
	//echo $str[$i];
	@$j_news_all[$i] = str_replace($str[$i], '', $out_news[1][$i]);
	//print_r($j_news_all[$i]);
}
//var_dump($str[0][0]);


?>


















