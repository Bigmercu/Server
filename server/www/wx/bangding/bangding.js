function judge(){
 var username=$("#username").val();
 if(username==''){
			$(".wait").text('请输入学号！');
			$(".wait").toggle( "fade" );
			 setTimeout(function(){
						$(".wait").hide();
						$("#username").focus();
			},2500);
			return false;
}
var password=$("#password").val();
 if(password==''){
			$(".wait").text('请输入密码！');
			$(".wait").toggle( "fade" );
			 setTimeout(function(){
						$(".wait").hide();
						$("#password").focus();
			},2500);
			return false;
}
var openid=$("#openid").val();
$(document).ready(function(){
		 $("#button").attr("disabled",true);
		 $("#button").val("正在提交...");  
		 $(".wait").html('<img src="../img/more.gif" /><span>正在提交……</span>');
		 $(".wait").show();
 var conferm="<br><button id='conferm' onclick='judge1();'>确定</button>"
$.ajax({     
            type: "post",     
            url: "yanzheng.php",           
            data: {'username':username,'password':password,'openid':openid},          
            dataType: "html",     
            success: function(data) { 
			  $(".wait").hide();
			 var re =new RegExp("你的帐号已经绑定,无须重复操作,谢谢"); 
                if(re.test(data)){//正则匹配判断结果
				$(".waita").html(data+conferm);
				$("#mcover").show();
                $(".waita").show();
				$("#button").attr("disabled",false);
                $("#button").val("确认绑定");
				}
				var re =new RegExp("数据库连接错误!"); 
                if(re.test(data)){//正则匹配判断结果
				$(".wait").html(data);
                $(".wait").show();
				setTimeout(function(){
				$(".wait").hide();
				$("#button").attr("disabled",false);
                $("#button").val("重试");
			    },2500);
			   return false;
				}
				var re =new RegExp("欢迎使用微信教务查询系统"); 
                if(re.test(data)){//正则匹配判断结果
				$(".waita").html(data+conferm);
				$("#mcover").show();
                $(".waita").show();
				$("#button").attr("disabled",false);
                $("#button").val("确认绑定");
				return false;
				}
				var re =new RegExp("用户名或密码错误");				
                if(re.test(data)){//正则匹配判断结果
				$(".wait").html(data);
                $(".wait").show();
				setTimeout(function(){
						$(".wait").hide();
						$("#button").attr("disabled",false);
						$("#button").val("确认绑定");
						$("#password").val('');
						$("#password").focus();
			    },2500);
			   return false;
					}
				
            } ,
 error:function(){   
			$(".wait").text('网络错误！');
			setTimeout(function(){
			$(".wait").hide();
           $("#button").attr("disabled",false);
               $("#button").val("重试");
			   },2500);
			   return false;
            }			
        });      
});
}
function judge1(){
WeixinJSBridge.call('closeWindow');
}
