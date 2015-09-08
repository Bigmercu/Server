<?php
@header("content-Type: text/html; charset=utf-8");
include "search_class.php";
	@$page=$_POST["page"];
	@$content=$_POST["content"];
	$book=new BookSearch();
		 $contents="";
		@$result=$book->search1($page,$content);
			if(!isset($result["null"])){
				 @$str=explode("####",$result["content"]);
					$count=count($str);
					if($count<12){
						$result["stop"]="true";
					}
					for($a=2;$a<$count;$a++){
						$str1=explode("****",$str[$a]);
							$str2=explode('" target="_blank">',$str1[3]);
								@$contents .= "\n<li data-icon='check' ><a href='#' class='ui-btn '>";
								@$contents .= "<h2>".trim($str1[1]).".".trim($str2[1])."</h2>";
								@$contents .= "<p>$str1[4]&nbsp;$str1[5]  </p>";
								@$contents .= "<p>索书号：<span style='color:#46A3FF;'>$str1[2]</span></p>";
								@$contents .= "</a></li>\n";
					} 
			}else{
					$contents .= '<div class="alert alert-danger alert-dismissable">
								   <button type="button" class="close" data-dismiss="alert" 
									  aria-hidden="true" data-inset="true" style="width:15px;"> &times;
									</button>找不到内容哦，换个词试试吧！
					 </div>';
					 $result["stop"]="true";
			}
			@$result["content"]=$contents;
			 $json = json_encode($result);
			 echo $json;
			

?>		   