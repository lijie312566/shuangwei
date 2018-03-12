<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <form class="form-inline" method="post">
    <table class="table table-striped table-bordered table-hover table-condensed">
        <tr>
            <th>管理组</th>
            <td>
                <input type="hidden" name="company_id" value="<?php echo ($_SESSION['user']['id']); ?>">
                <?php if(is_array($dataa)): foreach($dataa as $key=>$v): echo ($v['title']); ?>
                    <input class="xb-icheck" type="checkbox" name="group_ids[]" value="<?php echo ($v['id']); ?>">
                    &emsp;<?php endforeach; endif; ?>
            </td>
        </tr>
        <tr>
            <th>姓名</th>
            <td>
                <input class="form-control" type="text" name="username" required="required">
            </td>
        </tr>
        <tr>
            <th>手机号</th>
            <td>
                <input class="form-control" type="text" name="phone" required="required">
            </td>
        </tr>
        <!--<tr>-->
        <!--<th>邮箱</th>-->
        <!--<td>-->
        <!--<input class="form-control" type="text" name="email" required="required">-->
        <!--</td>-->
        <!--</tr>-->
        <tr>
            <th>初始密码</th>
            <td>
                <input class="form-control" type="text" name="password" required="required">
            </td>
        </tr>
        <tr>
            <th>状态</th>
            <td>
                <span class="inputword">允许登录</span>
                <input class="xb-icheck" type="radio" name="status" value="1" checked="checked">
                &emsp;
                <span class="inputword">禁止登录</span>
                <input class="xb-icheck" type="radio" name="status" value="0">
            </td>
        </tr>
        <tr>
            <th></th>
            <td>
                <input class="btn btn-success" type="submit" value="添加">
            </td>
        </tr>
    </table>
</form>
</body>
</html>