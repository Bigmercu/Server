<?php
/*
验证并储存用户信息
*/
error_reporting(0);
@$username=trim($_POST['username']);
@$openid=trim($_POST['openid']);
@$password=trim($_POST['password']);
	include "config.php";
	$mysql="select * from user where openid='{$openid}'";
	$result=$conn->query($mysql);
	$row=$result->fetch_row();
	if(trim($row[1])==""){//如果用户之前没有绑定,数据库无该openid的记录
	 $cookie_file = tempnam('./temp','cookie');
			$send_url="http://jw.jxust.cn/default6.aspx";
				$ch = curl_init($send_url);
							curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; WOW64; Trident/4.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; .NET4.0C; .NET4.0E; InfoPath.3)');
							curl_setopt($ch, CURLOPT_HEADER, 0);
							curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
							curl_setopt($ch, CURLOPT_MAXREDIRS, 1);
							curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
							curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
							curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file);
							curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file);
							curl_setopt($ch, CURLOPT_REFERER, 'http://jw.jxust.cn/default6.aspx');
							$result = curl_exec($ch);
							curl_close($ch);
					preg_match('/name="__VIEWSTATE" value="([\d\D]*?)" \/>/',$result,$result1);
					$viewstate= urlencode($result1[1]);
					$post_fields="__VIEWSTATE=$viewstate&tname=bt1&tbtns=bt1&tnameXw=yhdl&tbtnsXw=yhdl%7Cxwxsdl&txtYhm=$username&txtXm=$password&txtMm=$password&rblJs=%D1%A7%C9%FA&btnDl=%B5%C7+%C2%BC"; 
							$ch = curl_init($send_url);
							curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; WOW64; Trident/4.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; .NET4.0C; .NET4.0E; InfoPath.3)');
							curl_setopt($ch, CURLOPT_HEADER, 0);
							curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
							curl_setopt($ch, CURLOPT_MAXREDIRS, 1);
							curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
							curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
							curl_setopt($ch, CURLOPT_POST, 1);
							curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
							curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file);
							curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file);
							curl_setopt($ch, CURLOPT_REFERER, 'http://jw.jxust.cn/default6.aspx');
							$result = curl_exec($ch);
							$result=iconv("gb2312", "UTF-8", $result);
							curl_close($ch);
							unlink($cookie_file);
							// echo $result;
					preg_match('/<div class="info">([\d\D]*?)id="likTc"/',$result,$result1);
					if(preg_match('/欢迎您/',$result1[1])){
						preg_match('/<em>
										<span id="xhxm">([\d\D]*?)<\/span>/',$result1[1],$result2);
							$time=date("Y-m-d H:i:s");
							$username=base64_encode($username);//加密储存
							$password=base64_encode($password);//加密储存
							$mysql="insert into user(username,password,time,openid)values('$username','$password','$time','$openid')";
							$conn->query($mysql);
							if(!$conn)
							{
							echo "数据库连接错误!";
							}else{
						echo '<p style="clear:both;text-align:left;font-size:14px;padding:5px;margin:0;padding-bottom:0px;line-height:2em;">'.$result2[1].'您好:<br>欢迎使用微信教务查询系统,您的信息已验证通过!<br>1.回复"课表"可查询当日课表<br>2.回复"成绩"可查询最新成绩<br>3.回复"解绑"可清除全部数据。</p>'; 
							}
					}else{
							
							echo "用户名或密码错误";
					}
					 
}else{
	echo "你的帐号已经绑定,无须重复操作,谢谢!";
}

?>