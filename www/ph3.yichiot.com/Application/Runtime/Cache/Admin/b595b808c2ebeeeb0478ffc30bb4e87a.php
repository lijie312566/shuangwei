<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <script src="/Public/statics/js/jquery-2.2.4.min.js"></script>
</head>
<style>
    .class{width:300px;border:1px solid #ccc;height:200px;display: none;}
</style>
<body>
   <div>
        <ul class="ul">
            <?php if(is_array($auth_rule)): foreach($auth_rule as $key=>$vo): ?><li class="li">
                    <?php if($vo['line'][0] != ''): echo ($vo['title']); ?>
                        <div class="class">
                            <ul>
                                <?php if(is_array($vo['line'])): $i = 0; $__LIST__ = $vo['line'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$f): $mod = ($i % 2 );++$i;?><li><a href="/<?php echo ($f['name']); ?>"><?php echo ($f['title']); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                            </ul>
                        </div>
                        <?php else: ?>
                        <a href="/<?php echo ($vo['name']); ?>"><?php echo ($vo['title']); ?></a><?php endif; ?>
                </li><?php endforeach; endif; ?>
        </ul>
        
        <?php if(($_SESSION['user'][front_status] == '2') AND ($_SESSION['user'][identity] == '2') ): ?><form action="<?php echo U('Company/login');?>" id="ufrm" method="post">
                <input type="hidden" name="username" value="<?php echo ($_SESSION['user'][front_username]); ?>">
                <input type="hidden" name="status" value="1">
                <input type="submit" value="返回管理账户">
            </form><?php endif; ?>
        <?php if($_SESSION['user'][user_status] == '3'): ?><form action="<?php echo U('Swuser/login');?>" id="ufrm" method="post">
                <input type="hidden" name="username" value="<?php echo ($_SESSION['user'][user_username]); ?>">
                <input type="hidden" name="status" value="1">
                <input type="submit" value="返回客户账户">
            </form><?php endif; ?>
        <!--<?php if($_SESSION['user'][front_username] != ''): ?>-->
            <!--<form action="<?php echo U('Company/login');?>" id="ufrm" method="post">-->
                <!--<input type="hidden" name="username" value="<?php echo ($_SESSION['user'][front_username]); ?>">-->
                <!--<input type="hidden" name="status" value="1">-->
                <!--<input type="submit" value="返回账户">-->
            <!--</form>-->
        <!--<?php endif; ?>-->
    </div>
    <div class="div">

    </div> 
    <script>
       $(function(){
           $('.li').click(function(){
               $(this).find('.class').fadeIn("slow");

           })
       })
    </script>
</body>
</html>