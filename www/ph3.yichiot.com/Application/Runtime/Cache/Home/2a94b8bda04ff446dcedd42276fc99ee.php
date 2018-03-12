<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<title>登录注册首页</title>
		<link rel="stylesheet" type="text/css" href="/Public/admin/css/public.css"/>
		<link rel="stylesheet" type="text/css" href="/Public/admin/css/login.css"/>
		<script type="text/javascript" src="/Public/admin/js/jquery-3.1.0.js" ></script>
		<script type="text/javascript" src="/Public/admin/js/index.js" ></script>




        
	</head>
	<body  onkeydown="keyLogin()">
		<div class="login_content">
			<img class="logo" src="/Public/admin/img/logo.png"/>
			<div class="title">
				<h2>双维科技信息管理平台</h2>
				<img src="/Public/admin/img/title.png"/>
			</div>
			<div class="login_mes">
                <form action="<?php echo U('Home/Index/index');?>" method="post" id="add_post" >
                	<span style="color:#fff">选择身份：</span>
                	<select name="identity" id="identity">
                		<option>请选择</option>
                		<option value="1" selected="selected">管理员</option>
                		<option value="2">客户</option>
                		<option value="3">维修工</option>
                	</select><br>
					<input type="text" name="username" id="username" value="" placeholder="用户名" style="margin-top:15px;"/>
					<input type="password" name="password" id="password" value="" placeholder="请输入密码"/>
					<!--<input type="text" name="" id="" value="" placeholder="输入收到的验证码" class="btn btn1"/>-->
					<!--<input type="button" name="" id="" value="发送验证码" class="btn yzCode"/>-->
					<input type="button" class="sub btn btn-primary btn-lg btn-block" value="立即登录" onclick="checkForm()"/>
				</form>
			</div>
			<div class="foot">
				<span>©2017&nbsp;&nbsp;京ICP备17066263号</span>
			</div>
		</div>

		<script>

function checkForm(){
    var username =$('#username').val();
    var password =$('#password').val();
    var identity =$('#identity').val();
   
    if((username!='')&&(password!='')&&(identity!='')){  //alert(1);
        $('#add_post').submit();
    }else{
    	alert('请检查是否填写完整');
        return false;
    }
}



function keyLogin(){
 	if (event.keyCode==13){ //回车键的键值为13
 		if((username!='')&&(password!='')&&(identity!='')){ 
  			$('#add_post').submit(); //调用登录按钮的登录事件
  		}else{
	    	alert('请检查是否填写完整');
	        return false;
    	}
 	}  
}










$(function(){
     // 错误信息
     function funalert () {
        $('body').append('<div class="alert" id="alert">您输入的手机号格式有误，请重新输入</div>')
        setTimeout(function () {
          $('#alert').remove();
          // $("#confirmer").Attr("click");
        },3000);
      } 
     // login手机号验证
      $(".yzCode").click(function(){
         // $(this).removeAttr('click');
         console.log("1");
         var num = $('#tel').val();
         var regMobile = /^1[3,4,5,7,8]\d{9}$/;  //判断输入的是否为一个手机号码
         if(num == '' || !regMobile.test(num)){
          $('#tel').focus();           
          funalert();
          return false;
      }else{
         var count = 60,     //定义倒计时秒数
         courCount;      //当前剩余秒数
         courCount = count;
          $('.yzCode').html( courCount );
          var timer = setInterval(function() {
            if (courCount == 0) {
              clearInterval(timer);
              $('.yzCode').html("发送验证码");
            } else {
              courCount--;
              $('.yzCode').html(courCount);
            };
          }, 1000);
      }   
      //验证码按钮 (填写完验证码点击的按钮)
      $('.confirmer').click(function(){
      	//alert(1);
        var tel_num = $('#tel').val(),   //获取到要发送的手机号
            send_btn_val = $('.yzCode').val(); //获取到用户输入的验证码

        // $.ajax({
        //   type:'post',
        //   url:,
        //   data:{
        //     tel_num:,
        //     send_btn_val:
        //   },
        //   dataType'json',
        //   success:function(data){

        //   },error:function(){

        //   }
        // })
       
      });   
    })
})
		</script>
	</body>
</html>