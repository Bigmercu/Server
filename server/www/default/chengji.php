<?php
//接受数据
if (!empty($GLOBALS['HTTP_RAW_POST_DATA']))
{
	//echo "yes";
	$command =  isset($GLOBALS['HTTP_RAW_POST_DATA']) ? $GLOBALS['HTTP_RAW_POST_DATA'] : file_get_contents("php://input");
	//$json =json_encode($command);
	$j=json_decode($command, true);
}else {
	response('no');
}
$username = $j['username'];//$_GET['username'];
$password = $j['password'];//$_GET['password'];

//登录地址
$url = "http://jw.jxust.cn/default6.aspx";
//设置cookie保存路径
$cookie = dirname(__FILE__) . '/cookie_oschina.txt';
//登录后要获取信息的地址
$url2 = "http://jw.jxust.cn/xsdjkscx.aspx?xh=$username&xm=''&gnmkdm=N121606";


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
	if($cookie) {
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
	curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1);
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

$chengji = get_content($url2, $cookie,"http://jw.jxust.cn/xsdjkscx.aspx?xh=$username&xm=''&gnmkdm=N121606");

preg_match_all('/<table class="datelist"[\w\W]*?>([\w\W]*?)<\/table>/',$chengji,$out);
$table = $out[0][0]; //获取整个课表

preg_match_all('/<td[\w\W]*?>([\w\W]*?)<\/td>/',$table,$out);

$td = $out[1];
$length = count($td);

//print_r($td);

$xxi = array();
$j=1;
for($i=10;$i<$length;$i++){
	$xxi[$j] = $td[$i];
	$j++;
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

//print_r($xxi);
if($xxi!=null){
	response('ok',$xxi);	
}else{
	response('no',$xxi);
}





