<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport"
          content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no"/>
    <title>双维金叶</title>
    <link rel="stylesheet" type="text/css" href="/Public/admin/css/public.css"/>
    <link rel="stylesheet" type="text/css" href="/Public/admin/css/index.css"/>
</head>
<body>
<div class="header"><img src="/Public/admin/img/logo.png"/> <span>双维科技信息管理平台</span></div>
<div class="content content1 clearfix">
    <div class="con_left">
        <ul>
            <li><a href="<?php echo U('Admin/Equipment/index');?>"> <img src="/Public/admin/img/device1.png" class="icon1"/> <img src="/Public/admin/img/device2.png"
                                                                                      class="icon2"/> <span>设备列表</span>
            </a></li>
            <li><a href="<?php echo U('Admin/Equipment/map');?>"> <img src="/Public/admin/img/position1.png" class="icon1"/> <img src="/Public/admin/img/position2.png"
                                                                                      class="icon2"/> <span>地图地理</span>
            </a></li>
            <li><a href="<?php echo U('Admin/Cycle/index');?>"> <img src="/Public/admin/img/date1.png" class="icon1"/> <img src="/Public/admin/img/date2.png"
                                                                                           class="icon2"/>
                <span>数据展示</span> </a></li>
            <li><a href="<?php echo U('Admin/Equipment/manage');?>"> <img src="/Public/admin/img/set1.png" class="icon1"/> <img src="/Public/admin/img/set2.png" class="icon2"/>
                <span>系统管理</span> </a></li>
        </ul>
        <a href="<?php echo U('Admin/Index/logout');?>"><img src="/Public/admin/img/quit.png" class="quit"/></a>
    </div>
    <div class="con_middle">
        <div class="title">
            <table border="none" cellspacing="" cellpadding="" class="table_top">
                <tr>

                    <th <?php  if($style=='temperature'){ ?> class="actives" <?php  } ?>    >温度</th>
                    <th <?php  if($style=='humidity'){ ?> class="actives" <?php  } ?>       >湿度</th>
                    <th <?php  if($style=='concentration'){ ?> class="actives" <?php  } ?>  >PH3</th>
                    <th <?php  if($style=='co'){ ?> class="actives" <?php  } ?>  >CO</th> 

                </tr>
            </table>
        </div>

        <div class="z-content">
            <div class="table-wrap">
                <table border="none" cellspacing="" cellpadding="" class="table">
                    <tr>
                        <th>设备编码</th>
                        <th>在线状态</th>
                        <th>数据</th>
                        <th>自定义信息</th>
                    </tr>
                    <!-- 温度 -->
                    <?php if(is_array($data['list'])): foreach($data['list'] as $key=>$vo): ?><tr>
                            <td><img name="id" value="<?php echo ($vo['device_sn']); ?>" class="cha" src="/Public/admin/img/square.png"/><a href="<?php echo U('Admin/Equipment/map').'?device_sn='.$vo['device_sn'].'&dw=0';?>"><?php echo ($vo['device_sn']); ?></a></td>
                             <?php if($vo['device_status'] == 1): ?><td>在线</td>
                                
                            <?php elseif($vo['device_status'] == 2): ?>
                               <td  class="actives">报警</td>
                            <?php elseif($vo['device_status'] == 3): ?>
                              <td class="bj_yellow">电量低</td> 
                            <?php else: ?>
                               <td class="lx_line">离线</td><?php endif; ?>
                            <td class="temperature"><?php echo ($vo['temperature']); ?>℃</td>
                            <td><?php echo ($vo['custom']); ?></td>
                        </tr><?php endforeach; endif; ?>
                </table>

                    <!-- 湿度 -->
                <table border="none" cellspacing="" cellpadding="" class="table">
                    <tr>
                        <th>设备编码</th>
                        <th>在线状态</th>
                        <th>数据</th>
                        <th>自定义信息</th>
                    </tr>
                     <?php if(is_array($data['list'])): foreach($data['list'] as $key=>$vo): ?><tr>
                        <td><img name="id" value="<?php echo ($vo['device_sn']); ?>" class="cha" src="/Public/admin/img/square.png"/><a href="<?php echo U('Admin/Equipment/map').'?device_sn='.$vo['device_sn'].'&dw=1';?>"><?php echo ($vo['device_sn']); ?></a></td>
                       
                            <?php if($vo['device_status'] == 1): ?><td>在线</td>
                                
                            <?php elseif($vo['device_status'] == 2): ?>
                               <td  class="actives">报警</td>
                            <?php elseif($vo['device_status'] == 3): ?>
                              <td class="bj_yellow">电量低</td> 
                            <?php else: ?>
                               <td class="lx_line">离线</td><?php endif; ?>
                        
                        <td><?php echo ($vo['humidity']); ?>%RH</td>
                        <td><?php echo ($vo['custom']); ?></td>
                    </tr><?php endforeach; endif; ?>
                </table>

                    <!--PH3  -->
                <table border="none" cellspacing="" cellpadding="" class="table">
                    <tr>
                        <th>设备编码</th>
                        <th>在线状态</th>
                        <th>数据</th>
                        <th>自定义信息</th>
                    </tr>
                    <?php if(is_array($data['list'])): foreach($data['list'] as $key=>$vo): ?><tr>
                        <td><img name="id" value="<?php echo ($vo['device_sn']); ?>" class="cha" src="/Public/admin/img/square.png"/><a href="<?php echo U('Admin/Equipment/map').'?device_sn='.$vo['device_sn'].'&dw=2';?>"><?php echo ($vo['device_sn']); ?></a></td>
                        <?php if($vo['device_status'] == 1): ?><td>在线</td>
                                
                            <?php elseif($vo['device_status'] == 2): ?>
                               <td  class="actives">报警</td>
                            <?php elseif($vo['device_status'] == 3): ?>
                              <td class="bj_yellow">电量低</td> 
                            <?php else: ?>
                               <td class="lx_line">离线</td><?php endif; ?>
                        <td><?php echo ($vo['concentration']); ?>ppm</td>
                        <td><?php echo ($vo['custom']); ?></td>
                    </tr><?php endforeach; endif; ?>
                </table>


                <!--CO  -->
                <table border="none" cellspacing="" cellpadding="" class="table">
                    <tr>
                        <th>设备编码</th>
                        <th>在线状态</th>
                        <th>数据</th>
                        <th>自定义信息</th>
                    </tr>
                    <?php if(is_array($data['list'])): foreach($data['list'] as $key=>$vo): ?><tr>
                        <td><img name="id" value="<?php echo ($vo['device_sn']); ?>" class="cha" src="/Public/admin/img/square.png"/><a href="<?php echo U('Admin/Equipment/map').'?device_sn='.$vo['device_sn'].'&dw=3';?>"><?php echo ($vo['device_sn']); ?></a></td>
                        <?php if($vo['device_status'] == 1): ?><td>在线</td>
                                
                            <?php elseif($vo['device_status'] == 2): ?>
                               <td  class="actives">报警</td>
                            <?php elseif($vo['device_status'] == 3): ?>
                              <td class="bj_yellow">电量低</td> 
                            <?php else: ?>
                               <td class="lx_line">离线</td><?php endif; ?>
                        <td><?php echo ($vo['co']); ?>ppm</td>
                        <td><?php echo ($vo['custom']); ?></td>
                    </tr><?php endforeach; endif; ?>
                </table>
            </div>

             <div class="page">                       
                            <ul class="clearfix">
                                 <?php echo ($data['page']); ?> 
                            </ul>                      
                    </div>
        </div>     
    </div>




    <div class="con_right">                
   <form action="<?php echo U('Admin/Equipment/index');?>" method="get" id="search_get"> 
        <div class="code"><span>设备编码：</span>
            <input type="text" name="device_sn" id="shebei" value="" placeholder="支持模糊查询" class="btn"/>
        </div>
        <div class="run clearfix"><span class="run_states">运行状态：</span>
            <div class="run_in clearfix">
                <select name="device_status" id="device_status">
                    <option value="1">在线</option>
                    <option value="2">报警</option>
                    <option value="3">电量低</option>
                    <option value="4">离线</option>
                </select>
            </div>
        </div>
        <div class="date clearfix"><span class="run_states">数据：</span>
            <div class="date_in">
                <i class="clearfix">      
                <select class="fh_datas" name="limit" id="limit">
                    <option value="1" selected="selected">></option>
                    <option value="2"><</option>
                    <option value="3">=</option>
                 </select>
                </i> 
                <i><span><input type="text" name="range" id="range"> </span><span class="dw">℃</span> </i>
           </div>
            <input type="hidden" name="dw" class="dwval" id="dw">
            </div>
        <div class="run mes"><span>自定义信息：</span> <input type="text" name="custom" id="custom" value="" placeholder="支持模糊查询" class="btn"/></div>



        <input type="submit" name=""  value="查询设备" class="search" id="begin_search" /> 
        <input type="button" name="" id="" value="添加设备"     class="add_sb"   onclick="showAll('#manage_model')"/>
        <input type="button" name="" id="xun" value="历史数据" class="history_data" onclick="showAll('#model')"/>
   </form>

    </div>
