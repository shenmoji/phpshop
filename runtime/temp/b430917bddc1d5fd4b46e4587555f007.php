<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:67:"D:\www.php15shop.com\public/../application/admin\view\auth\add.html";i:1528645323;}*/ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>无标题文档</title>
    <link href="<?php echo config('admin_static'); ?>/css/style.css" rel="stylesheet" type="text/css" />
    <script language="JavaScript" src="<?php echo config('admin_static'); ?>/js/jquery.js"></script>
    <style>
        .active{
            border-bottom: solid 3px #66c9f3;
        }
    </style>
</head>

<body>
    <div class="place">
        <span>位置：</span>
        <ul class="placeul">
            <li><a href="#">首页</a></li>
            <li><a href="#">表单</a></li>
        </ul>
    </div>
    <div class="formbody">
        <div class="formtitle">
            <span class="active">基本信息</span>

        </div>
        <form action="" method="post">
            <ul class="forminfo">
                <li>
                    <label>权限名称</label>
                    <input name="auth_name" placeholder="请输入权限名" type="text" class="dfinput" />
                </li>
                <li>
                    <label>父权限</label>
                    <select name="pid" class="dfinput">
                        <option value="0">顶级权限</option>
                        <?php if(is_array($auths) || $auths instanceof \think\Collection || $auths instanceof \think\Paginator): $i = 0; $__LIST__ = $auths;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$auth): $mod = ($i % 2 );++$i;?>
                            <option value="<?php echo $auth['auth_id']; ?>"><?php echo str_repeat('&nbsp;&nbsp;',$auth['deep']*2); ?><?php echo $auth["auth_name"]; ?></option>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </li>
                 <li>
                    <label>控制器名</label>
                    <input name="auth_c" placeholder="请输入控制器名" type="password" class="dfinput" /><i></i>
                </li>
                <li>
                    <label>控制器方法名</label>
                    <input name="auth_a" placeholder="请输入控制器方法名" type="password" class="dfinput" /><i></i>
                </li>
            </ul>
            <li>
                    <label>&nbsp;</label>
                    <input name="" id="btnSubmit" type="submit" class="btn" value="确认保存" />
             </li>
        </form>
    </div>
</body>
<script>
   $("select[name='pid']").change(function(){
    var pid = $(this).val();
    if(pid == 0){
        $("input[name='auth_c'],input[name='auth_a']").prop('readonly',true).val();
    }else{
        $("input[name='auth_c'],input[name='auth_a']").prop('readonly',false).val();
    }
   });
   $("select[name='pid']").change();
</script>

</html>
