<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>

<html>

<head>

    <meta charset="utf-8" />

    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />

    <title>地图地理</title>

    <link rel="stylesheet" type="text/css" href="/Public/admin/css/public.css"/>

    <link rel="stylesheet" type="text/css" href="/Public/admin/css/index.css"/>


</head>

<body>

<div class="header">

    <img src="/Public/admin/img/logo.png"/>

    <span>双维科技信息管理平台</span>

</div>

<div class="content content1 clearfix">

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

        <a href="#"><img src="/Public/admin/img/quit.png" class="quit"/></a>

    </div>

    <div class="con_middle map_middle" id="up">

        <div class="up-center">
            <form action="<?php echo U('Admin/Equipment/upsoft');?>" id="add_post_ku" method="post">
                <div class="d-row">
                    <label>远程升级Url</label>
                    <input type="text" name="url">
                </div>
                <div class="d-row">
                    <label>远程升级版本号</label>
                    <input type="text" name="ban_number" >
                </div>
                <div class="d-row" style="text-align: center">
                    <input type="submit" value="立即升级" class="set_sb_btn">
                </div>
            </form>
        </div>

    </div>

</div>

<script type="text/javascript" src="js/jquery-3.1.0.js" ></script>

<script type="text/javascript" src="js/index.js" ></script>
<script type="text/javascript">

    $('.up_date').click(function () {

        alertClick();

    })

</script>

<script type="text/javascript">

    $(".tc_close,.up_date").click(function(){

        $(".map_model,#mask").hide();

    })

    //兼容火狐、IE8  

    function showMask(){

        $("#mask").css("height",$(document).height());

        $("#mask").css("width",$(document).width());

        $("#mask").show();

    }

    //让指定的DIV始终显示在屏幕正中间  

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

</script>

</body>

</html>