</div>
<div id="mask" class="mask"></div>
<div>
     <form action="<?php echo U('Admin/Cycle/index');?>" method="POST" id="history_post">
    <div id="model" class="model"><img src="/Public/admin/img/tc_close.png" alt="" class="tc_close">
        <input type="hidden" name="ids" value="" id="ids">
        <h2>历史数据</h2>
        <ul> <input type="hidden" name="dw" class="dwval" id="dw">
                <li class="input_dx">
                    <label for="">时间跨度</label>
                    <select name="kuadu" id="kuadu">
                        <option selected="selected" value="week">两周内</option>
                        <option value="year">一年</option>
                    </select>        
                </li>
                <li class="input_dx clearfix">
                    <label  style="float:left;line-height:40px;" for="">起止时间：</label>

                    <p style="float:left" id="week">
                        <b>from</b><span ><input type="text" name="starting_point" id="test1"><!-- <img src="/Public/admin/img/watch.png"> --></span>
                        <b>to</b><span ><input type="text" name="end" id="test2"><!-- <img src="/Public/admin/img/watch.png"> --></span>
                    </p>


                    <p style="float:left;display:none;" id="year">
                        <input type="text" name="point" id="test3">
                    </p>

                </li>
                <li class="jg_dx clearfix">
                    <label style="line-height:42px;float:left;" for="">间隔：</label>

                    <p  style="float:left;" id="time"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>
                    <input type="text" name="interval">
                    <b>&nbsp;&nbsp;&nbsp;&nbsp;</b>
                     <select name="time">
                        <option value="1" selected="selected">分钟</option>
                        <option value="2">小时</option>
                        <option value="3">日</option>
                        <option value="4">星期</option>
                    </select></p>

                     <p style="display:none; float:left;" id="month"><input type="text" name="intervals" value="1" style="background: grey" readonly/>
                        <select name="y_time"  >
                            <option value="5">月</option>
                        </select>
                    </p> 

                </li>
            </ul>
        <div class="sear_cancle">
            <a href="javascript:void(0)" class="search_butt">查询</a> <a href="javascript:void(0)" class="cancle_butt">取消</a>
        </div>
    </div>
     </form>
