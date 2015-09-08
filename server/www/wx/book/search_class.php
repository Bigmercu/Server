<?php
/* 
*图书检索核心程序
 */
class BookSearch{
	private $base_url;
	
	public function __construct(){ 
			$this->base_url = "http://tsg.jxust.cn/museweb/wxjs/";
		} 
	
	public function search1($page,$content){ 
			if($content=="php"&&$page==3){
				$page=5;
			}
			$content = iconv("UTF-8", "gb2312", $content);
			$url="tmjs.asp?page=$page&txtWxlx=CN&txtTm=$content&txtLx=%25&txtSearchType=1&nMaxCount=0&nSetPageSize=10&txtPy=HZ&cSortFld=%D5%FD%CC%E2%C3%FB";
			$result=file_get_contents($this->base_url.$url);
			$result=iconv("gb2312", "UTF-8", $result);
				$result=$this->analyses($result);
			return $result;
		} 
	
	 public function analyses($result){ 
			if(preg_match('/暂时没有内容/',$result)){
				$result_search["null"]="没有找到你要查的书籍";
			}else{
				preg_match('/<table align=center  width="100%" border="0" cellpadding="8" cellspacing="0" style="border-bottom:1px solid #aaaaaa;margin:0px 0px 8px 0px;" >([\d\D]*?)<\/Center>/',$result,$result1);
				preg_match('/共([\d\D]*?)条记录/',$result1[1],$result2);
				$result_search["num"] = $result2[1];//总数
				
				preg_match('/页次：<font color=\'red\'>([\d\D]*?)<\/font>/',$result1[1],$result2);
				$result_search["page"] = (int)$result2[1] +1;//当前所在页数+1
				
				preg_match('/<table align="center" border="0" cellspacing="0" width="98%">([\d\D]*?)<\/table>/',$result,$result1);
				$result=str_replace('<a href="..',"",$result1[1]);
				$result=str_replace("&nbsp;","",$result);
				$result=preg_replace("/<td([\d\D]*?)>/","****",$result);
				$result=preg_replace("/<tr([\d\D]*?)>/","####",$result);
				$result=preg_replace("/<([\d\D]*?)>/","",$result);
				
				$result_search["content"]=$result;
				$result_search["stop"]="false";
				
			}
			return $result_search;
		} 
}
?>