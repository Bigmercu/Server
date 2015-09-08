<?php 
//sign前端传参数username，classname,have_class

/*
 * 定义接受的变量
 * @username 学生登入教务系统的账号
 * @clasname 对应的课程名称
 * @hava_class 该课程上课与否 false or true
 */
echo "hello";
//接受数据
if (!empty($GLOBALS['HTTP_RAW_POST_DATA']))
{
	//echo "yes";
	$command =  isset($GLOBALS['HTTP_RAW_POST_DATA']) ? $GLOBALS['HTTP_RAW_POST_DATA'] : file_get_contents("php://input");
	//$json =json_encode($command);
	$j=json_decode($command, true);
}else {
	$reult = array(
		'code' => 'no',
	);
	echo json_encode($reult);
	exit();
}

$username = $j['username'];
$classname = isset($j['classname']) ? $j['classname'] : '';
$have_class = isset($j['have_class']) ? $j['have_class'] : '';


function sign($username,$classname,$have_class){
	//链接数据库
	$conn = mysql_connect('localhost','root','root') or die("数据库连接失败");
	mysql_query("set names 'utf8'",$conn);
	mysql_select_db('user');
	
	$sql1 = "select username from sign where username=$username";
	$sql2 = "select classname from sign where username=$username AND classname='$classname'";
	$sql4 = "insert into sign (username,classname,times) values ($username,'$classname','1')";
	$sql6 = "select times from sign where username=$username AND classname='$classname'";
	$sql7 = "insert into sign (username,classname,times) values ($username,'$classname','0')";
	
		$result1 = mysql_query($sql1,$conn);
		$row = mysql_num_rows($result1);
		if($row >= 1){	
			$result2 = mysql_query($sql2,$conn);
			$row = mysql_num_rows($result2);
				if($row >=1){
					if($have_class == true){
						$res = mysql_query($sql6);
						$val = mysql_fetch_array($res,MYSQL_ASSOC);
						$val['times'] = $val['times']."-1";
						$a = $val['times'];
						$sql3 = "update sign set times='$a' where username=$username AND classname='$classname'";
						mysql_query($sql3);
					}else {
						$res = mysql_query($sql6);
						$val = mysql_fetch_array($res,MYSQL_ASSOC);
						$val['times'] = $val['times']."-0";
						$a = $val['times'];
						$sql3 = "update sign set times='$a' where username=$username AND classname='$classname'";
						mysql_query($sql3);
					}
				}else{
					if($have_class == true){
						mysql_query($sql4);
					}else {
						mysql_query($sql7);
					}
				}
		}else{
			if($have_class == true){
				mysql_query($sql4);
			}else {
				mysql_query($sql7);
			}
		}
}

//取出数据库中的username,classname,times
function show($username,$classname){
	//链接数据库
	$conn = mysql_connect('localhost','root','root') or die("数据库连接失败");
	mysql_query("set names 'utf8'",$conn);
	mysql_select_db('user');
	
		$sql5 = "select * from sign where username=$username";
		$result3 = mysql_query($sql5);
		$i = 1;
		$add = array();
		while($value = mysql_fetch_array($result3,MYSQL_ASSOC))
		{	
			$value;
			$add[$i] = $value;
			$i++;
		}
		
		$result = array(
				'code' => 'ok',
				'data' => $add
		);
		echo json_encode($result);
		exit();
}

if($have_class!='' || $classname!='' ){
	sign($username,$classname,$have_class);
	show($username,$classname);
}else {
	show($username,$classname);
}

?> 



