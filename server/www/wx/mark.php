<!DOCTYPE html>
<?php
include "login_class.php";
	$xuenian=$_GET["xuenian"];
	$xueqi=$_GET["xueqi"];
	$openid=$_GET["openid"];
	include "bangding/config.php";
					$mysql="select * from user where openid='{$openid}'";
					$result=$conn->query($mysql);
					$row=$result->fetch_row();
					$username=base64_decode($row[1]);
					$password=base64_decode($row[2]);
	$login = new Login($username,$password);
	$contents=$login->chengji($xuenian,$xueqi);
?>
<html>
<head>
   <title><?php echo $contents["title"];?></title>
   <link href="http://libs.baidu.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
   <script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
   <script src="http://libs.baidu.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
   <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0;" name="viewport" />
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <script>
		  $(function () { $('.tooltip-show').tooltip('show');});
		  $(function () { $('.tooltip-hide').tooltip('hide');});
		  $(function () { $('.tooltip-destroy').tooltip('destroy');});
		  $(function () { $('.tooltip-toggle').tooltip('toggle');});
		  $(function () { $(".tooltip-options a").tooltip({html : true });});
	  
		   $(function () { $('#collapseFour').collapse({toggle: false})});
		   $(function () { $('#collapseTwo').collapse('show')});
		   $(function () { $('#collapseThree').collapse('toggle')});
		   $(function () { $('#collapseOne').collapse('hide')});
   </script>
</head>
<body style="width:100%">
<thead >
<tr style="width:99%" ><td >
<div class="btn-group l" style="width:100%;background:#46A3FF" >
   <button type="button" class="btn btn-primary dropdown-toggle" style="background:#46A3FF;height:45px;border:0" data-toggle="dropdown">菜单 <span class="caret"></span></button>
   <ul class="dropdown-menu" role="menu">
   <?php
   $str=$contents["option"];
   $str1=explode("#",$str);
   for($a=1;$a<5;$a++){
   ?>
		  <li><a href="?xuenian=<?php echo $str1[$a],'&xueqi=1&openid='.$openid;?>" data-transition="flip" ><?php echo $str1[$a],'上学期';?></a></li>
		  <li><a href="?xuenian=<?php echo $str1[$a],'&xueqi=2&openid='.$openid;?>" data-transition="flip"><?php echo $str1[$a],'下学期';?></a></li>
	<li class="divider"></li>
		<?php
   }
   ?>
		  <li><a href="?xuenian=<?php echo '&xueqi=&openid=',$openid; ?>"data-transition="flip">查看全部成绩</a></li>
   </ul>
		</div>
			</td></tr>
 </thead>
<table class="table" style="width:99.9%;">
 <thead>
      <tr class="success">
         <th>科目</th>
		 <th>学分</th>
		 <th>绩点</th>
         <th>成绩</th>
      </tr>
   </thead>

   <tbody>
 <?php
 $result=$contents["content"];
 $str=explode("#",$result);
			$count=count($str);
			$style = array("active","warning","success","danger");
			$i=0;
			$mark=0;
			$xuefen_sum=0;
			for($a=2;$a<$count;$a++){
				$str1=explode("*",$str[$a]);
				$mark =$mark + ((int)trim($str1[7]))*((int)trim($str1[9]));
				$xuefen_sum  =$xuefen_sum + (int)trim($str1[7]);
?>	
				<tr class="<?php echo $style[$i]; $i++;if($i>3){$i=0;}//科目 ?>">
						<td><?php echo trim($str1[4]);//科目 ?></td>
						<td><?php echo trim($str1[7]);//学分 ?></td>
						<td><?php echo trim($str1[8]);//绩点?></td>
						<td>
						<?php 
							$sa='';
							if(trim($str1[11])!=="&nbsp;"){
								if(trim($str1[12])=="&nbsp;"){
									echo '<a href="#" class="tooltip-show" data-toggle="tooltip" title="补考'.trim($str1[11]).'">';
									$sa='</a>';
								}else{
									echo '<a href="#" class="tooltip-show" data-toggle="tooltip" title="重修'.trim($str1[11]).'">';
									$sa='</a>';
								}
							}
						?>
						<span class="badge">
						<?php 
							echo trim($str1[9]);//成绩
							echo "</span>",$sa;
						?>
						</td>
				</tr>
				
			<?php
			}
			if($i==0){
				echo '<tr>
						<td colspan="4">
							<div class="alert alert-danger alert-dismissable">
								   <button type="button" class="close" data-dismiss="alert" 
									  aria-hidden="true"> &times;
									</button>暂无当前学期成绩信息,请切换其他学期查看
							</div>
						</td>
					</tr>';
			}
			if($contents["zyrs"]==""){
				echo '<tr>
						<td colspan="4">
							<div class="alert alert-danger alert-dismissable">
								   <button type="button" class="close" data-dismiss="alert" 
									  aria-hidden="true"> &times;
									</button>系统检测到你的信息可能已经更改，请回复"解绑"后重新绑定
							</div>
						</td>
					</tr>';
			}
			if($mark!==0){
				$v=sprintf("%.2f", ($mark/$xuefen_sum));
				echo '<tr class="'.$style[$i].'">
						 <td>平均</td>
						 <td>——</td>
						 <td>'.sprintf("%.2f",($v-50)/10) .'</td>
						 <td>'.$v.'</td>
					  </tr>';
			}
			
			?>
   </tbody>
</table>

<div class="panel panel-warning">
      <div class="panel-heading">
         <h4 class="panel-title" style="text-align:center;">
            <a data-toggle="collapse" data-parent="#accordion" 
               href="#collapseFour" >
               点击这里查看更多信息
            </a>
         </h4>
      </div>
      <div id="collapseFour" class="panel-collapse collapse">
         <div class="panel-body">
		 <table class="table table-hover">
            <?php
			if(!empty($contents["zyrs"])){
				echo '<tr><td>本专业共</td><td>',$contents["zyrs"],'</td></tr>';
				$str=explode("#",$contents["status"]);
				echo '<tr><td>所选学分</td><td>',$str[0],'</td></tr>';
				echo '<tr><td>获得学分</td><td>',$str[1],'</td></tr>';
				echo '<tr><td>重修学分</td><td>',$str[2],'</td></tr>';
				$str=explode("#",$contents["pjxfjd"]);
				echo '<tr><td>平均绩点</td><td>',$str[0],'</td></tr>';
				echo '<tr><td>平均成绩</td><td>',$str[1],'</td></tr>';
				echo '<tr><td>绩点总和</td><td>',$contents["xfjdzh"],'</td></tr>';
			}
			?>
			</table>
         </div>
      </div>
   </div>
</div>
</body>
<div>
</html>
			