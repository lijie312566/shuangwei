<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport"
          content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no"/>
    <title>地图地理2</title>
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
    <div class="con_middle map_middle2 clearfix">
		<a href="<?php echo U('Admin/Equipment/map').'?device_sn='.$data[0]['device_sn'];?>"> <img src="/Public/admin/img/dt.png" class="img_show"/></a>

        <div class="map_r map_m">  
        <?php $__FOR_START_207040897__=0;$__FOR_END_207040897__=count($list);for($i=$__FOR_START_207040897__;$i < $__FOR_END_207040897__;$i+=1){ ?><!-- 这是一行摞起来 楼层-->
            <div class="map_l_t">
                    <div class="map_l_one">
                   <!--  <span><?php echo ($list[$i+1]['num']); ?></span> -->
                    <?php $__FOR_START_527584091__=0;$__FOR_END_527584091__=$list[$i+1]['num'];for($j=$__FOR_START_527584091__;$j < $__FOR_END_527584091__;$j+=1){ foreach($list[$i+1]['device_sn'] as $kity=>$vval){ ?>
                        <?php  if($list[$i+1]['device_sn'][$j]== $data[0]['device_sn'] ){ ?>
                        <img src="/Public/admin/img/position_red.png" style="left: <?php echo (100/($list[$i+1]['num']+3))*$j; ?>%; top: 49px;" data-toggle="tooltip" title="<?php echo $list[$i+1]['device_sn'][$j]; ?>" device_sn="<?php echo ($list[$i+1]['device_sn'][$j]); ?>"> 
                        <?php  }else{ ?>
                         <img src="/Public/admin/img/position_blue.png" style="left: <?php echo (100/($list[$i+1]['num']+3))*$j; ?>%; top: 49px;" data-toggle="tooltip" title="<?php echo $list[$i+1]['device_sn'][$j]; ?>" device_sn="<?php echo ($list[$i+1]['device_sn'][$j]); ?>"> 
                        <?php  } ?>
                    <?php  } } ?>   
                        
                    </div>   
            </div>
            <p style="left:0;"><span class="ji" house_id="<?php echo ($data[0]['warehouse_id']); ?>" order="<?php echo ($data[0]['warehouse']); ?>"><?php echo ($data[0]['warehouse']); ?></span></p><?php } ?> 
        </div> 
    </div>
   <!-- <div class="con_right map_right map_right_infor">
        <ul>
            <li><label for="">设备编码：</label> <span id="device_sn" value="<?php echo ($data[0]['device_sn']); ?>"><?php echo ($data[0]['device_sn']); ?></span></li>
            <li><label for="">自定义信息：</label> <span><?php echo ($data[0]['custom']); ?></span></li>
            <li><label for="">实时数据：</label> <span><?php echo ($data[0]['temperature']); ?> ℃&nbsp;&nbsp;<?php echo ($data[0]['humidity']); ?>%RH</span></li>
            <li><label for="">剩余电量：</label> <span><img src="/Public/admin/img/battery.png"/></span> <span><?php echo ($data[0]['electricity']); ?>%</span></li>
            <li><label for="">采集周期设置：</label> <span><?php echo ($data[0]['cycle_time']); ?></span></li>
            <li><label for="">报警阀值设置：</label> <span> <?php echo ($data[0]['buttom_limit']); ?>-<?php echo ($data[0]['upper_limit']); ?>℃</span></li>
            <li><label for="">位置：</label> <span><?php echo ($data[0]['warehouse']); ?> &nbsp;&nbsp;<?php echo ($data[0]['floor']); ?>层</span></li>   
            <li class="history"><label></label> <a href="javascript:void(0)"  onclick="showAll('#model')"  device_sn="<?php echo ($data[0]['device_sn']); ?>" class="set_search_btn">历史数据</a></li>
            <li><label>补充信息：</label> <span><?php echo ($data[0]['supply']); ?></span></li>
        </ul>
        <a class="set_sb_btn" href="javascript:void(0)" onclick="showAll('#map_model')" device_sn="<?php echo ($data[0]['device_sn']); ?>"> 设置设备 </a>
        <a class="btn_search" href="javascript:void(0)"> 
            <span><img src="/Public/admin/img/carry.png"/></span>
            <span>呼唤</span></a>
    </div>
 -->
    <div class="con_right map_right map_right_infor">
        <ul>
            <li><label for="">设备编码：</label> <span id="device_sn" value="<?php echo ($data[0]['device_sn']); ?>"><?php echo ($data[0]['device_sn']); ?></span></li>
            <li><label for="">自定义信息：</label> <span id="custom" value="<?php echo ($data[0]['custom']); ?>"><?php echo ($data[0]['custom']); ?></span></li>
            <li>
                <label for="">实时数据：</label> 
                    <?php if($style == temperature): ?><span><?php echo ($data[0]['temperature']); ?> ℃</span>
                    <?php elseif($style == humidity): ?>
                         <span><?php echo ($data[0]['humidity']); ?>%RH</span>
                    <?php elseif($style == concentration): ?> 
                         <span><?php echo ($data[0]['concentration']); ?> ppm</span>
                    <?php else: ?>
                         <span><?php echo ($data[0]['co']); ?> ppm</span><?php endif; ?>
            </li>
            <li><label for="">剩余电量：</label><span><?php echo ($data[0]['electricity']); ?>mV</span></li>
            <li><label for="">采集周期设置：</label> <span><?php echo ($data[0]['cycle_time']); ?></span></li>
            <li>
                <label for="">报警阀值设置：</label> 
                <?php if($style == temperature): ?><span> <?php echo ($data[0]['tem_buttom_limit']); ?>-<?php echo ($data[0]['tem_upper_limit']); ?>℃</span>
                <?php elseif($style == humidity): ?>
                         <span> <?php echo ($data[0]['humi_buttom_limit']); ?>-<?php echo ($data[0]['humi_upper_limit']); ?>%RH</span>
                <?php elseif($style == concentration): ?> 
                         <span> <?php echo ($data[0]['con_buttom_limit']); ?>-<?php echo ($data[0]['con_upper_limit']); ?> ppm</span>
                <?php else: ?>
                         <span> <?php echo ($data[0]['co_buttom_limit']); ?>-<?php echo ($data[0]['co_upper_limit']); ?> ppm</span><?php endif; ?>
            </li>
            <li><label for="">位置：</label> <span> <?php echo ($data[0]['warehouse']); ?> &nbsp;&nbsp;<?php echo ($data[0]['floor_id']); ?> 层</span></li>
           <!--  <li><label for="">库区编辑：</label> <span><?php echo ($data[0]['warehouse_limit']); ?>库</span></li>
            <li><label for="">楼层编辑：</label> <span><?php echo ($data[0]['floor_limit']); ?>层</span></li> -->
            <li class="history"><label></label> <a href="javascript:void(0)"  onclick="showAll('#model')">历史数据</a></li>
            <li><label>补充信息：</label> <span><?php echo ($data[0]['supply']); ?></span></li>
        </ul>
        <a class="set_sb_btn" href="javascript:void(0)" onclick="showAll('#map_model')"> 设置设备 </a>
      <!--   <a class="set_sb_btn" href="javascript:void(0)" onclick="showAll('#warehouse_model')">添加库区</a> -->
        <a class="btn_search" href="javascript:void(0)"> 
            <span><img src="/Public/admin/img/carry.png"/></span>
            <span>呼唤</span></a>
    </div>

