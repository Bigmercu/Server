<?php
/* 	
*	精简化教务模拟登陆类
*	Author:韦兴东 qq:863201315 
*/

error_reporting(0);
@header("content-Type: text/html; charset=utf-8");
class Login{ 
	private $username; 
	private $password;
	public	$cookie_file;
public function __construct($username,$password){ 
			$this->username = $username; 
			$this->password = $password;
			$this->cookie_file = tempnam('./temp','cookie');//sae:SAE_TMP_PATH
			$this->dologin(); 
		} 
		
		private function dologin(){ 
			$send_url="http://jw.jxust.cn/default_ysdx.aspx";
				$result=file_get_contents($send_url);
					preg_match('/name="__VIEWSTATE" value="([\d\D]*?)" \/>/',$result,$result1);
					$post_fields="__VIEWSTATE=".urlencode($result1[1])."&TextBox1=$this->username&TextBox2=$this->password&RadioButtonList1=%D1%A7%C9%FA&Button1=++%B5%C7%C2%BC++"; 
					$this->curl($send_url,$post_fields);
		}
		//查询当前教务系统默认课表
		public function kebiao(){ 
			$send_url="http://jw.jxust.cn/xskbcx.aspx?xh=$this->username&xm=&gnmkdm=";
					$result=$this->curl($send_url,$post_fields);
					unlink($cookie_file);
					return $this->res($result);
		}
		
		
		//查询成绩
		public function chengji($xuenian,$xueqi){ 
					$send_url="http://jw.jxust.cn/xscj_gc.aspx?xh=$this->username&xm=&gnmkdm=";
					$post_fields="__VIEWSTATE=".$this->viewstate($send_url)."&ddlXN=$xuenian&ddlXQ=$xueqi&Button1=%B0%B4%D1%A7%C6%DA%B2%E9%D1%AF";
					$result=$this->curl($send_url,$post_fields);
					 unlink($cookie_file);
					 // echo $result;
					$result=$this->chengji_res($result); 
					
					return $result;
		}
		
		private function chengji_res($result){ 
			 $result=iconv("gb2312", "UTF-8", $result);
			 preg_match('/<select name="ddlXN" id="ddlXN">([\d\D]*?)<\/select>/',$result,$result_option1);
			 $result_option=str_replace("</option>","#",$result_option1[1]);
			 $result_option=preg_replace("/<([\d\D]*?)>/","",$result_option);
			 $content["option"]= $result_option;
			 
			preg_match('/<fieldset>([\d\D]*?)<\/fieldset>/',$result,$result1);
			preg_match('/<span id="Label4" style="font-size:14pt;font-weight:bold;">([\d\D]*?)<\/span>/',$result1[1],$result2);
			$content["title"]=str_replace(" ","",$result2[1]);//标题
			
			preg_match('/<span id="xftj" style="font-weight:bold;">([\d\D]*?)<\/span>/',$result1[1],$result2);
			$content["status"]=str_replace("；","#",$result2[1]);
			$content["status"]=str_replace("。","",$content["status"]);
			$content["status"]=str_replace("所选学分","",$content["status"]);
			$content["status"]=str_replace("获得学分","",$content["status"]);
			$content["status"]=str_replace("重修学分","",$content["status"]);//学习状态
			
			preg_match('/<span id="zyzrs" style="font-weight:bold;">([\d\D]*?)<\/span>/',$result1[1],$result2);//本专业共77人
			$content["zyrs"]=str_replace("本专业共","",$result2[1]);
			preg_match('/<span id="pjxfjd" style="font-weight:bold;">([\d\D]*?)<\/span>/',$result1[1],$result2);//平均学分绩点：2.27&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;平均学分成绩：73.40
			$content["pjxfjd"]=str_replace("平均学分绩点：","",$result2[1]);
			$content["pjxfjd"]=str_replace("&nbsp;","",$content["pjxfjd"]);
			$content["pjxfjd"]=str_replace("平均学分成绩：","#",$content["pjxfjd"]);
			preg_match('/<span id="xfjdzh" style="font-weight:bold;">([\d\D]*?)<\/span>/',$result1[1],$result2);//学分绩点总和：221.30
			$content["xfjdzh"]=str_replace("学分绩点总和：","",$result2[1]);
			
			preg_match('/<table class="datelist" cellspacing="0" cellpadding="3" border="0" id="Datagrid1" style="width:100%;border-collapse:collapse;">([\d\D]*?)<\/table>/',$result1[1],$result2);
			$result=preg_replace("/<tr([\d\D]*?)>/","#",$result2[1]);
			$result=str_replace("<td>","*",$result);
			$result=preg_replace("/<([\d\D]*?)>/","",$result);
			$content["content"] = $result;
			return $content;
		}
		
		//查询其他学年课表,可带上参数自行调用
		public function kebiao_else($xuenian,$xueqi){ 
					$send_url="http://jw.jxust.cn/xskbcx.aspx?xh=$this->username&xm=&gnmkdm=";
					$post_fields="__EVENTTARGET=xqd&__VIEWSTATE=".$this->viewstate($send_url)."&__EVENTARGUMENT=&xnd=$xuenian&xqd=$xueqi";
					$result=$this->curl($send_url,$post_fields);
					unlink($cookie_file);
						return $this->res($result);
		}
		
		public function viewstate($send_url){ 
					$result=$this->curl($send_url,$post_fields);
					preg_match('/name="__VIEWSTATE" value="([\d\D]*?)" \/>/',$result,$result1);
					return urlencode($result1[1]);
		}
		
		private function res($result){ 
			$result=iconv("gb2312", "UTF-8", $result);
			preg_match('/<table id="Table1" class="blacktab" bordercolor="Black" border="0" style="border-color:Black;width:100%;">([\d\D]*?)<\/table>/',$result,$result1);
			$result=str_replace("</tr>","",$result1[1]);
			$result=str_replace("</td>","",$result);
			$result=str_replace("</a>","",$result);
			$result=preg_replace("/<td([\d\D]*?)>/","*",$result);
			$result=str_replace("上午*","",$result);
			$result=str_replace("下午*","",$result);
			$result=str_replace("晚上*","",$result);
			$result=preg_replace("/<a([\d\D]*?)>/","!!!",$result);
			$result=preg_replace("/<font([\d\D]*?)<\/font>/","",$result);
			$result=str_replace("<tr>","#",$result);
			$result1=explode("#",$result);
			$x=1;
			$course=array();
				for($a=3;$a<12;$a=$a+2){
					$result2=explode("*",$result1[$a]);
					$count=count($result2); 
					$y=1;
						 for($b=2;$b<$count;$b++){
							$result3=explode("!!!",$result2[$b]); 
							$count1=count($result3);
								for($c=0;$c<$count1;$c++){
									$courses .= $result3[$c];
								}
									$course[$y][$x]=$result2[$b];
									 $y++;
						 }
						 $x++ ;
				}
			return $course;
		}
		
		public function curl($send_url,$post_fields){ 
					$ch = curl_init($send_url);
					curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; WOW64; Trident/4.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; .NET4.0C; .NET4.0E; InfoPath.3)');
					curl_setopt($ch, CURLOPT_HEADER, 1);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt($ch, CURLOPT_AUTOREFERER, 0); 
					if(isset($post_fields)){
					curl_setopt($ch, CURLOPT_POST, 1);
					curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
					}
					curl_setopt($ch, CURLOPT_COOKIEFILE, $this->cookie_file);
					curl_setopt($ch, CURLOPT_COOKIEJAR, $this->cookie_file);
					$result = curl_exec($ch);
					curl_close($ch);
						return  $result;
		}
}
?>