</div>
<div>
    <div id="manage_model" class="manage_model"><img src="/Public/admin/img/tc_close.png" alt="" class="tc_close">
        <form action="<?php echo U('Admin/Equipment/dataadd');?>" method="POST" id="add_post">
        <h2>添加设备</h2>
        <ul>
            <li class="input_dx"><label for="">设备编码：</label> <input type="text" name="device_sn" id="device_sn"></li>
            <li class="input_dx"><label for="">自定义信息：</label> <input type="text" name="custom"></li>
        </ul>
        <div class="add-per">
            <h2>添加关联人</h2>
            <select class="add-select" name="user_id" >
                <?php if(is_array($user)): foreach($user as $key=>$v): ?><option value="<?php echo ($v["id"]); ?>"><?php echo ($v["username"]); ?></option><?php endforeach; endif; ?>
            </select>
            <div>
                <a href="javascript:void(0)" class="save">保存</a>
                <a href="javascript:void(0)" class="cancle-z">取消</a>
            </div>
        </div>
        <div class="manage_sear_cancle" style="margin-top:10px;">
          <a href="javascript:void(0)" class="manage_search_butt" onclick="checkForm()"> 确定添加</a>
          <a  href="javascript:void(0)" class="manage_cancle_butt">添加联系人</a>
        </div>
        </form>
    </div>
