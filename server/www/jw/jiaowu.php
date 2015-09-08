<?php
//接受数据
/* if (!empty($GLOBALS['HTTP_RAW_POST_DATA']))
{
	//echo "yes";
	$command =  isset($GLOBALS['HTTP_RAW_POST_DATA']) ? $GLOBALS['HTTP_RAW_POST_DATA'] : file_get_contents("php://input");
	//$json =json_encode($command);
	$j=json_decode($command, true);
}else {
	response('no');
} */

$username ="20133210";// $j['username'];//$_GET['username'];
$password ="dai123456";// $j['password'];//$_GET['password'];
$term = "2014-2015";//$_GET['term'];
$num = "1";//$_GET['num'];

//登录地址
$url = "http://jw.jxust.cn/default6.aspx";
//设置cookie保存路径
$cookie = dirname(__FILE__) . '/cookie_oschina.txt';
//登录后要获取信息的地址
$url2 = "http://jw.jxust.cn/xskbcx.aspx?xh=$username&xm=''&gnmkdm=N121603";


//参数1：访问的URL，参数2：post数据(不填则为GET)，参数3：提交的$cookies,参数4：是否返回$cookies
function curl_request($url,$post='',$cookie='', $returnCookie=0){
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)');
	curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($curl, CURLOPT_AUTOREFERER, 1);
	curl_setopt($curl, CURLOPT_REFERER, "");
	if($post) {
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($post));
	}
	if($cookie){
		curl_setopt($curl, CURLOPT_COOKIE, $cookie);
	}
	curl_setopt($curl, CURLOPT_HEADER, $returnCookie);
	curl_setopt($curl, CURLOPT_TIMEOUT, 10);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	$data = curl_exec($curl);
	if (curl_errno($curl)) {
		return curl_error($curl);
	}
	curl_close($curl);
	if($returnCookie){
		list($header, $body) = explode("\r\n\r\n", $data, 2);
		preg_match_all("/Set\-Cookie:([^;]*);/", $header, $matches);
		$info['cookie']  = substr($matches[1][0], 1);
		$info['content'] = $body;
		return $info;
	}else{
		return $data;
	}
}
//获取需要提交的__VIEWSTATE的值
function getView(){
	$res;
	$url = 'http://jw.jxust.cn/default6.aspx';
	$result = curl_request($url);
	$pattern = '/<input type="hidden" name="__VIEWSTATE" value="(.*?)" \/>/is';
	preg_match_all($pattern, $result, $matches);
	$res[0] = $matches[1][0];
	return $res;
}
$view = getView();


//模拟登录 
function login_post($url, $cookie, $post) { 
    $curl = curl_init();//初始化curl模块 
    curl_setopt($curl, CURLOPT_URL, $url);//登录提交的地址 
    curl_setopt($curl, CURLOPT_HEADER, 0);//是否显示头信息 
    curl_setopt ( $curl, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);//是否自动显示返回的信息 
    curl_setopt($curl, CURLOPT_COOKIEJAR, $cookie); //设置Cookie信息保存在指定的文件中 
    curl_setopt($curl, CURLOPT_POST, 1);//post方式提交 
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($post));//要提交的信息 
    curl_exec($curl);//执行cURL 
    curl_close($curl);//关闭cURL资源，并且释放系统资源 
} 

//登录成功后获取数据
function get_content($url,$cookie,$url3,$post='') {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt ( $ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie); //读取cookie
	curl_setopt($ch, CURLOPT_REFERER, $url3);
	if($post) {
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
	}
	
	$rs = curl_exec($ch); //执行cURL抓取页面内容
	curl_close($ch);
	return $rs;
} 
//获取课表页面提交的__VIEWSTATE的值
function get_res($url, $cookie) {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt ( $ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie); //读取cookie
	curl_setopt($ch, CURLOPT_REFERER, "http://jw.jxust.cn/xskbcx.aspx?xh=''&xm=''&gnmkdm=N121603");
	$rs = curl_exec($ch); //执行cURL抓取页面内容
	curl_close($ch);
	$pattern = '/<input type="hidden" name="__VIEWSTATE" value="(.*?)" \/>/is';
	preg_match_all($pattern, $rs, $matches);
	$res[0] = $matches[1][0];
	return $res;
}

//获得前端提交的数据



