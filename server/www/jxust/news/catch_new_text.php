<?php
	
	//获取页面传来的新闻编号，暂且叫他编号  我也不知道该叫他什么
	$i = $_GET["i"]-1;
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
	
	$url = "http://www.jxust.cn/list/10-".$p;
	//echo $url;
	$rul = catch_t($url);
	//理工新闻
	preg_match_all('/<div class="article"[\w\W]*?>([\w\W]*?)<\/div>/',$rul,$out0);
	$j_news = $out0[0][0];
	//print_r($j_news);
	preg_match_all('/<a href="([\w\W]*?)"/',$j_news,$out_a); //获取新闻的a链接
	$out_a[1][$i] = 'http://www.jxust.cn'.$out_a[1][$i]; //$out_a[1]为每条新闻的链接
	//将连接重新赋值，进入新闻页面抓取相应的内容
	$url = $out_a[1][$i];
	$rul = catch_t($url);
	preg_match_all('/<p style="text-indent: 2em;"[\w\W]*?>([\w\W]*?)<\/p>/',$rul,$out_news_text);//内容
	preg_match_all('/<h3 style="color:#800000;"[\w\W]*?>([\w\W]*?)<\/h3>/',$rul,$out_news_title);//标题
	preg_match_all('/发布：([\w\W]*?)&nbsp/',$rul,$out_news_name);//发布者
	preg_match_all('/日期： ([\w\W]*?) &nbsp/',$rul,$out_news_time);//日期
	preg_match_all('/src="\/html\/photo\/([\w\W]*?)" align="center" width="800"\/>/',$rul,$out_news_img);//图片地址
	$long = count($out_news_img[1]);
	for($j=0;$j<$long;$j++){
		$out_news_img[1][$j] = 'http://www.jxust.cn/html/photo/'.$out_news_img[1][$j];
	}
	
	preg_match_all('/<p align="center"[\w\W]*?>([\w\W]*?)<\/p>/',$rul,$out_news_alt);//图片标题

?>