</div>
</body>
<script type="text/javascript" src="/Public/admin/js/jquery-3.1.0.js"></script>
<script src="/Public/admin/js/src/laydate.js"></script>
<script type="text/javascript" src="/Public/admin/js/index.js"></script>
<script>
    laydate.render({elem: '#test1', type: 'datetime',min: -14,max:1});
    laydate.render({elem: '#test2', type: 'datetime',min: -14,max:1});


    //年选择器
    laydate.render({
      elem: '#test3',type: 'year',
    });  
  
</script>
<script type="text/javascript"> 
    $('#kuadu').change(function(){

        $("#year").toggle();
        $('#month').toggle();
        $("#week").toggle();
        $('#time').toggle();

    });
    

    //给查询的数字做限制
    $('#range').blur(function(){

        var range = $(this).val();  //alert(range);
        var num = isRealNum(range);
        var $parent = $(this).parent();

        if(!num){
            $('.date_in i').last().find(".msg").remove();
            $('.date_in i').last().append("<span class='msg onError' style='color:red;'>请输入数字</span>");
            $("#begin_search").attr("disabled", true);//代表按钮不可用
        }else{
            $("#begin_search").attr("disabled", false);
        }
         
    });


    //判断是否是数字
    function isRealNum(val){
        // isNaN()函数 把空串 空格 以及NUll 按照0来处理 所以先去除
        
        if(!isNaN(val)){
            return true;
        }else{
            return false;
        }
    }        


    $(function(){   
        $(".table tr td:first-child img").click(function(){
            $(this).attr('src',$(this).attr('src')=='/Public/admin/img/square.png'?'/Public/admin/img/square2.png':'/Public/admin/img/square.png');
        });  

        $("#xun").click(function(){ 
            if($("img[src='/Public/admin/img/square2.png']").length==0){
                alert('请选择查询设备');
                 $(".model,#mask,.manage_model").hide();
            }else{
                 var leng = '';
                $("img[src='/Public/admin/img/square2.png']").each(function(ind, val){
                    leng += ','+$(this).attr('value');
                });
               
                leng = leng.substr(1);
                //alert(leng);
                $('#ids').val(leng);
            }
           
        });  
        
        $(".manage_cancle_butt").click(function(){           
            $(".add-per").show();
        })

    });


    function checkForm(){
        var device_sn =$("#device_sn").val(); //alert(device_sn);
       
        if(device_sn!=''){  //alert(1);
            $('#add_post').submit();
        }else{
            alert('设备编码不能为空');
            return false;
        }
    }
       
$('.search_butt').click(function(){
    $('#history_post').submit();

})



$(".tc_close").click(function () {
    $(".model,#mask,.manage_model").hide();
});


$(".cancle_butt").click(function() {
     $(".model,#mask,.manage_model").hide();
});

function showMask() {
    $("#mask").css("height", $(document).height());
    $("#mask").css("width", $(document).width());
    $("#mask").show();
}
function letDivCenter(divName) {
    var top = ($(window).height() - $(divName).height()) / 2;
    var left = ($(window).width() - $(divName).width()) / 2;
    var scrollTop = $(document).scrollTop();
    var scrollLeft = $(document).scrollLeft();
    $(divName).css({position: 'absolute', 'top': top + scrollTop, left: left + scrollLeft}).show();
}
function showAll(divName) {
    showMask();
    letDivCenter(divName);
}

</script>

</html>