<?php
/*
  微信api接口程序
1.实现自动递增学期功能
2.课表动态跟进，识别单双周，识别当前所在时间，增强互动性
3.数据加密，网页post提交，图文回复，保护个人隐私
  made by 韦兴东 qq863201315
*/

define("TOKEN", "weixin");//自定义安全密钥
define("URL", "http://".$_SERVER['SERVER_NAME']."/wx/");
include "login_class.php";
include "get_content.php";
$wechatObj = new wechatCallbackapiTest();
			if (!isset($_GET['echostr'])) {
				$wechatObj->responseMsg();
			}else{
				$wechatObj->valid();
			}

class wechatCallbackapiTest{
	
	public $xueqi;
	public $xuenian;
	public $star_time;
	
	public function __construct(){ 
					if(strtotime(date("Y-n-j"))>strtotime(date("Y-2-1"))){
					$star_time=date("Y-3-1");//在此设定春季开学时间，用于课表新学期递增
					}
					if(strtotime(date("Y-n-j"))>strtotime(date("Y-8-1"))){
						$star_time=date("Y-9-7");//在此设定秋季开学时间，用于课表新学期递增
					}
					if(strtotime(date("Y-n-j"))>strtotime(date("Y-5-1"))){//设置成绩更新时间
						$this->xuenian=(string)((int)date("Y")-1)."-".date("Y");
						$this->xueqi=2;
					}
					if(strtotime(date("Y-n-j"))>strtotime(date("Y-10-1"))){
						$this->xuenian=date("Y")."-".(string)((int)date("Y")+1);
						$this->xueqi=1;
					}
						$this->star_time = $star_time; 
		} 
	
	public function valid()
							{
								$echoStr = $_GET["echostr"];
								if($this->checkSignature()){
									echo $echoStr;
									exit;
								}
							}
							
