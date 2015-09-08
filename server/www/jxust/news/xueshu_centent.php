<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta name="format-detection" content="telephone=no">
		<meta charset="utf-8">
		<title>江理微站</title>
		<link href="../css/cate.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
		<?php include("catch_xueshu_text.php");?>
		<div class="header">
			<span class="return"><a href="xueshu.php?page=<?php echo $p; ?>"><img src="../images/iconfont-fanhui (1).png" width="20"/></a></span>
			<h3>学术公告</h3>
			<span class="home"><a href="../index.php"><img src="../images/iconfont-shouyehome.png" width="25"/></a></span>
		</div>
		<div class="centent">
			<div class="art_title"><?php echo $out_news_title[1][0]; ?></div>
			<div class="_news_info">
				<span>发布：<?php echo $out_news_name[1][0]; ?>丨</span>
				<span>日期：<?php echo $out_news_time[1][0]; ?>丨</span>
				<span>浏览数：1234</span>
			</div>
			<div class="news_text">
				<?php for($i=0;$i<$long;$i++){ ?>
				<img src="<?php echo $out_news_img[1][$i]; ?>" width="90%">
				<h3><?php echo $out_news_alt[1][0]; ?></h3>
				<?php } ?>
				<p style="text-indent: 0.6em;">
					<?php echo $out_news_text[1][0]; ?>
				</p>
			</div>
			<hr width="90%" style="margin:0px auto ; margin-top: 10px; ">
			<div style="text-align:center; font-size: 0.4em;"> 
				<br/>
				Copyright &copy; 2013 www.jxust.cn 江西理工大学 All Rights Reserved   
				<br />
				学校地址： 江西省赣州市章贡区红旗大道86号 &nbsp;&nbsp; 党委宣传部 现代教育技术及信息中心 制作维护 &nbsp;&nbsp; 赣ICP备05002434号
				</span>
			</div>
		</div>
	</body>
</html>
