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
                <a href="<?php echo U('Admin/Cycle/index');?>">
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

        <div class="manage_l">
            <div class="manage_title_l"><span>用户列表</span></div>
            <table border="none" cellspacing="" cellpadding="" class="table">
                <tr>
                    <th>用户名</th>
                    <th>手机号</th>
                    <th>备注信息</th>
                </tr>
                

                <?php if(is_array($data)): foreach($data as $k=>$vo): ?><tr>
                    <td class="huan" ids="<?php echo ($vo['id']); ?>" > <?php echo ($vo['username']); ?></td>
                    <td><?php echo ($vo['phone']); ?></td>
                    <td><?php echo ($vo['custom']); ?></td>
                </tr><?php endforeach; endif; ?>


            </table>
           <?php if( ($user_topnum < $count) OR ($user_topnum == $count) ): ?><!--  <div class="adds"></div> -->
            <?php else: ?> 
                <div class="adds"><a href="javascript:void(0)" onclick="showAll('#add_model')"> <span>添加</span> </a></div><?php endif; ?>
        

        </div>


        <div class="manage_r">
            <div class="manage_title_r"><span>用户权限及信息</span></div>
                <ul>
                    <li><label>用户名：</label> <span class="kname" data="<?php echo ($data[0]['username']); ?>"><?php echo ($data[0]['username']); ?></span> <!-- <input type="text" name="" id="" value="" /> -->
                    </li>
                    <li><label>手机号：</label> <span><?php echo ($data[0]['phone']); ?></span> <!-- <input type="text" name="" id="" value="" /> -->
                    </li>
                    <li><label>登录密码：</label> <span><input type="password" name="" value="<?php echo ($data[0]['password']); ?>"></span> <!-- <input type="text" name="" id="" value="" /> -->
                    </li>
                    <li><label>注册邮箱：</label> <span><?php echo ($data[0]['mail']); ?></span>
                        <!-- <input type="text" name="" id="" value="" /> -->                        </li>
                    <li><label>备注信息：</label> <?php echo ($data[0]['custom']); ?></li>
                    
                </ul>
            <div class="btn"><span class="manage_edit" onclick="showAll('#manage_model')"  data-id="<?php echo ($data[0]['id']); ?>" data-username="<?php echo ($data[0]['username']); ?>"  phone="<?php echo ($data[0]['phone']); ?>" password="<?php echo ($data[0]['password']); ?>" custom="<?php echo ($data[0]['custom']); ?>" mail="<?php echo ($data[0]['mail']); ?>">修改</span><span
                    class="manage_dele" data-id="<?php echo ($data[0]['id']); ?>"  >删除</span></div>
        </div>



    </div>
<div id="mask" class="mask"></div>
<div>
    <div id="add_model" class="manage_model"><img src="/Public/admin/img/tc_close.png" alt="" class="tc_close">
        <form class="form-horizontal" action="<?php echo U('User/add');?>" id="add_post" method="post">
        <h2>添加</h2>
        <ul>
            <li class="input_dx"><label for="">用户名：</label> <input type="text"  name="username" id="username" class="required"></li>
            <li class="input_dx"><label for="">手机号：</label> <input type="text"  name="phone" id="phone" class="required"></li>
            <li class="input_dx"><label for="">登录密码：</label> <input type="text"  name="password" id="password" class="required"></li>
            <li class="input_dx"><label for="">注册邮箱：</label> <input type="text" name="mail" id="mail" ></li>
            <li class="input_dx"><label for="">备注：</label> <input type="text"  name="custom"></li>
        </ul>
        <div class="manage_sear_cancle">
            <a href="javascript:void(0)" onclick="checkForm()" class="manage_search_butt">确定</a>
            <a href="javascript:void(0)" class="manage_cancle_butt">取消</a>
        </div>
        </form>
    </div>




    <div id="manage_model" class="manage_model"><img src="/Public/admin/img/tc_close.png" alt="" class="tc_close">
        <h2>修改信息</h2>
        <ul>
            <li class="input_dx"><label for="">用户名：</label> <input type="text"  name="username" readonly="readonly"  style="background: grey" id="changename" class="required" data-id="<?php echo ($data[0]['id']); ?>" value="<?php echo ($data[0]['username']); ?>" ></li>
            <li class="input_dx"><label for="">手机号：</label> <input type="text"  name="phone" id="phone" class="required"></li>
            <li class="input_dx"><label for="">登录密码：</label> <input type="text"  name="password" id="password" class="required"></li>
            <li class="input_dx"><label for="">注册邮箱：</label> <input type="text" name="mail" id="mail" ></li>
            <li class="input_dx"><label for="">备注：</label> <input type="text"  name="custom"></li>
        </ul>
        <div class="manage_sear_cancle">
            <a href="javascript:void(0)" class="manage_search_butt">确定</a>
           <!--  <a href="javascript:void(0)" class="cancle_butt">取消</a> -->
        </div>
    </div>



