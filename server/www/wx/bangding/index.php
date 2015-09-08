<!DOCTYPE html>
<html>
<head>
   <link href="http://libs.baidu.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
   <link type="text/css" rel="stylesheet" href="bangding.css"/>
   <script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
   <script src="http://libs.baidu.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
   
   <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0;" name="viewport" />
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <script type="text/javascript" src="bangding.js"></script>
</head>
<body>
<?php 
	$useragent = addslashes($_SERVER['HTTP_USER_AGENT']); 
	if(strpos($useragent, 'MicroMessenger') === false && strpos($useragent, 'Windows Phone') === false ){
			echo "<script>window.location= 'http://1.cpubbq.sinaapp.com/feifa.php';</script>";
    }
	$openid="";
		 if(isset($_GET["openid"])){
				$openid=$_GET["openid"];
		 }
 if($openid==''){
 echo "<script>window.location= 'http://1.cpubbq.sinaapp.com/feifa.php';</script>";
 }
 ?>
<div id="title"><span>教务系统账号绑定</span></div>
		<form class="form" role="form">
				 <input type="text" class="form-control" id="username" placeholder="请输入学号">
				 <input type="password" class="form-control" id="password" placeholder="请输入密码">
				 <input type="hidden"  name="openid" id="openid" value="<?php echo $openid;?>"/>
				 <input type="button" class="btns" id="button" onclick="judge();"  value="确认绑定"/>
		</form>
<div class="wait"></div>
<div id="mcover" "><div class="waita"></div></div>
	<div id="foot">
		<div >党宣新媒体中心©<?php echo date("Y");?></div>
	</div>
</body>
</html>			