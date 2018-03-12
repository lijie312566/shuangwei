<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport"
          content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no"/>
    <title>系统管理</title>
    <link rel="stylesheet" type="text/css" href="/Public/admin/css/public.css"/>
    <link rel="stylesheet" type="text/css" href="/Public/admin/css/index.css"/>
</head>
 <style>
     .int{ height: 30px; text-align: left; width: 600px; }
     label{ width: 200px; margin-left: 20px; }
     .high{ color: red; }
     .msg{ font-size: 13px; }
     .onError{ color: red; }
     .onSuccess{ color: green; }
 </style>
<body>
<div class="header"><img src="/Public/admin/img/logo.png"/> <span>双维科技信息管理平台</span></div>
<div class="content content2 clearfix">
    <div class="con_left">
        <ul>
            <li>
                <a href="<?php echo U('Admin/Equipment/index');?>">

                    <img src="/Public/admin/img/device1.png" class="icon1"/>
                    <img src="/Public/admin/img/device2.png" class="icon2"/>

                    <span>设备列表</span>
                </a>
            </li>

            <li>
                <a href="<?php echo U('Admin/Equipment/map');?>">

                    <img src="/Public/admin/img/position1.png" class="icon1"/>
                    <img src="/Public/admin/img/position2.png" class="icon2"/>

                    <span>地图地理</span>
                </a>
            </li>

            <li>
                <a href="<?php echo U('Admin/Equipment/search');?>">
                    <img src="/Public/admin/img/date1.png"  class="icon1"/>
                    <img src="/Public/admin/img/date2.png" class="icon2"/>
                    <span>数据展示</span>
                </a>
            </li>

            <li>
                <a href="<?php echo U('Admin/Equipment/manage');?>">
                    <img src="/Public/admin/img/set1.png"  class="icon1"/>
                    <img src="/Public/admin/img/set2.png"  class="icon2"/>
                    <span>系统管理</span>
                </a>
            </li>

        </ul>
        <a href="<?php echo U('Admin/Index/logout');?>"><img src="/Public/admin/img/quit.png" class="quit"/></a>
</div>

    <div class="con_middle manage clearfix">
        <div class="manage_r">
            <div class="manage_title_r"><span>用户个人及信息</span></div>
                <ul>
                    <li><label>用户名：</label> <span class="kname" data="<?php echo ($data[0]['username']); ?>"><?php echo ($data['username']); ?></span> <!-- <input type="text" name="" id="" value="" /> -->
                    </li>
                    <li><label>手机号：</label> <span><?php echo ($data['phone']); ?></span> <!-- <input type="text" name="" id="" value="" /> -->
                    </li>
                    <li><label>登录密码：</label> <span><input type="password" name="" value="<?php echo ($data['password']); ?>"></span> <!-- <input type="text" name="" id="" value="" /> -->
                    </li>
                    <li><label>注册邮箱：</label> <span><?php echo ($data['mail']); ?></span>
                        <!-- <input type="text" name="" id="" value="" /> -->                        </li>
                    <li><label>备注信息：</label> <?php echo ($data['custom']); ?></li>
                </ul>
            <div class="btn"><span class="manage_edit" onclick="showAll('#manage_model')"  data-id="<?php echo ($data[0]['id']); ?>" data-username="<?php echo ($data[0]['username']); ?>"  phone="<?php echo ($data[0]['phone']); ?>" password="<?php echo ($data[0]['password']); ?>" custom="<?php echo ($data[0]['custom']); ?>" mail="<?php echo ($data[0]['mail']); ?>">修改</span>
        </div>



    </div>
