<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<title>江理微站</title>

<meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="format-detection" content="telephone=no">
<meta charset="utf-8">
<link href="css/cate.css" rel="stylesheet" type="text/css" />
 <link href="css/iscroll.css" rel="stylesheet" type="text/css" />
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
		<!--music-->
		<style>
.btn_music {
display: inline-block;
width: 35px;
height: 35px;
background: url('images/play.png') no-repeat center center;
background-size: 100% auto;
position: absolute;
z-index: 100;
left: 15px;
top: 20px;
}
.btn_music.on {
    background-image: url("images/stop.png");
}

</style>
<script src="js/jquery.min.js" type="text/javascript"></script>
<script>

var playbox = (function(){
	//author:eric_wu
	var _playbox = function(){
		var that = this;
		that.box = null;
		that.player = null;
		that.src = null;
		that.on = false;
		//
		that.autoPlayFix = {
			on: true,
			//evtName: ("ontouchstart" in window)?"touchend":"click"
			evtName: ("ontouchstart" in window)?"touchstart":"mouseover"
			
		}

	}
	_playbox.prototype = {
		init: function(box_ele){
			this.box = "string" === typeof(box_ele)?document.getElementById(box_ele):box_ele;
			this.player = this.box.querySelectorAll("audio")[0];
			this.src = this.player.src;
			this.init = function(){return this;}
			this.autoPlayEvt(true);
			return this;
		},
		play: function(){
			if(this.autoPlayFix.on){
				this.autoPlayFix.on = false;
				this.autoPlayEvt(false);
			}
			this.on = !this.on;
			if(true == this.on){
				this.player.src = this.src;
				this.player.play();
			}else{
				this.player.pause();
				this.player.src = null;
			}
			if("function" == typeof(this.play_fn)){
				this.play_fn.call(this);
			}
		},
		handleEvent: function(evt){
			this.play();
		},
		autoPlayEvt: function(important){
			if(important || this.autoPlayFix.on){
				document.body.addEventListener(this.autoPlayFix.evtName, this, false);
			}else{
				document.body.removeEventListener(this.autoPlayFix.evtName, this, false);
			}
		}
	}
	//
	return new _playbox();
})();

playbox.play_fn = function(){
	this.box.className = this.on?"btn_music on":"btn_music";
}
</script>

<script type="text/javascript">
$(document).ready(function(){
	playbox.init("playbox");
	/*
	setTimeout(function() {
		// IE
		if(document.all) {
			document.getElementById("playbox").click();
		}
		// 其它浏览器
		else {
			var e = document.createEvent("MouseEvents");
			e.initEvent("click", true, true);
			document.getElementById("playbox").dispatchEvent(e);
		}
	}, 2000);
	*/
});

</script>
<div class="first_head">
	<img src="images/logo1.png" />
</div>
<div class="banner">
	<div id="wrapper">
	<div id="scroller">
		<ul id="thelist">
					<li><p>女娲补天</p><a href="javascript:void(0)"><img src="images/02.jpg" /></a></li>
					<li><p>八角塘晨光</p><a href="javascript:void(0)"><img src="images/04.jpg" /></a></li>
					<li><p>田径场</p><a href="javascript:void(0)"><img src="images/03.jpg" /></a></li>
					<li><p>八角塘荷花</p><a href="javascript:void(0)"><img src="images/01.jpg"/></a></li>
					<li><p>八角塘亭</p><a href="javascript:void(0)"><img src="images/05.jpg"/></a></li>
					<li><p>图书馆夜景</p><a href="javascript:void(0)"><img src="images/06.png"/></a></li>	
		</ul>
	</div>
	</div>

	<!--<div id="nav">
		<ul id="indicator">
				<li class="active" ></li><li  ></li><li  ></li><li  ></li>
		</ul>
	</div>-->

</div>
<div class="main_menu">
<ul class="mainmenu">
	<li><a href="news/news.php"><b><img src="images/tb01.png" /></b><span>新闻中心</span></a></li>
    <li><a href="news/gonggao.php" ><b><img src="images/tb02.png" /></b><span>公告</span></a></li>
    <li><a href="js_view/view.php" ><b><img src="images/tb03.png" /></b><span>江理风采</span></a></li>
    <li><a href="news/xueshu.php" ><b><img src="images/tb04.png" /></b><span>学术</span></a></li>
    <li><a href="http://121.40.99.111/wx/book/search.php" ><b><img src="images/tb05.png" /></b><span>图书馆</span></a></li>
    <li><a href="xueyuan.php" ><b><img src="images/tb061.png" /></b><span>学校简介</span></a></li>
    <li><a href="xueyuan.php" ><b><img src="images/tb06.png" /></b><span>专业院系</span></a></li>
    <li><a href="http://map.qq.com/#pano=21071018131123105424800&heading=6&pitch=10&zoom=1" ><b><img src="images/tb07.png" /></b><span>校园3D</span></a></li>
    <li><a href="house/hudong_menu.php" ><b><img src="images/tb08.png" /></b><span>互动社区</span></a></li>
    <li><a href="stu_service/service_menu.php" ><b><img src="images/tb09.png" /></b><span>学生服务</span></a></li>  	 