</div>
    <script type="text/javascript" src="/Public/admin/js/jquery-3.1.0.js" ></script>
    <script type="text/javascript" src="/Public/admin/js/index.js" ></script>
<script type="text/javascript">
    /*$(".tc_close").click(function () {
    $(".manage_model,#mask").hide();
})
*/
$(".manage_cancle_butt,.cancle_butt").click(function () {
    $("#add_model,#mask,#manage_model").hide();
})


$("body").delegate(".tc_close","click",function(){
  $(".manage_model,#mask").hide();
});
/*var zhi = $('#changename');
document.write("<td>"+zhi.+" J2EE开发</td>");*/

 



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

var ok1 = false;
var ok2 = false;
var ok3 = false;


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
            //验证姓名
            if($(this).is("#username")){
                var nameVal = $.trim(this.value); //原生js去空格方式：this.replace(/(^\s*)|(\s*$)/g, "")
                var regName = /[~#^$@%&!*()<>:;'"{}【】  ]/;
                if(nameVal == "" || nameVal.length < 6 || regName.test(nameVal)){
                    var errorMsg = " 姓名非空，长度6位以上，不包含特殊字符！";
                    //class='msg onError' 中间的空格是层叠样式的格式
                    $parent.append("<span class='msg onError'>" + errorMsg + "</span>");
                }else{
                    $.ajax({
                        type : 'get',
                        url : '<?php echo U('Admin/User/check');?>',
                        data : {username:nameVal},
                        dataType : 'json',
                        success : function(data){
                            if(data==1){
                               var errorMsg = " 该用户已存在！";
                                //class='msg onError' 中间的空格是层叠样式的格式
                                $parent.append("<span class='msg onError'>" + errorMsg + "</span>");
                            }else{
                                var okMsg=" 输入正确";
                                $parent.find(".high").remove();
                                $parent.append("<span class='msg onSuccess'>" + okMsg + "</span>");
                                  ok1 = true;  
                            }
                        }
                    })
                  
                }
            }

            //验证手机号
             if($(this).is("#phone")){
                 var Val = $.trim(this.value);
                var reg =/^1[34578]\d{9}$/;
                if(Val== "" || (Val != "" && !reg.test(Val))){
                    var errorMsg = " 请输入正确的手机号码！";
                    $parent.append("<span class='msg onError'>" + errorMsg + "</span>");
                }
                else{
                     $.ajax({
                        type : 'get',
                        url : '<?php echo U('Admin/User/checktel');?>',
                        data : {tel:Val},
                        dataType : 'json',
                        success : function(data){
                            if(data==1){
                               var errorMsg = " 该用户已存在！";
                                //class='msg onError' 中间的空格是层叠样式的格式
                                $parent.append("<span class='msg onError'>" + errorMsg + "</span>");
                            }else{
                                var okMsg=" 输入正确";
                                $parent.find(".high").remove();
                                $parent.append("<span class='msg onSuccess'>" + okMsg + "</span>");
                                  ok2 = true;           
                            }
                        }
                    })
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
                      //ok3 = true;  
                }
            }
        });
        
        //点击重置按钮时，通过trigger()来触发文本框的失去焦点事件
        $("#send").click(function(){
            //trigger 事件执行完后，浏览器会为submit按钮获得焦点
            $("form .required:input").trigger("blur"); 
            var numError = $("form .onError").length;
            if(numError){
                return false;
            }
            alert("注册成功！");
        });



function checkForm(){
     if(ok1&&ok2){  //alert(1);
        $('#add_post').submit();
    }else{
        return false;
    }
}