//设置post的数据
$post = array (
		'__VIEWSTATE' => $view[0],
			'tname' => 'bt1',
			'tbtns' => 'bt1',
			'tnameXw' => 'yhdl',
			'tbtnsXw' => 'yhdl|xwxsdl',
			'txtYhm' => $username,
			'txtXm' => '',
			'txtMm' => $password,
			'rblJs' => '学生',
			'btnDl' => '登 录'
);
//模拟登录
login_post($url, $cookie, $post);
//获取登录页的信息
$ress = get_res($url2,$cookie);
//$data 是查询课表所需要提交的数据
$data = array(
		'__EVENTTARGET'=>'xnd',
		'__EVENTARGUMENT' => '',
		'__VIEWSTATE' => $ress[0],
		'xnd' => $term,
		'xqd' => $num
);


$kebiao = get_content($url2, $cookie,"http://jw.jxust.cn/xskbcx.aspx?xh=$username&xm=''&gnmkdm=N121603",$data);

preg_match_all('/<table id="Table1"[\w\W]*?>([\w\W]*?)<\/table>/',$kebiao,$out);
$table = $out[0][0]; //获取整个课表

preg_match_all('/<td [\w\W]*?>([\w\W]*?)<\/td>/',$table,$out);
$td = $out[1];
$length = count($td);

//获得课程列表
for ($i=0; $i < $length; $i++) {
	//$td[$i] = str_replace("<br>", "", $td[$i]);

	$reg = "/{(.*)}/";

	if (!preg_match_all($reg, $td[$i], $matches)) {
		unset($td[$i]);
	}
}

//去除<a></a>标签
foreach ($td as $key => $value){
	preg_match_all('/<a [\w\W]*?>([\w\W]*?)<\/a>/',$value,$out);
	$td[$key]=$out[1][0];
	//echo $value."<br/>";
}

$td = array_values($td); //将课程列表数组重新索引
$tdLength = count($td);
for ($i=0; $i < $tdLength; $i++) {
	$td[$i] = iconv('GB2312','UTF-8',$td[$i]);
}


//将课表转换成数组形式
function converttoTable($table){
	$list = array(
			'sun' => array(
					'1,2' => '',
					'3,4' => '',
					'5,6' => '',
					'7,8' => '',
					'9,10' => ''
			),
			'mon' => array(
					'1,2' => '',
					'3,4' => '',
					'5,6' => '',
					'7,8' => '',
					'9,10' => ''
			),
			'tues' => array(
					'1,2' => '',
					'3,4' => '',
					'5,6' => '',
					'7,8' => '',
					'9,10' => ''
			),
			'wed' => array(
					'1,2' => '',
					'3,4' => '',
					'5,6' => '',
					'7,8' => '',
					'9,10' => ''
			),
			'thur' => array(
					'1,2' => '',
					'3,4' => '',
					'5,6' => '',
					'7,8' => '',
					'9,10' => ''
			),
			'fri' => array(
					'1,2' => '',
					'3,4' => '',
					'5,6' => '',
					'7,8' => '',
					'9,10' => ''
			),
			'sat' => array(
					'1,2' => '',
					'3,4' => '',
					'5,6' => '',
					'7,8' => '',
					'9,10' => ''
			)
	);
	$week = array("sun"=>"周日","mon"=>"周一","tues"=>"周二","wed"=>"周三","thur"=>"周四","fri"=>"周五","sat"=>"周六");
	$order = array('1,2','3,4','5,6','7,8','9,10');
	foreach ($table as $key => $value){
		$class = $value;
		foreach ($week as $key => $weekDay){
			$pos = strpos($class,$weekDay);
			if ($pos){
				$weekArrayDay = $key; //获取list数组中的第一维key
				foreach ($order as $key => $orderClass){
					$pos = strpos($class,$orderClass);
					if ($pos) {
						$weekArrayOrder = $orderClass; //获取该课程是第几节
						break;
					}
				}
				break;
			}
		}
		$list[$weekArrayDay][$weekArrayOrder] = $class;
	}
	return $list;
	//return $pos;
}
$kc = converttoTable($td);

//二维转一位
$i  = 1;
foreach($kc as $key => $val) {
	foreach ($val as $value){
		//echo $value;
		$yiwei[$i] = $value;
		$i++;
	}
}
//按json格式输出
function response($code,$data = array()) {
	$result = array(
			'code' => $code,
			'data' => $data
	);

	echo json_encode($result);
	exit;
}

if($yiwei!=null){
	response('ok',$yiwei);
}else {
	response('no',$yiwei);
}


