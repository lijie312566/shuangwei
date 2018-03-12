<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport"
          content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no"/>
    <title>数据查询2</title>
    <link rel="stylesheet" type="text/css" href="css/public.css"/>
    <link rel="stylesheet" type="text/css" href="css/index.css"/>
</head>
<body>
<div class="header"><img src="img/logo.png"/> <span>双维科技信息管理平台</span></div>
<div class="content content3 clearfix">
    <div class="con_left">
        <ul>

            <li>

                <a href="index.html">

                    <img src="img/device1.png" class="icon1"/>
                    <img src="img/device2.png" class="icon2"/>

                    <span>设备列表</span>

                </a>

            </li>

            <li>

                <a href="map.html">

                    <img src="img/position1.png" class="icon1"/>
                    <img src="img/position2.png" class="icon2"/>

                    <span>地图地理</span>

                </a>

            </li>

            <li>

                <a href="date-search2.html">

                    <img src="img/date1.png"  class="icon1"/>
                    <img src="img/date2.png" class="icon2"/>

                    <span>数据展示</span>

                </a>

            </li>

            <li>

                <a href="manage.html">

                    <img src="img/set1.png"  class="icon1"/>
                    <img src="img/set2.png"  class="icon2"/>

                    <span>系统管理</span>

                </a>

            </li>

        </ul>
        <a href="#"><img src="img/quit.png" class="quit"/></a>

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
                    <tr>
                        <th>自定义信息</th>
                        <th>A库-二层-某某某</th>
                        <th>A库-二层-某某某</th>
                        <th>A库-二层-某某某</th>
                        <th>A库-二层-某某某</th>
                    </tr>
                    <tr>
                        <td>2017.11.29&nbsp;11:12</td>
                        <td>26℃</td>
                        <td>26℃</td>
                        <td>26℃<!-- <img src="img/up.png"/> --></td>
                        <td>26℃</td>
                    </tr>
                    <tr>
                        <td>2017.11.29&nbsp;11:12</td>
                        <td>26℃</td>
                        <td>26℃</td>
                        <td>26℃<!-- <img src="img/up.png"/> --></td>
                        <td>26℃</td>
                    </tr>
                    <tr>
                        <td>2017.11.29&nbsp;11:12</td>
                        <td>26℃</td>
                        <td>26℃</td>
                        <td>26℃<!-- <img src="img/up.png"/> --></td>
                        <td>26℃</td>
                    </tr>
                    <tr>
                        <td>2017.11.29&nbsp;11:12</td>
                        <td>26℃</td>
                        <td>26℃</td>
                        <td>26℃<!-- <img src="img/up.png"/> --></td>
                        <td>26℃</td>
                    </tr>
                    <tr>
                        <td>2017.11.29&nbsp;11:12</td>
                        <td>26℃</td>
                        <td>26℃</td>
                        <td>26℃<!-- <img src="img/up.png"/> --></td>
                        <td>26℃</td>
                    </tr>
                    <tr>
                        <td>2017.11.29&nbsp;11:12</td>
                        <td>26℃</td>
                        <td>26℃</td>
                        <td>26℃<!-- <img src="img/up.png"/> --></td>
                        <td>26℃</td>
                    </tr>
                    <tr>
                        <td>2017.11.29&nbsp;11:12</td>
                        <td>26℃</td>
                        <td>26℃</td>
                        <td>26℃<!-- <img src="img/up.png"/> --></td>
                        <td>26℃</td>
                    </tr>
                    <tr>
                        <td>2017.11.29&nbsp;11:12</td>
                        <td>26℃</td>
                        <td>26℃</td>
                        <td>26℃<!-- <img src="img/up.png"/> --></td>
                        <td>26℃</td>
                    </tr>
                    <tr>
                        <td>2017.11.29&nbsp;11:12</td>
                        <td>26℃</td>
                        <td>26℃</td>
                        <td>26℃<!-- <img src="img/up.png"/> --></td>
                        <td>26℃</td>
                    </tr>
                    <tr>
                        <td>2017.11.29&nbsp;11:12</td>
                        <td>26℃</td>
                        <td>26℃</td>
                        <td>26℃<!-- <img src="img/up.png"/> --></td>
                        <td>26℃</td>
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
            <div class="one two"><img src="img/line_chart.png"/></div>
        </div>
    </div>
    <script type="text/javascript" src="js/jquery-3.1.0.js" ></script>

    <script type="text/javascript" src="js/index.js" ></script>
</body>
</html>