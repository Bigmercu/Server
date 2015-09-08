<!DOCTYPE html>
<html>
<head>
   <link href="http://libs.baidu.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
   <script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
   <script src="http://libs.baidu.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
   <link rel="stylesheet" href="http://apps.bdimg.com/libs/jquerymobile/1.4.2/jquery.mobile.min.css">
   <script src="http://apps.bdimg.com/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="http://apps.bdimg.com/libs/jquerymobile/1.4.2/jquery.mobile.min.js"></script>
	<script src="book.js"></script>
	<link type="text/css" rel="stylesheet" href="book.css"/>
   <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0;" name="viewport" />
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body >
<div data-role="page" id="pageone" style="width:100%;">
		<div data-role="header" style="background:#46A3FF;color:white;border:0;">
			<h1 style="font-size:20px">图书检索</h1>
		</div>
		
			<div data-role="content">
				  <div  style="width:100%;">
						<input type="search" name="search_content" id="search_content"  placeholder="请输入书名" />
						<input type="hidden" name="page" id="page" value="1" />
						<input type="hidden" name="old_content" id="old_content" value="1" />
						<input type="hidden" name="num" id="num" value="1" />
						<input type="submit"  value="搜索" id="search_button" onclick="search();"/>
				  </div> 
				  
			<ul data-role="listview" data-inset="true" id="content">
			<!--加载书籍内容-->	
			</ul> 
			<p align="center" style="display:none;" id="more"><span style="text-align:center;color:red">加载中，请稍等。。。</span></p>
</div>
		<div class="wait"></div>
			<div id="mcover"><div class="waita"></div></div>
			
			<div  style="color:#6C6C6C;margin-bottom:25px;text-align:center;">
					<!--madeby 韦兴东 qq863201315-->	
					<h1 style="font-size:16px">江西理工大学党宣新媒体中心</h1>
			</div>
</div>
</body>
</html>	