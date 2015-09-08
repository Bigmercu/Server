<?php
error_reporting(0);
@header("content-Type: text/html; charset=utf-8");

class Get_content{ 
	private $day; 
	private $number;
	private $course;
	
public function __construct($course,$day,$number){ 
		$this->day = $day; 
		$this->number = $number;
		$this->course = $course;
		} 
		
		public function Get_content($week){ 
			$content=explode("!!!",$this->course[$this->day][$this->number]);
			$kb_content='';
				foreach ($content as $value){
					$content= explode ("<br>",$value);
					preg_match('/{([\d\D]*?)}/',$content[1],$result);
					preg_match('/第([\d\D]*?)周/',$result[1],$result1);
					$dd=explode("-",$result1[1]);
					 if((int)$dd[0]<=$week&&(int)$dd[1]>=$week){//判断时间
								$date=date("Y年n月j日");
									 if(preg_match('/双/',$result[1])){
										   if((int)(($week+2)%2)==0){
												if(!empty($content[4])&&preg_match('/$date/',$content[4])){
														$kb_content .= $content[0]."\n".$content[2]."\n".$content[5]."\n";
													}else{
														$kb_content .= $content[0]."\n".$content[2]."\n".$content[3]."\n";
													}
										   }		
										}elseif(preg_match('/单/',$result[1])){
											if((int)(($week+2)%2)==1){
												if(!empty($content[4])&&preg_match('/$date/',$content[4])){
														$kb_content .= $content[0]."\n".$content[2]."\n".$content[5]."\n";
													}else{
														$kb_content .= $content[0]."\n".$content[2]."\n".$content[3]."\n";
													}
											}
										}else{
											$kb_content .= "\n".$content[0]."\n".$content[2]."\n".$content[3]."\n";
										} 
					 }
				}
				return trim($kb_content);
		}
}
?>