<!--弹窗-->
<!-- <div class="alert_out">
	<div class="alert_in">
		<div class="alert_top">
            <span>补充信息</span>
            <img src="/Public/admin/img/delete.png" class="alert_del"/>
        </div>
    	<div class="alert_bottom">
            <p class="">word，excel，pdf，jpg，txt</p>
            <input type="file" name="" id="" value="" class="file"/> 
            <input type="button" name="" id="" value="上传文件" class="update"/> 
            <input type="button" name="" id="" value="取消选择" class="cancel"/>
        </div>
	</div>
</div>
 -->
<div id="mask" class="mask"></div>
<div>
    <form action="<?php echo U('Admin/Cycle/index');?>" method="POST" id="history_post" >
    <div id="model" class="model"><img src="/Public/admin/img/tc_close.png" alt="" class="tc_close">
         <input type="hidden" name="ids" value=" " id="ids">
          <input type="hidden" name="dw" value="<?php echo ($dw); ?>">
        <h2>历史数据</h2>
        <ul>
              <li class="input_dx">
                    <label for="">起止时间：</label>
                    <b>from</b><span><input type="text" name="starting_point" id="test1"><img src="/Public/admin/img/watch.png"></span>
                    <b>to</b><span><input type="text" name="end" id="test2"><img src="/Public/admin/img/watch.png"></span>
                </li>
                <li class="jg_dx">
                    <label for="">间隔：</label>
                    <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>
                    <input type="text" name="interval">
                    <b>&nbsp;&nbsp;&nbsp;&nbsp;</b>
                    <select name="time">
                      <!--   <option value="3">秒</option> -->
                        <option value="2">分钟</option>
                        <option value="1">小时</option>
                    </select>
                </li>
        </ul>
        <div class="sear_cancle">
            <a href="javascript:void(0)" class="search_butt">查询</a> <a href="javascript:void(0)" class="cancle_butt">取消</a>
        </div>
    </div>
    </form>
