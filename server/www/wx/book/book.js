 flag=true;
function search(){
$("#search_button").attr("disabled",true);
var content=$("#search_content").val();
if (content ==''){
	$(".wait").text('请输入内容！');
			$(".wait").toggle( "fade" );
			 setTimeout(function(){
			$(".wait").hide();
			$("#search_content").focus();
			$("#search_button").attr("disabled",false);
			},2500);
			return false;
}	
$(document).ready(function(){
  $(".wait").html('<img src="../img/more.gif" /><span>正在查询</span>');
  $(".wait").show();  
  $("#search_button").val("正在检索。。。");
		$.ajax({     
				type: "post",     
				url: "get_content.php",           
				data: {'page':'1','content':content},         
				dataType: "json",  
		success: function(data) {
				$("#content").html(data.content);
				$("#page").val(data.page);
				$("#old_content").val(content);
				$("#num").val(data.num);
				$(".wait").hide();  
				$("#search_content").val('');
				$("#search_button").val("搜索");
				flag=true;
				$("#search_button").attr("disabled",false);
					return false;
				},
		error:function(){   	
				alert('网络错误');
				$(".wait").hide();  
				flag=true;
				$("#search_button").val("搜索");
				$("#search_button").attr("disabled",false);
				  return false;
				}	
				});
    
});
    return false;  
}

$(document).ready(function(){
$(window).scroll(function(){
		var totalheight = parseFloat($(window).height()) + parseFloat($(window).scrollTop());
		if($(document).height() <= totalheight+500){
				var num=$("#num").val();
				var page=$("#page").val();
				var content=$("#old_content").val();
					if(num>10&&flag==true){
						flag=false;
						$('#more').show();
						$.ajax({     
								type: "post",     
								url: "get_content.php",           
								data: {'page':page,'content':content},         
								dataType: "json",  
						success: function(data) {
								if(data.stop=="true"){
									$("#content").append(data.content);
									$("#page").val(data.page);
										flag=false;
										$('#more').hide();
								}else{
								$("#content").append(data.content);
								$("#page").val(data.page);
										flag=true;
										$('#more').hide();
								}
									return false;
								},
						error:function(){   	
								alert('网络错误');
								  $('#more').hide();
								  flag=true;
								  return false;
								}	
								});
									}
							
										}
				});
});
