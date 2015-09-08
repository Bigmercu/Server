<?php
//数据库连接
$username="root";
$password="382cc24e19";//数据库密码
$hostname="jxust";//数据库名

$conn = new mysqli("localhost:3306",$username,$password,$hostname);
$conn->query("SET NAMES 'utf8'");
?>