    private function checkSignature()
						{
							$signature = $_GET["signature"];
							$timestamp = $_GET["timestamp"];
							$nonce = $_GET["nonce"];
							$token = TOKEN;
							$tmpArr = array($token, $timestamp, $nonce);
							sort($tmpArr, SORT_STRING);
							$tmpStr = implode($tmpArr);
							$tmpStr = sha1($tmpStr);

							if($tmpStr == $signature){
								return true;
							}else{
								return false;
							}
						}

   
    public function responseMsg()
					{
						$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
						if (!empty($postStr)){
							$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA); // XML 字符串载入对象中
															//字符窜    规定新对象的class   规定附加的 Libxml 参数
									$result = $this->receiveText($postObj);
							echo $result;
						}else {
							echo "";
							exit;
						}
					}

    
    private function receiveText($object)
			{
				$fromUsername = trim($object->FromUserName);
				$openid = $fromUsername;
				$keyword=trim($object->Content);
				if(preg_match("/课表|成绩/",$keyword)){ 
										include "bangding/config.php";
										$mysql="select * from user where openid='{$openid}'";
										$result=$conn->query($mysql);
										$row=$result->fetch_row();
									if(trim($row[1])!==""){//如果用户之前没有绑定,数据库无该openid的记录
											if(preg_match("/课表/",$keyword)){
													$result = $this->kebiao($object);
											}else{
													$result = $this->chengji($object);
											}
									}else{
										$content='<a href="'.URL.'bangding?openid='.$openid.'">第一次使用请点击这里绑定</a>';
										$result = $this->transmitText($object, $content);
									} 
									return $result;
									}elseif(preg_match("/解|绑/",$keyword)){
											include "bangding/config.php";
											$mysql="select * from user where openid='{$openid}'";
											$result=$conn->query($mysql);
											$row=$result->fetch_row();
											if(trim($row[1])!==""){//如果用户之前没有绑定,数据库无该openid的记录
												$mysql="delete from user where openid='{$openid}'";
												$conn->query($mysql);
												if($conn){
													$result = $this->transmitText($object, "数据已成功删除，欢迎你再次使用，谢谢！");
												}
											}else{
												$result = $this->transmitText($object, "您尚未绑定，谢谢");
											}
										return $result;
									}
			}
			
	public function chengji($object)
			{
					$openid = trim($object->FromUserName);
							$content[] = array("Title"=>"请点击进入成绩查询系统", "Description"=>"自动计算GPA 点击菜单按钮可切换", "PicUrl"=>URL."img/title/".rand(1,10).".jpg", "Url" =>URL."mark.php?openid=".$openid."&xuenian=".$this->xuenian."&xueqi=".$this->xueqi);
									   $result = $this->transmitNews($object, $content);
										return $result;
			}
				
	public function kebiao($object)
			{
					$keyword=trim($object->Content);
					$openid = trim($object->FromUserName);
					include "bangding/config.php";
					$mysql="select * from user where openid='{$openid}'";
					$result=$conn->query($mysql);
					$row=$result->fetch_row();
					$username=base64_decode($row[1]);
					$password=base64_decode($row[2]);
					$login = new Login($username,$password);
					/* //其他学期课表查询调用方式 
					$xuenian="2014-2015";//学年
					$xueqi="1";//学期
					$course=$login->kebiao_else($xuenian,$xueqi); */
					$course=$login->kebiao();
					
							if(date('w')>0){$today=date('w');}elseif(date('w')==0){$today=7;}
											   $ww="";
											   $flag=((int)(date('W'))-(int)date('W',strtotime($this->star_time)) +1);
											   if($flag<1){$week=1;$ww="  当前为放假时间";}else{$week=$flag;}//获取当前周数
											   if(preg_match("/明天|明日/",$keyword)){$today=($today+1);}
											   if(preg_match("/后天/",$keyword)&&!preg_match("/大/",$keyword)){$today=($today+2);}
											   if(preg_match("/外天|大后天/",$keyword)&&!preg_match("/大大/",$keyword)){$today=$today+3;}
											   if(preg_match("/大大后天/",$keyword)&&!preg_match("/大大大/",$keyword)){$today=($today+4);}
											   if(preg_match("/大大大后天/",$keyword)){$today=($today+5);}
											   if(date('w')==0){$date1=7;}else{$date1=date('w');}
											   if(preg_match("/一|1/",$keyword)){$today=1;if($date1>1){$week=1+$week;}}
											   if(preg_match("/二|2/",$keyword)){$today=2;if($date1>2){$week=1+$week;}}
											   if(preg_match("/三|3/",$keyword)){$today=3;if($date1>3){$week=1+$week;}}
											   if(preg_match("/四|4/",$keyword)){$today=4;if($date1>4){$week=1+$week;}}
											   if(preg_match("/五|5/",$keyword)){$today=5;if($date1>5){$week=1+$week;}}
											   if(preg_match("/六|6/",$keyword)){$today=6;if($date1>6){$week=1+$week;}}
											   if(preg_match("/星期天|周日|7/",$keyword)){$today=7;}
											   if($today>7){$today=($today-7);$week=1+$week;}
								   
								   
			   $title=array("周一课程",'周二课程','周三课程','周四课程','周五课程','周六课程','周日课程');
			   $titles=$title[$today-1]."(第".$week."周):".$ww;
							  $content = array();        
							  $content[0] = array("Title"=>$titles, "Description"=>"", "PicUrl"=>URL."img/title/".rand(1,10).".jpg", "Url" =>' ');#图文模式
							 $i=0;
							 for($a=1;$a<6;$a++){
								  $contents = new Get_content($course,$today,$a);
								  $kb = $contents->get_content($week);
								  if(!empty($kb)){
									  $content[] = array("Title"=>$kb, "Description"=>"", "PicUrl"=>URL."img/".$a.".jpg", "Url" =>' ');#图文模式
									  $i++;
								  }
							  }
							  if($i==0){
									  $content[] = array("Title"=>"今日没课，你可以放心了", "Description"=>"", "PicUrl"=>URL."img/sleep.jpg", "Url" =>' ');#图文模式
								  }
							   $result = $this->transmitNews($object, $content);
					 return $result;
				}

  
    private function transmitNews($object, $newsArray)
    {
        if(!is_array($newsArray)){
            return;
        }
        	$itemTpl = " <item>
                        <Title><![CDATA[%s]]></Title>
                        <Description><![CDATA[%s]]></Description>
                        <PicUrl><![CDATA[%s]]></PicUrl>
                        <Url><![CDATA[%s]]></Url>
                        </item>";
        $item_str = "";
        foreach ($newsArray as $item){
            $item_str .= sprintf($itemTpl, $item['Title'], $item['Description'], $item['PicUrl'], $item['Url']);
        }
        $newsTpl = "<xml>
					<ToUserName><![CDATA[%s]]></ToUserName>
					<FromUserName><![CDATA[%s]]></FromUserName>
					<CreateTime>%s</CreateTime>
					<MsgType><![CDATA[news]]></MsgType>
					<Content><![CDATA[]]></Content>
					<ArticleCount>%s</ArticleCount>
					<Articles>$item_str</Articles>
					</xml>";
        $result = sprintf($newsTpl, $object->FromUserName, $object->ToUserName, time(), count($newsArray));
        return $result;
         }
    
    
    private function transmitText($object, $content)
    {
        $textTpl = "<xml>
					<ToUserName><![CDATA[%s]]></ToUserName>
					<FromUserName><![CDATA[%s]]></FromUserName>
					<CreateTime>%s</CreateTime>
					<MsgType><![CDATA[text]]></MsgType>
					<Content><![CDATA[%s]]></Content>
					</xml>";
        $result = sprintf($textTpl, $object->FromUserName, $object->ToUserName, time(), $content);
        return $result;
    }
}
?>