<div id="mask" class="mask"></div>
<div>
 
    <div id="manage_model" class="manage_model"><img src="/Public/admin/img/tc_close.png" alt="" class="tc_close">
        <form class="form-horizontal" action="<?php echo U('Admin/user/change_msg');?>" id="add_post" method="post">
        <h2>修改信息</h2>
        <ul>
            <li class="input_dx"><label for="">用户名：</label> <input type="text"  name="username" readonly="readonly"  style="background: grey" id="changename" class="required" data-id="<?php echo ($data['id']); ?>" value="<?php echo ($data['username']); ?>" ></li>
            <li class="input_dx"><label for="">手机号：</label> <input type="text"  name="phone" id="phone" class="required" value="<?php echo ($data['phone']); ?>"></li>
            <li class="input_dx"><label for="">登录密码：</label> <input type="text"  name="password" id="password" class="required" value="<?php echo ($data['password']); ?>"></li>
            <li class="input_dx"><label for="">注册邮箱：</label> <input type="text" name="mail" id="mail" value="<?php echo ($data['mail']); ?>" ></li>
            <li class="input_dx"><label for="">备注：</label> <input type="text"  name="custom" value="<?php echo ($data['custom']); ?>"></li>
        </ul>
        <div class="manage_sear_cancle">
          <a href="javascript:void(0)" onclick="checkForm()" class="manage_search_butt">确定</a>
            <a href="javascript:void(0)" class="manage_cancle_butt">取消</a>
        </div>
        </form>
    </div>



</div>
    <script type="text/javascript" src="/Public/admin/js/jquery-3.1.0.js" ></script>
    <script type="text/javascript" src="/Public/admin/js/index.js" ></script>
<script type="text/javascript">
    $(".tc_close").click(function () {
    $(".manage_model,#mask").hide();
})


function showMask(){
     $("#mask").css("height",$(document).height());
     $("#mask").css("width",$(document).width());
     $("#mask").show();
 }

   function letDivCenter(divName){
       var top = ($(window).height() - $(divName).height())/2;
       var left = ($(window).width() - $(divName).width())/2;
       var scrollTop = $(document).scrollTop();
       var scrollLeft = $(document).scrollLeft();
       $(divName).css( { position : 'absolute', 'top' : top + scrollTop, left : left + scrollLeft } ).show();
   }

    function showAll(divName){
        showMask();
        letDivCenter(divName);
    }
//为表单的必填文本框添加提示信息（选择form中的所有后代input元素）
        $("form :input.required").each(function () {
            //通过jquery api：$("HTML字符串") 创建jquery对象
            var $required = $("<strong class='high'>*</strong>");
            //添加到this对象的父级对象下
            $(this).parent().append($required);
        });
         //为表单元素添加失去焦点事件
        $("form :input").blur(function(){
            var $parent = $(this).parent();
            $parent.find(".msg").remove(); //删除以前的提醒元素（find()：查找匹配元素集中元素的所有匹配元素）
            //验证手机号
             if($(this).is("#phone")){
                var Val = $.trim(this.value);
                var reg =/^1[34578]\d{9}$/;
                if(Val== "" || (Val != "" && !reg.test(Val))){
                    var errorMsg = " 请输入正确的手机号码！";
                    $parent.append("<span class='msg onError'>" + errorMsg + "</span>");
                }
                else{
                    var okMsg=" 输入正确";
                    $parent.find(".high").remove();
                    $parent.append("<span class='msg onSuccess'>" + okMsg + "</span>");
                }
            }
            

            //验证邮箱
            if($(this).is("#mail")){
                var emailVal = $.trim(this.value);
                var regEmail = /.+@.+\.[a-zA-Z]{2,4}$/;
                if(emailVal== "" || (emailVal != "" && !regEmail.test(emailVal))){
                    var errorMsg = " 请输入正确的E-Mail！";
                    $parent.append("<span class='msg onError'>" + errorMsg + "</span>");
                }
                else{
                    var okMsg=" 输入正确";
                    $parent.find(".high").remove();
                    $parent.append("<span class='msg onSuccess'>" + okMsg + "</span>");
                }
            }
        })



function checkForm(){
    var username =$('#username').val();
    var password =$('#password').val();
    var phone =$('#phone').val();
   
    if((username!='')&&(password!='')&&(phone!='')){  //alert(1);
        $('#add_post').submit();
    }else{
        return false;
    }
}







</script>
</body>
</html>