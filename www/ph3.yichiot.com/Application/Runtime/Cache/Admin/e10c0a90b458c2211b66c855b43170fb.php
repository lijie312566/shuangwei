<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>

</head>
<style>
    li{margin:0 10px auto;}
</style>
<body>
<div class="div">
    <?php if(is_array($data)): foreach($data as $key=>$vo): ?><ul>
            <li><?php echo ($vo['username']); ?></li>
            <li><?php echo ($vo['phone']); ?></li>
            <form action="<?php echo U('Swuser/login');?>" id="ufrm" method="post">
                <input type="hidden" class="hidden" value="<?php echo ($vo['username']); ?>" name="username">
                <input type="submit" class="button" value="登录">
            </form>
        </ul><?php endforeach; endif; ?>
</div>
</body>
</html>