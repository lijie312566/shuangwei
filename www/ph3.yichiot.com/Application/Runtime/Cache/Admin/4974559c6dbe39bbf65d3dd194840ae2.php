<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport"
          content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no"/>
    <title>数据查询2</title>
    <link rel="stylesheet" type="text/css" href="/Public/admin/css/public.css"/>
    <link rel="stylesheet" type="text/css" href="/Public/admin/css/index.css"/>
</head>
<body>
<div class="header"><img src="/Public/admin/img/logo.png"/> <span>双维科技信息管理平台</span></div>
<div class="content content3 clearfix">
    <div class="con_left">
        <ul>

            <li>

                <a href="index.html">

                    <img src="/Public/admin/img/device1.png" class="icon1"/>
                    <img src="/Public/admin/img/device2.png" class="icon2"/>

                    <span>设备列表</span>

                </a>

            </li>

            <li>

                <a href="map.html">

                    <img src="/Public/admin/img/position1.png" class="icon1"/>
                    <img src="/Public/admin/img/position2.png" class="icon2"/>

                    <span>地图地理</span>

                </a>

            </li>

            <li>

                <a href="date-search2.html">

                    <img src="/Public/admin/img/date1.png"  class="icon1"/>
                    <img src="/Public/admin/img/date2.png" class="icon2"/>

                    <span>数据展示</span>

                </a>

            </li>

            <li>

                <a href="manage.html">

                    <img src="/Public/admin/img/set1.png"  class="icon1"/>
                    <img src="/Public/admin/img/set2.png"  class="icon2"/>

                    <span>系统管理</span>

                </a>

            </li>

        </ul>
        <a href="<?php echo U('Admin/Index/logout');?>"><img src="/Public/admin/img/quit.png" class="quit"/></a>

</div>
    <div class="con_middle date_search_t">
        <div class="titles">
            <ul class="clearfix">
                <!-- <li>							<a href="#" class="actives">重新查询</a>						</li> -->
                <li><a class="actives" href="#">另存为Excel</a></li>
                <li><a class="actives" href="#">切换至曲线</a></li>
            </ul>
        </div>
        <div style="overflow: hidden" class="one-wrap">
            <div class="one" style="overflow-x: scroll">
                <table border="none" cellspacing="" cellpadding="" class="table">
                    <tr>
                        <th>设备编码</th>
                        <th>设备1</th>
                        <th>设备2</th>
                        <th>设备3</th>
                        <th>设备4</th>
                    </tr>
                    
                </table>
                <div class="page">
                    <ul class="clearfix">
                        <li><</li>
                        <li>1</li>
                        <li>2</li>
                        <li>3</li>
                        <li>4</li>
                        <li class="actives">5</li>
                        <li>6</li>
                        <li>7</li>
                        <li>...</li>
                        <li>10</li>
                        <li>11</li>
                        <li>></li>
                        <li>共十一页</li>
                    </ul>
                </div>
            </div>

            <!-- <div class="one">
                        <table border="none" cellspacing="" cellpadding="" class="table">

                            <tr>
                                <th>设备编码</th>
                                <?php if(is_array($arrayshift)): foreach($arrayshift as $key=>$vo): ?><th><?php echo ($key); ?></th><?php endforeach; endif; ?>
                            </tr>
                            <tr>
                                <th>自定义信息</th>
                                <?php if(is_array($data)): foreach($data as $key=>$vo): ?><th><?php echo ($vo[$key]); ?></th><?php endforeach; endif; ?>
                            </tr>

                            <?php if(is_array($data)): foreach($data as $key=>$vo): ?><tr>
                                    <td><?php echo ($key); ?></td>
                                    <?php if(is_array($vo)): $i = 0; $__LIST__ = $vo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$f): $mod = ($i % 2 );++$i;?><td><?php echo ($vo[$key]['concentration']); ?> >> <?php echo ($vo[$key]['temperature']); ?> >> <?php echo ($vo[$key]['humidity']); ?></td><?php endforeach; endif; else: echo "" ;endif; ?>


                                </tr><?php endforeach; endif; ?>




                        </table>
                        <div class="page">
                            <ul class="clearfix">
                                <li><?php echo ($page); ?></li>

                            </ul>
                        </div>
                    </div> -->
            <div class="one two"><img src="/Public/admin/img/line_chart.png"/></div>
        </div>
    </div>
    <script type="text/javascript" src="/Public/admin/js/jquery-3.1.0.js" ></script>

    <script type="text/javascript" src="/Public/admin/js/index.js" ></script>
</body>
</html>