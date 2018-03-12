<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport"
          content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no"/>
    <title>地图地理</title>
    <link rel="stylesheet" type="text/css" href="/Public/admin/css/public.css"/>
    <link rel="stylesheet" type="text/css" href="/Public/admin/css/index.css"/>
   <!--  <style type="text/css">
    body, html,#allmap {width: 100%;height: 100%;overflow: hidden;margin:0;font-family:"微软雅黑";}
    </style> -->


<!-- <style type="text/css">
    html,body{margin:0;padding:0;}
    .iw_poi_title {color:#CC5522;font-size:14px;font-weight:bold;overflow:hidden;padding-right:13px;white-space:nowrap}
    .iw_poi_content {font:12px arial,sans-serif;overflow:visible;padding-top:4px;white-space:-moz-pre-wrap;word-wrap:break-word}
</style> -->
<script type="text/javascript" src="http://api.map.baidu.com/api?key=&v=1.1&services=true"></script> 


</head>
<body>
<div class="header"><img src="/Public/admin/img/logo.png"/> <span>双维科技信息管理平台</span></div>
<div class="content content1 clearfix">
    <div class="con_left">
        <ul>
            <li>
                <a href="<?php echo U('Admin/Equipment/index');?>"> 
                    <img src="/Public/admin/img/device1.png" class="icon1"/> 
                    <img src="/Public/admin/img/device2.png"  class="icon2"/> 
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
                    <img src="/Public/admin/img/date1.png" class="icon1"/> 
                    <img src="/Public/admin/img/date2.png" class="icon2"/>
                    <span>数据展示</span> 
                </a>
            </li>
            <li>
                <a href="<?php echo U('Admin/Equipment/manage');?>"> 
                    <img src="/Public/admin/img/set1.png" class="icon1"/> 
                    <img src="/Public/admin/img/set2.png" class="icon2"/>
                    <span>系统管理</span> 
                </a>
            </li>
        </ul>
        <a href="<?php echo U('Admin/Index/logout');?>"><img src="/Public/admin/img/quit.png" class="quit"/></a>
    </div>


    <div class="con_middle map_middle">        
         <div style="width:100%;min-height:200px;height:100%;max-height:800px;border:#ccc solid 1px;" id="allmap"></div>
        <a href="<?php echo U('Admin/Equipment/map2').'?device_sn='.$data[0]['device_sn'].'&dw='.$dw;?>"><img src="/Public/admin/img/q.png"   class="q"></a>
    </div>
    <input type="hidden" value="<?php echo ($data[0]['lon']); ?>" name="lon" id="lon">
    <input type="hidden"  value="<?php echo ($data[0]['lat']); ?>" name="lat" id="lat">

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
            <li class="history"><label></label> <a href="javascript:void(0)"  onclick="showAll('#model')">历史数据</a></li>
            <li><label>补充信息：</label> <span><?php echo ($data[0]['supply']); ?></span></li>
        </ul>
        <a class="set_sb_btn" href="javascript:void(0)" onclick="showAll('#map_model')"> 设置设备 </a>
        <a class="set_sb_btn" href="javascript:void(0)" onclick="showAll('#warehouse_model')">添加库区</a>
        <a class="btn_search" href="javascipt:void(0)"  id="huhuan"> 
            <span><img src="/Public/admin/img/carry.png"/></span>
            <span>呼唤</span></a>
    </div>

</div>
<!--弹窗-->
<!-- <div class="alert_out">
    <div class="alert_in">
        <div class="alert_top">
            <span>补充信息</span> 
            <img src="/Public/admin/img/delete.png" class="alert_del"/>
        </div>
        <div class="alert_bottom"><p class="">word，excel，pdf，jpg，txt</p> 
            <input type="file" name="supply" id="" value=""  class="file"/> 
            <input type="button" name="" id="" value="上传文件" class="update"/>
            <input type="button" name="" id="" value="取消选择" class="cancel"/>
        </div>
    </div>
</div>
<div id="mask" class="mask"></div>  -->
<div id="mask" class="mask"></div>

<div>

    <div id="warehouse_model" class="manage_model"><img src="/Public/admin/img/tc_close.png" alt="" class="tc_close">
        <form class="form-horizontal" action="<?php echo U('Admin/Warehouse/add');?>" id="add_post_ku" method="post">
        <h2>添加库区</h2>
        <ul>
            <li class="input_dx"><label for="">库区名称:</label> <input type="text"  name="name" id="name" class="required"></li>
            <li class="input_dx"><label for="">楼层总数:</label> <input type="text"  name="floor" id="floor" class="required"></li>
        </ul>
        <div class="manage_sear_cancle">
            <a href="javascript:void(0)" onclick="checkFormKu()" class="manage_search_butt">确定</a>
            <a href="javascript:void(0)" class="manage_cancle_butt">取消</a> 
        </div>
        </form>
    </div>


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
                <input type="text" name="cycle_time" id="cycle_time">
                <select name="stime" id="stime">
                    <option value="60">分钟</option>
                    <option value="1">秒</option>
                    <option value="3600">时</option>
                </select>
            </li>
            <li class="input_bjfz">
                <label for="" id="label">报警阀值设置上限：</label> 

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
                    <!-- <?php $__FOR_START_1610271418__=1;$__FOR_END_1610271418__=$floor;for($i=$__FOR_START_1610271418__;$i < $__FOR_END_1610271418__;$i+=1){ ?><option value="<?php echo ($i); ?>"><?php echo ($i); ?></option><?php } ?> -->
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
<script src="/Public/admin/js/src/laydate.js"></script>
<script type="text/javascript" src="/Public/admin/js/index.js"></script>

<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=A4L3haFP1uI7g23a9ZVwFWBMi59PvCGj"></script>
<script>
    laydate.render({elem: '#test1', type: 'datetime'});
    laydate.render({elem: '#test2', type: 'datetime'});
</script>
<script type="text/javascript">

//呼唤设备
$('#huhuan').click(function(){
    var device_sn = '<?php  echo $data[0]['device_sn'] ?>';  //alert(device_sn);
    $.ajax({
        data:{m:'Led',imei:device_sn},
        type:'post',
        url:"http://ph3.yichiot.com/w.php",
        dataType:'json',
        success:function(data){
            if(data.status==1){
                alert('呼唤成功');
            }else{
                alert('呼唤失败');
            }  
        }
    });
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




function  checkFormKu(){
    $("#add_post_ku").submit();
 }
$('.up_date').click(function () {
    alertClick();
})
</script>
<script type="text/javascript">
$(".tc_close,.up_date,.manage_cancle_butt,.map_cancle_butt,.cancle_butt").click(function () {
    $(".map_model,#mask,.model,.manage_model").hide();
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
$(function(){
    $('.map_search_butt').click(function(){

        if($('#cycle_time').val()==''){
            alert('采集周期不能为空');
        }else{

       $("#update_post").submit();
        }



      /*  var cycle_time = $('#cycle_time').val();
        var stime = $('#stime').val();
        var time = cycle_time*stime;


        var tem_upper_limit = $("input[name='tem_upper_limit']").val();
        var humi_upper_limit = $("input[name='humi_upper_limit']").val();
        var con_upper_limit = $("input[name='con_upper_limit']").val();
        var co_upper_limit = $("input[name='co_upper_limit']").val();


        var tem_buttom_limit = $("input[name='tem_buttom_limit']").val();
        var humi_buttom_limit = $("input[name='humi_buttom_limit']").val();
        var con_buttom_limit = $("input[name='con_buttom_limit']").val();
        var co_buttom_limit = $("input[name='co_buttom_limit']").val();
     //alert(tem_buttom_limit);


        var device_sn = '<?php  echo $data[0]['device_sn'] ?>';  //alert(device_sn);
        $.ajax({
            data:{m:'ConfigDevice',imei:device_sn,prd:time,lhs:con_upper_limit,lls:con_buttom_limit,lht:tem_upper_limit,llt:tem_buttom_limit,lhh:humi_upper_limit,llh:humi_buttom_limit},
            type:'post',
            url:"http://ph3.yichiot.com/w.php",
            dataType:'json',
            success:function(data){
                if(data.status==1){
                    alert('设置成功11');
                }else{
                    alert('设置失败22');
                }  
            }
        });
*/












     });

     var device_sn = $("#device_sn").attr('value');
      $('#ids').val(device_sn);
      $('.device_sn').val(device_sn);

    $('.search_butt').click(function(){
        $('#history_post').submit();
    })  
})
</script>
<script type="text/javascript">

var lon = $('#lon').val();
var lat = $("#lat").val();
var device_sn = $('#device_sn').attr('value'); //alert(device_sn);
var ext = $('#custom').attr('value');

var map = new BMap.Map("allmap");
    map.centerAndZoom(new BMap.Point(116.331398,39.897445),17);
    map.enableScrollWheelZoom(true);
    
    // 用经纬度设置地图中心点
  
    map.clearOverlays(); 
    var new_point = new BMap.Point(lon,lat);
    var marker = new BMap.Marker(new_point);  // 创建标注
    map.addOverlay(marker);              // 将标注添加到地图中
    map.panTo(new_point);      
  

</script>
</body>
</html>