<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<title>江理微站</title>

<meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="format-detection" content="telephone=no">
<meta charset="utf-8">
<link href="../css/cate.css" rel="stylesheet" type="text/css" />
<link href="../css/iscroll.css" rel="stylesheet" type="text/css" />
<style>
.banner img {width: 100%;}
  .themeStyle{ background-color:#E83407 !important; }  
</style>
<script src="js/iscroll.js" type="text/javascript"></script>
<script type="text/javascript">
var myScroll;

function loaded() {
myScroll = new iScroll('wrapper', {
snap: true,
momentum: false,
hScrollbar: false,
onScrollEnd: function () {
document.querySelector('#indicator > li.active').className = '';
document.querySelector('#indicator > li:nth-child(' + (this.currPageX+1) + ')').className = 'active';
}
 });
 
 
}

document.addEventListener('DOMContentLoaded', loaded, false);
</script>
 
</head>

<body>
<?php include("catch_meiti.php"); ?>
<div class="header">
	<span class="return"><a href="../index.php"><img src="../images/iconfont-fanhui (1).png" width="20"/></a></span>
	<h3>媒体聚焦</h3>
	<span class="home"><a href="../index.php"><img src="../images/iconfont-shouyehome.png" width="25"/></a></span>
</div>

<div class="centent">
	<ul class="newsCent">
		<li>
			<p class="text"><a href="meiti_centent.php?i=1&page=<?php echo $p; ?>"><?php echo $j_news_top1; ?></a></p>
			<span>发布者：党委宣传部</span>
			<span class="time" style="color: red">
			<?php 
				if($p==1){
					echo "号外！";
				}else{
					echo "";
				}
			?>
			</span>
		</li>
		<li>
			<p class="text"><a href="meiti_centent.php?i=2&page=<?php echo $p; ?>"><?php echo $j_news_top2; ?></a></p>
			<span>发布者：党委宣传部</span>
			<span class="time" style="color: red">
			<?php 
				if($p==1){
					echo "号外！";
				}else{
					echo "";
				}
			?>
			</span>
		</li>
		<?php for($i=2;$i<=count($j_news_all)-2;$i++){ ?>
		<li>
			<p class="text"><a href="meiti_centent.php?i=<?php print($i+1); ?>&page=<?php echo $p; ?>"><?php echo $j_news_all[$i]; ?></a></p>
			<span>发布者：党委宣传部</span>
			<span class="time">日期：<?php echo @implode($str[$i]); error_reporting(E_ALL^E_NOTICE); ?></span>
		</li>
		<?php } ?>
	</ul>
</div>
<!--分页-->
<ul class="page">
	<li><a href="meiti.php?page=1">首页</a></li>
	<li><a href="meiti.php?page=<?php if($p>1){print($p-1);}else{print(1);} ?>">上一页</a></li>
	<li><a href="meiti.php?page=<?php print($p+1); ?>">下一页</a></li>
	<li>当前：第<?php echo $p; ?>页</li>
</ul>

  <div class="copyright">
  <br />
  <br />
Copyright © 2014-2015 <a href="http://www.jxust.cn/">江西理工大学</a> All rights reserved.</div>
<br>
<br>
<script>
function displayit(n){
	for(i=0;i<4;i++){
		if(i==n){
			var id='menu_list'+n;
			if(document.getElementById(id).style.display=='none'){
				document.getElementById(id).style.display='';
				document.getElementById("plug-wrap").style.display='';
			}else{
				document.getElementById(id).style.display='none';
				document.getElementById("plug-wrap").style.display='none';
			}
		}else{
			if($('#menu_list'+i)){
				$('#menu_list'+i).css('display','none');
			}
		}
	}
}
function closeall(){
	var count = document.getElementById("top_menu").getElementsByTagName("ul").length;
	for(i=0;i<count;i++){
		document.getElementById("top_menu").getElementsByTagName("ul").item(i).style.display='none';
	}
	document.getElementById("plug-wrap").style.display='none';
}

document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {
	WeixinJSBridge.call('hideToolbar');
});
</script> 
<style type="text/css">
body { margin-bottom:60px !important; }
a, button, input { -webkit-tap-highlight-color:rgba(255, 0, 0, 0); }
ul, li { list-style:none; margin:0; padding:0 }
.top_bar { position: fixed; z-index: 900; bottom: 0; left: 0; right: 0; margin: auto; font-family: Helvetica, Tahoma, Arial, Microsoft YaHei, sans-serif; }
.top_menu { display:-webkit-box; border-top: 1px solid #b3b3b3; display: block; width: 100%; background: rgba(255, 255, 255, 0.7); height: 48px; display: -webkit-box; display: box; margin:0; padding:0; -webkit-box-orient: horizontal; background: -webkit-gradient(linear, 0 0, 0 100%, from(#e7e4e7), to(#b9b9b9)); }
.top_bar .top_menu>li { -webkit-box-flex:1; background: -webkit-gradient(linear, 0 0, 0 100%, from(rgba(0, 0, 0, 0.1)), color-stop(50%, rgba(0, 0, 0, 0.2)), to(rgba(0, 0, 0, 0.2))), -webkit-gradient(linear, 0 0, 0 100%, from(rgba(255, 255, 255, 0.1)), color-stop(50%, rgba(255, 255, 255, 0.3)), to(rgba(255, 255, 255, 0.1))); -webkit-background-size:1px 100%, 1px 100%; background-size:1px 100%, 1px 100%; background-position: 1px center, 2px center; background-repeat: no-repeat; position:relative; text-align:center; }
.top_menu>li:first-child { background:none; }
.top_bar .top_menu>li>a { height:48px; line-height: 48px; display:block; text-align:center; color:#4f4d4f; text-shadow: 0 1px rgba(255, 255, 255, 0.3); text-decoration:none; border-top: 1px solid #f9f9f9; -webkit-box-flex:1; }
.top_bar .top_menu>li>a label { overflow:hidden; margin: 0 0 0 0; font-size: 12px; display: block !important; line-height: 18px; text-align: center; }
.top_bar .top_menu>li>a img { margin: 2px 0 0 0; height: 24px; width: 24px; color: #fff; line-height: 48px; vertical-align:middle; }
.top_bar li:first-child a { display: block; }
.menu_font { padding: 0; position: absolute; z-index: 500; bottom: 60px; right: 10px; width: 120px; background: #e4e3e2; border: 1px solid #afaeaf; border-radius: 5px; box-shadow: 0 1px 5px rgba(0, 0, 0, 0.2); }
.menu_font.hidden { display:none; }
.top_menu li:last-of-type a { background: none; }
.top_menu>li:last-of-type>a label { padding: 0 0 0 3px; }
.menu_font li:last-of-type { background: none; }
.menu_font li a { text-align: left !important; }
.top_menu li:last-of-type a { background: none; }
.menu_font:before, .menu_font:after { content:""; display:inline-block; position:absolute; z-index:240; bottom:0; left: 85%; margin-left:-8px; margin-bottom:-16px; width:0; height:0; border:8px solid red; border-color:#afaeaf transparent transparent transparent; }
.menu_font:after { z-index:501; border-color:#e4e3e2 transparent transparent transparent; margin-bottom:-15px; margin-left:-8px; }
.menu_font li { background:-webkit-gradient(linear, 0 0, 100% 0, from(#e4e3e2), to(#e4e3e2), color-stop(50%, #f3f3f2)), -webkit-gradient(linear, 0 0, 100% 0, from(#e4e3e2), to(#e4e3e2), color-stop(50%, #c6c5c5)); background-size:100% 1px, 100% 2px; background-repeat:no-repeat; background-position: center bottom; }
.menu_font li:first-of-type { border-top: 0; }
.menu_font li:last-of-type { border-bottom: 0; }
.menu_font li a { height: 40px; line-height: 40px !important; position: relative; color: #fff; display: block; width: 100%; text-indent: 10px; white-space: nowrap; text-overflow: ellipsis; overflow: hidden; text-decoration:none; color:#4f4d4f; text-shadow: 0 1px rgba(255, 255, 255, 0.3); }
.menu_font li a img { width: 20px; height:20px; display: inline-block; margin-top:-2px; color: #fff; line-height: 40px; vertical-align:middle; }
.menu_font>li>a label { padding:3px 0 0 3px; font-size:14px; overflow:hidden; margin: 0; }
#menu_list0 { right:0; left:10px; }
#menu_list0:before, #menu_list0:after { left: 15%; }
#menu_list0:after { margin-bottom:-15px; margin-left:-8px; }
#sharemcover { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.7); display: none; z-index: 20000; }
#sharemcover img { position: fixed; right: 18px; top: 5px; width: 260px; height: 180px; z-index: 20001; border:0; }
.top_bar .top_menu>li>a:hover, .top_bar .top_menu>li>a:active { background-color:#CCCCCC; }
.menu_font li a:hover, .menu_font li a:active { background-color:#CCCCCC; }
.menu_font li:first-of-type a { border-radius:5px 5px 0 0; }
.menu_font li:last-of-type a { border-radius:0 0 5px 5px; }
#plug-wrap { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0); z-index:800; }
#cate18 .device {bottom: 49px;}
#cate18 #indicator {bottom: 240px;}
#cate19 .device {bottom: 49px;}
#cate19 #indicator {bottom: 330px;}
#cate19 .pagination {bottom: 60px;}
</style>
<div class="top_bar" style="-webkit-transform:translate3d(0,0,0)">
  <nav>
    <ul id="top_menu" class="top_menu">
        <li> <a href="news.php"><img src="../images/iconfont-xiaoyuan.png" width="30"><label>理工新闻</label></a></li>
        <li> <a href="chuanzhen.php"><img src="../images/iconfont-xinwen.png" width="30"><label>校园传真</label></a></li>
		<li> <a href="meiti.php"><img src="../images/iconfont-meitibaodao.png" width="30"><label>媒体聚焦</label></a></li>
        <li> <a href="gonggao.php"><img src="../images/iconfont-xinshouxuetang.png" width="30"><label>学校公告</label></a></li>  
    </ul>
  </nav>
</div>
<div id="plug-wrap" onclick="closeall()" style="display: none;"></div> 
<!-- share -->
</body>
</html>