//左边页面替换
$("body").delegate(".huan","click",function(){

    var id = $(this).attr('ids');  //alert(id);
    $.ajax({
            type : 'get',
            url : '<?php echo U('Admin/Equipment/getone');?>',
            data : {id:id},
            dataType : 'json',
            success : function(data){ //alert(data);
                if(data){  
                  var  str='';
                  str+='<div class="manage_title_r"><span>客户权限及信息</span></div><ul><li><label>用户名：</label> <span class="kname" data="'+data.username+'">'+data.username+'</span></li><li><label>手机号：</label><span>'+data.phone+'</span></li><li><label>登录密码：</label> <span>'+data.password+'</span></li><li><label>注册邮箱：</label><span>'+data.mail+'</li></ul><div class="btn"><span class="manage_edit" onclick="showAll(`#manage_model`)" data-id="'+data.id+'" data-username="'+data.username+'" mail="'+data.mail+'" phone="'+data.phone+'" password="'+data.password+'" custom="'+data.custom+'">修改</span><span class="manage_dele"  data-id="'+data.id+'"  >删除</span></div>';
                 $('.manage_r').html(str);
                 
                }else{
                    alert('网络错误');
                }
            }
    })
});

//一键登录
$("div .manage_r").delegate('#yi','click',function(){
      var username = $('.manage_edit').attr('data-username');  alert(username);
      var password = $('.manage_edit').attr('password');
      
            if(confirm('确定要登录吗?')){
                  //window.href('index.html');
                 $.ajax({    
                        type : 'get',
                        url : '<?php echo U('Admin/Company/login');?>',
                        data : {username:username,password:password},
                        dataType : 'json',
                        success : function(data){
                          location.reload();
                        }
                });
            }         
});


//修改
$("body").delegate(".manage_edit","click",function(){

    var id = $(this).attr('data-id');  //alert(id);
    var username = $(this).attr('data-username');  //alert(username);
    var phone = $(this).attr('phone');  //alert(phone);
    var mail = $(this).attr('mail');  //alert(username);
    var password = $(this).attr('password');  //alert(username);
    var custom = $(this).attr('custom');  //alert(username);
    var str='';
    str+='<img src="/Public/admin/img/tc_close.png" alt="" class="tc_close"><h2>修改信息</h2><ul><li class="input_dx"><label for="">用户名：</label><input type="text"  name="username" readonly="readonly"  style="background: grey" id="changename" class="required" data-id="'+id+'" value="'+username+'" ></li><li class="input_dx"><label for="">手机号：</label><input type="text"  name="phone" id="phone" class="required" value="'+phone+'"></li><li class="input_dx"><label for="">登录密码：</label><input type="text"  name="password" id="password" class="required" value="'+password+'"></li><li class="input_dx"><label for="">注册邮箱：</label> <input type="text" name="mail" id="mail"  value="'+mail+'"></li><li class="input_dx"><label for="">备注：</label> <input type="text"  name="custom" value="'+custom+'"></li></ul><div class="manage_sear_cancle"><a href="javascript:void(0)" class="manage_search_butt"  id="queren" >确定</a></div>';
      $('#manage_model').html(str);




       $(":input.required").each(function () {
            //通过jquery api：$("HTML字符串") 创建jquery对象
            var $required = $("<strong class='high'>*</strong>");
            //添加到this对象的父级对象下
            $(this).parent().append($required);
        });
        $(":input").blur(function(){
             var $parent = $(this).parent();
            $parent.find(".msg").remove(); 
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

        });

        $('#queren').on('click', function () {
            var obj = {};
            $(':input').each(function (index, dom) {
              
                    obj[dom.name] = dom.value;
              
            });
            //console.log(obj);
            //var name =obj.username;
            var pass =obj.password;
            var ph =obj.phone;
            var ma =obj.mail;
            var cus =obj.custom;

            $.ajax({    
                type : 'get',
                url : '<?php echo U('Admin/Equipment/upuser');?>',
                data : {id:id,username:username,password:pass,phone:ph,mail:ma,custom:cus},
                dataType : 'json',
                success : function(data){
                    if(data.status==1){        
                     alert('修改成功');
                     location.reload(); 
                    }else{
                        //alert(data);
                        //console.log(data);
                        alert('修改失败');
                    }
                }
            });
        })

       
       // var phone_r = $(this).value(); alert(phone_r);  

});




//删除
$("body").delegate(".manage_dele","click",function(){
    if(confirm('确定要删除吗?')){
        var id = $(this).attr('data-id');  //alert(1);
        $.ajax({    //alert(11);
            type : 'get',
            url : '<?php echo U('Admin/Equipment/stopuser');?>',
            data : {id:id},
            dataType : 'json',
            success : function(data){
                if(data==1){        
                 alert('操作成功');
                 location.reload(); 
                }else{
                    alert('网络错误');
                }
            }
        })
    }    
});






</script>
</body>
</html>