</div>

<div>
    <div id="map_model" class="map_model"><img src="/Public/admin/img/tc_close.png" alt="" class="tc_close">
        <form action="<?php echo U('Admin/Equipment/update');?>" method="post" id="update_post" enctype="multipart/form-data" >
            <input type="hidden" name="device_sn" value="" class="device_sn">
        <ul>
            <li class="input_dx">
                <label for="">自定义信息：</label> 
                <input type="text" placeholder="输入不大于15个字" name="custom">
            </li>
            <li class="input_cjzq">
                <label for="">采集周期设置：</label>
                <input type="text" name="cycle_time">
                <select name="stime" id="">
                    <option value="60">分钟</option>
                    <option value="1">秒</option>
                    <option value="3600">时</option>
                </select>
            </li>
            <li class="input_bjfz">
                <label for="">报警阀值设置上限：</label> 

                    <?php if($style == temperature): ?><input type="text" name="tem_upper_limit">    <span>℃</span>
                    <?php elseif($style == humidity): ?>
                          <input type="text" name="humi_upper_limit">   <span>%RH</span>
                    <?php elseif($style == concentration): ?> 
                          <input type="text" name="con_upper_limit">  <span>ppm</span>
                    <?php else: ?>
                          <input type="text" name="co_upper_limit">   <span>ppm</span><?php endif; ?>

            </li>

            <li class="input_bjfz">

                <label for="">报警阀值设置下限：</label> 
                
                <?php if($style == temperature): ?><input type="text" name="tem_buttom_limit">    <span>℃</span>
                    <?php elseif($style == humidity): ?>
                          <input type="text" name="humi_buttom_limit">   <span> %RH</span>
                    <?php elseif($style == concentration): ?> 
                          <input type="text" name="con_buttom_limit">  <span> ppm</span>
                    <?php else: ?>
                          <input type="text" name="co_buttom_limit">   <span> ppm</span><?php endif; ?>

            </li>
            <li class="input_wzaddr"><label for="">位置：库</label> 
                <select name="warehouse_id" id="warehouse_id">
                        <option>--请选择--</option>
                    <?php if(is_array($warehouse)): foreach($warehouse as $key=>$vo): ?><option value="<?php echo ($vo['id']); ?>"><?php echo ($vo['name']); ?></option><?php endforeach; endif; ?>
                </select> 
                <select name="floor_id" >
                    <!-- <option value=""></option> -->
                    <!-- <?php $__FOR_START_1574592234__=1;$__FOR_END_1574592234__=$floor;for($i=$__FOR_START_1574592234__;$i < $__FOR_END_1574592234__;$i+=1){ ?><option value="<?php echo ($i); ?>"><?php echo ($i); ?></option><?php } ?> -->
                </select>层 
            </li>
            <!-- <li class="input_lcedit clearfix">
                <label>楼层编辑：</label> 
                <i class="clearfix"> 
                    <span class="down">-</span>
                        <input class="val" type="text" name="floor_limit" id="floor_limit" value="1"> 
                    <span class="up">+</span> 
                </i>
            </li>
            <li class="input_kqedit clearfix">
                <label>库区编辑：</label>
                <i class="clearfix"> 
                    <span class="down">-</span>
                    <input class="val" type="text" name="warehouse_limit" id="warehouse_limit" value="1"> 
                    <span class="up">+</span> 
                </i>
            </li> -->
            <li class="bc_infor"><label>补充信息：</label>
               
                <div>
                    <div class="same_right"> 
                        <input type="file" name="supply" id="" value="" placeholder="Arno管理的设备" class="btn">
                    </div>
                </div> 

                <!--  <input type="file" name="supply" id="" value=""  class="file"/>  -->
            </li>
        </ul>
        <div class="manage_sear_cancle">
            <a href="javascript:void(0)" class="map_search_butt">保存</a> 
            <a href="javascript:void(0)" class="map_cancle_butt">取消</a>
        </div>
    </form>
    </div>
