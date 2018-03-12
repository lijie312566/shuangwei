<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
        <title>数据查询2</title>
        <link rel="stylesheet" type="text/css" href="/Public/admin/css/public.css"/>
        <link rel="stylesheet" type="text/css" href="/Public/admin/css/index.css"/>
        
    </head>
    <body>
        <div class="header">
            <img src="/Public/admin/img/logo.png"/>
            <span>双维科技信息管理平台</span>
        </div>
        <div class="content content3 clearfix">
            <div class="con_left">
                <ul>
                    <li>
                        <a href="<?php echo U('Equipment/index');;?>">
                            <img src="/Public/admin/img/device2.png"/>
                            <span>设备列表</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo U('Admin/Equipment/map');?>">
                            <img src="/Public/admin/img/position1.png"/>
                            <span>地图地理</span>
                        </a>
                    </li>
                    <li class="actives">
                        <a href="<?php echo U('Admin/Cycle/index');?>">
                            <img src="/Public/admin/img/date1.png"/>
                            <span>数据展示</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo U('Admin/Equipment/manage');?>">
                            <img src="/Public/admin/img/set1.png"/>
                            <span>系统管理</span>
                        </a>
                    </li>
                </ul>
                <a href="<?php echo U('Admin/Index/logout');?>"><img src="/Public/admin/img/quit.png" class="quit"/></a>
            </div>
            <div class="con_middle date_search_t">
                <div class="titles">
                    <ul class="clearfix">
                        <!-- <li>
                            <a href="#" class="actives">重新查询</a>
                        </li> -->
                        <li>
                            <a class="actives" href="<?php echo U('Admin/Cycle/execl/').'?style='.$style;?>" id="execl">另存为Excel</a>
                        </li>
                        <li>
                            <a class="actives" href="javascript:void(0)" id="huan" >切换至曲线</a>
                        </li>
                    </ul>
                </div>

                
                <div style="overflow: hidden" class="one-wrap">
                    <div class="one" style="overflow-x: scroll">
                        <table border="none" cellspacing="" cellpadding="" class="table">

                            <tr>
                                <th>设备编码</th>
                                <?php if(is_array($arrayshift)): foreach($arrayshift as $key=>$vo): ?><th><?php echo ($key); ?></th><?php endforeach; endif; ?>
                                 <?php if($machine): if(is_array($machine)): foreach($machine as $key=>$vo): ?><th><?php echo ($vo['device_sn']); ?></th><?php endforeach; endif; endif; ?>
                            </tr>
                            <tr>
                                <th>自定义信息</th>
                                <?php if(is_array($data[$key])): foreach($data[$key] as $key=>$vo): ?><th><?php echo ($vo['custom']); ?></th><?php endforeach; endif; ?>
                                 <?php if($machine): if(is_array($machine)): foreach($machine as $key=>$vo): ?><th><?php echo ($vo['custom']); ?></th><?php endforeach; endif; endif; ?>
                            </tr>

                            <?php if(is_array($data)): foreach($data as $key=>$vo): ?><tr>
                                    <td class="date" value="<?php echo ($key); ?>"><?php echo ($key); ?></td>


                                        <?php if($style == temperature): if(is_array($vo)): $i = 0; $__LIST__ = $vo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$f): $mod = ($i % 2 );++$i;?><td ><?php echo ($vo[$key]['temperature']); ?>℃ </td><?php endforeach; endif; else: echo "" ;endif; ?>
                                        <?php elseif($style == humidity): ?>
                                                <?php if(is_array($vo)): $i = 0; $__LIST__ = $vo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$f): $mod = ($i % 2 );++$i;?><td ><?php echo ($vo[$key]['humidity']); ?>%RH </td><?php endforeach; endif; else: echo "" ;endif; ?>

                                        <?php elseif($style == concentration): ?> 
                                                <?php if(is_array($vo)): $i = 0; $__LIST__ = $vo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$f): $mod = ($i % 2 );++$i;?><td ><?php echo ($vo[$key]['concentration']); ?>ppm </td><?php endforeach; endif; else: echo "" ;endif; ?>

                                        <?php else: ?>
                                              <?php if(is_array($vo)): $i = 0; $__LIST__ = $vo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$f): $mod = ($i % 2 );++$i;?><td ><?php echo ($vo[$key]['co']); ?>ppm </td><?php endforeach; endif; else: echo "" ;endif; endif; ?>

                                </tr><?php endforeach; endif; ?>

                            <input type="hidden" name="info" value="<?php echo ($data); ?>">
                            <input type="hidden" name="style" value="<?php echo ($style); ?>" id="style">
                        </table>
                        <!-- <div class="page">
                            <ul class="clearfix">
                                <li><?php echo ($page); ?></li>
                            </ul>
                        </div>  -->
                    </div>
                    <div class="one two">
                         <div id="main" style="width: 1600px;height:600px;" ></div>  
                        <!--  <button class="huan" style="background-color:green;width:80px">温度</button>
                         <button id="humi" style="background-color:green;width:80px">湿度</button>
                         <button id="con" style="background-color:green;width:80px">ph3浓度</button> -->
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="/Public/admin/js/jquery-3.1.0.js" ></script>
        <script type="text/javascript" src="/Public/admin/js/index.js" ></script>
        <script src="https://code.highcharts.com/highcharts.js"></script>
    </body>
</html>
<script>
$(document).ready(function() {

   /*日期*/
   /*$('.date').val();*/
   var date='';
   $('.date').each(function(){
      date += ','+$(this).attr('value');

   })
     date = date.substr(1);
     date = date.split(',');

  //console.log(date);

var style = $('#style').val(); 
    //温度------湿度-------气体浓度
    var i=0;
    $('#huan').click(function(){
         if((i=i%2)==0){
            $.ajax({
                url:"<?php echo U('Admin/Cycle/save');;?>",  
                type:'get',  
                data:{style:style},
                dataType:'json',  
                success:function(jsons){  
                  var title = {
                    text: '数据曲线展示'   
                 };
                 
                var xAxis = {
                    categories: date
                 };

                var yAxis = {
                    title: {                    
                       text:  "<?php if($style=='temperature'){ echo '温度Temperature (\xB0C)';}elseif($style=='humidity'){ echo '湿度Temperature (\%RH)'; }elseif($style=='concentration'){ echo 'ph3气体浓度Concentration(ppm)'; }else{ echo 'co气体浓度Co(ppm)';} ?>"
                    },
                    plotLines: [{
                       value: 0,
                       width: 1,
                       color: '#808080'
                    }]
                 
                 };   

                var tooltip = {
                    valueSuffix: "<?php if($style=='temperature'){ echo '\xB0C';}elseif($style=='humidity'){ echo '\%RH'; }elseif($style=='concentration'){ echo 'ppm'; }else{ echo 'ppm';} ?>"
                }

                var legend = {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'middle',
                    borderWidth: 0
                };

                //  y轴的温度
                var series = JSON.parse(jsons.temp);

                var json = {};

                   json.title = title;
                   json.xAxis = xAxis;
                   json.yAxis = yAxis;
                   json.tooltip = tooltip;
                   json.legend = legend;
                   json.series = series;

                   $('#main').highcharts(json);
                }

            })   

        }else{
            $.ajax({
                type:"post",
                url:'<?php echo U('Admin/Cycle/index');?>'
            })
        }

    });



    
    

})
   




</script>