</ul>
</div>
  
<script>
var count = document.getElementById("thelist").getElementsByTagName("img").length;	

var count2 = document.getElementsByClassName("menuimg").length;
for(i=0;i<count;i++){
 document.getElementById("thelist").getElementsByTagName("img").item(i).style.cssText = " width:"+document.body.clientWidth+"px";

}
document.getElementById("scroller").style.cssText = " width:"+document.body.clientWidth*count+"px";

 setInterval(function(){
myScroll.scrollToPage('next', 0,400,count);
},3500 );
window.onresize = function(){ 
for(i=0;i<count;i++){
document.getElementById("thelist").getElementsByTagName("img").item(i).style.cssText = " width:"+document.body.clientWidth+"px";

}
 document.getElementById("scroller").style.cssText = " width:"+document.body.clientWidth*count+"px";
} 


</script>
  <div class="copyright">
  <br />
Copyright © 2014-2015 <a href="http://www.jxust.cn/">江西理工大学</a> All rights reserved.</div>
<br><script>
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
</script> <style type="text/css">
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
<div class="top_bar" style="-webkit-transform:translate3d(0,0,0);">
	<div class="first_footer">
		<img src="images/logo.png" width="100%"/>
	</div>
  <!--<nav>
    <ul id="top_menu" class="top_menu">
        <li> <a href="index.php"><img src="images/iconfont-shouye.png" width="30"><label>首页</label></a></li>
        <li> <a href="javascript:void(0)"><img src="images/iconfont-fenxiang.png" width="30"><label>分享</label></a></li>
		<li> <a href="tel:13888888888"><img src="images/plugmenu1.png"><label>拨号</label></a></li>
        <li> <a href="javascript:void(0)"><img src="images/plugmenu8.png"><label>短信</label></a></li>  
    </ul>
  </nav>-->
</div>
<div id="plug-wrap" onclick="closeall()" style="display: none;"></div> 
<!-- share -->

	<script type="text/javascript">
			window.shareData = {  
					"moduleName":"Index",
					"moduleID": "0",
					"imgUrl": "images/2.jpg", 
					"timeLineLink": "http://127.0.0.1/",
					"sendFriendLink": "http://127.0.0.1/",
					"weiboLink": "http://127.0.0.1/",
					"tTitle": "江理微站",
					"tContent": "江理学子交流，学习，了解信息的入口"
				};
		</script>
		
<script>
		window.shareData.sendFriendLink=window.shareData.sendFriendLink.replace('http://127.0.0.1','http://127.0.0.1');
		document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {
        WeixinJSBridge.on('menu:share:appmessage', function (argv) {
         shareHandle('friend');
            WeixinJSBridge.invoke('sendAppMessage', { 
                "img_url": window.shareData.imgUrl,
                "img_width": "640",
                "img_height": "640",
                "link": window.shareData.sendFriendLink,
                "desc": window.shareData.tContent,
                "title": window.shareData.tTitle
            }, function (res) {
                _report('send_msg', res.err_msg);
            })
        });

        WeixinJSBridge.on('menu:share:timeline', function (argv) {
         shareHandle('frineds');
            WeixinJSBridge.invoke('shareTimeline', {
                "img_url": window.shareData.imgUrl,
                "img_width": "640",
                "img_height": "640",
                "link": window.shareData.sendFriendLink,
                "desc": window.shareData.tContent,
                "title": window.shareData.tTitle
            }, function (res) {
                _report('timeline', res.err_msg);
            });
        });

        WeixinJSBridge.on('menu:share:weibo', function (argv) {
         shareHandle('weibo');
            WeixinJSBridge.invoke('shareWeibo', {
                "content": window.shareData.tContent,
                "url": window.shareData.sendFriendLink,
            }, function (res) {
                _report('weibo', res.err_msg);
            });
        });
        }, false)
        
        function shareHandle(to) {
	var submitData = {
		module: window.shareData.moduleName,
		moduleid: window.shareData.moduleID,
		token:'xopcnh1413966457',
		wecha_id:'',
		url: window.shareData.sendFriendLink,
		to:to
	};
	$.post('/',submitData,function (data) {},'json')
}
        </script></body>
</html>