</div>
<script type="text/javascript" src="/Public/admin/js/jquery-3.1.0.js"></script>
<script type="text/javascript" src="/Public/admin/js/H-ui.js"></script>
<script src="/Public/admin/js/src/laydate.js"></script>
<script type="text/javascript" src="/Public/admin/js/index.js"></script>
<script>
    laydate.render({elem: '#test1', type: 'datetime'});
    laydate.render({elem: '#test2', type: 'datetime'});
</script>
<script type="text/javascript">

    $(function () { 
        //库区即点及改
        $('.ji').click(function(){
            var  that = $(this);
            var  house_id = that.attr('house_id');
            var father = $(this).parent();
            var order = that.attr('order');
            father.html("<input   type='text'   value='"+order+"' />");
       
            father.children().blur(function(){
                var order = $(this).val();
                $.ajax({
                    data:{house_id:house_id,order:order},
                    type:'get',
                    url:"<?php echo U('Admin/Equipment/uphouse_name');?>",
                    dataType:'json',
                    success:function(data){
                        if(data==11){
                            father.html(order);
                            //alert('修改成功');
                        }else{
                            alert('修改失败');
                        }
                    }
                });
            });       
        });



        $("[data-toggle='tooltip']").tooltip();  

        //鼠标滑过事件
        $("[data-toggle='tooltip']").mouseover(function(){
            $(this).siblings().attr('src','/Public/admin/img/position_blue.png');
            $(this).parent().parent().siblings().children().children().attr('src','/Public/admin/img/position_blue.png');
            $(this).attr('src', '/Public/admin/img/position_red.png'); 

            var device_sn = $(this).attr('device_sn');
            //alert(device_sn);

            $.ajax({
                data:{device_sn:device_sn},
                type:'get',
                url:"<?php echo U('Admin/Equipment/information');?>",
                dataType:'json',
                success:function(data){
                   //console.log(data);
                   var str = '';
                   str +='<ul>';
                   str +='<li><label for="">设备编码：</label> <span id="device_sn" class="device_sn" value="'+data.device_sn+'">'+data.device_sn+'</span></li><li><label for="">自定义信息：</label><span>'+data.custom+'</span></li><li><label for="">实时数据：</label> <?php if($style == temperature): ?><span>'+data.temperature +'℃</span><?php elseif($style == humidity): ?><span>'+data.humidity+'%RH</span><?php elseif($style == concentration): ?><span>'+data.concentration+'ppm</span><?php else: ?><span>'+data.co+'ppm</span><?php endif; ?></li><li><label for="">剩余电量：</label><span>'+data.electricity+'mV</span></li><li><label for="">采集周期设置：</label> <span>'+data.cycle_time+'</span></li><li><label for="">报警阀值设置：</label><?php if($style == temperature): ?><span>'+data.tem_buttom_limit+'-'+data.tem_upper_limit+'℃</span><?php elseif($style == humidity): ?><span>'+data.humi_buttom_limit+'-'+data.humi_upper_limit+'%RH</span><?php elseif($style == concentration): ?> <span>'+data.con_buttom_limit+'-'+data.con_upper_limit+'ppm</span><?php else: ?><span>'+data.co_buttom_limit+'-'+data.co_upper_limit+'ppm</span><?php endif; ?></li><li><label for="">位置：</label><span>'+data.warehouse+'&nbsp;&nbsp;'+data.floor_id+'层</span></li><li class="history"><label></label> <a href="javascript:void(0)"  class="set_search_btn"   onclick="showAll(`#model`)" device_sn="'+data.device_sn+'" >历史数据</a></li><li><label>补充信息：</label><span>'+data.supply+'</span></li>';
                   str += '</ul>';
                   str +='<a class="set_sb_btn" href="javascript:void(0)" onclick="showAll(`#map_model`)" device_sn="'+data.device_sn+'"> 设置设备 </a><a class="btn_search" href="javascript:void(0)"><span><img src="/Public/admin/img/carry.png"/></span><span>呼唤</span></a>';

                    
                    $('.map_right_infor').html(str);  
                }
            });
        });
     

        //获取设备编码赋值到相应的位置 ----
        $("body").delegate(".set_sb_btn","click",function(){
            var get_device_sn = $(this).attr('device_sn'); //alert(get_device_sn);
            $('#come_here').val(get_device_sn);
        }); 


         //历史搜索获取设备编码
        $("body").delegate(".set_search_btn","click",function(){
              var device_sn = $(this).attr('device_sn');
            $('#ids').val(device_sn);
        });


         $('.map_search_butt').click(function(){
            $("#update_post").submit();
         })

         
        $('.search_butt').click(function(){
            $('#history_post').submit();
        });  



     $("#warehouse_id").change(function(){
        var warehouse_id = $(this).val(); 
        var that = $(this);
        $.ajax({
            data:{warehouse_id:warehouse_id},
            type:'get',
            url:"<?php echo U('Admin/Equipment/getfloor');?>",
            dataType:'json',
            success:function(data){
               var num = JSON.parse(data); //alert(num);
                var str='';
                   str +='<select name="floor_id" id="">';
                   str+='<option>--请选择--</option>';
                   for(var i=0;i<num;i++){
                       str +='<option value="'+(i+1)+'">'+(i+1)+'</option>';
                   }
                   str +='</select>';
                   that.nextAll().remove();
                   that.after(str);
            }
        })
    });




    $('.up_date').click(function () {
        alertClick();
    });



    $(".tc_close,.up_date,.cancle_butt,.map_cancle_butt").click(function () {
        $(".map_model,#mask,.model").hide();
    });


}); 



$(function(){
     $('.map_search_butt').click(function(){
        $("#update_post").submit();
     })

     var device_sn = $("#device_sn").attr('value');
      $('#ids').val(device_sn);
      $('.device_sn').val(device_sn);

    $('.search_butt').click(function(){
        $('#history_post').submit();
    })  
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




/*$(".table tr td:first-child img").click(function(){
    $(this).attr('src',$(this).attr('src')=='/Public/admin/img/square.png'?'/Public/admin/img/square2.png':'/Public/admin/img/square.png');
});  */


</script>
</body>
</html>