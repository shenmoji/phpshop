<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:67:"D:\www.php15shop.com\public/../application/admin\view\user\add.html";i:1528792971;}*/ ?>
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
                    <label>用户名</label>
                    <input name="username" placeholder="请输入用户名" type="text" class="dfinput" />
                </li>
                <li>
                    <label>请选择角色</label>
                    <select name="role_id" class="dfinput">
                        <option value="">--请选择角色--</option>
                        <?php if(is_array($appdd) || $appdd instanceof \think\Collection || $appdd instanceof \think\Paginator): $i = 0; $__LIST__ = $appdd;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$apd): $mod = ($i % 2 );++$i;?>
                            <option value="<?php echo $apd['role_id']; ?>"><?php echo $apd['role_name']; ?></option>
                        <?php endforeach; endif; else: echo "" ;endif; ?>

                    </select>
                </li>
                <li>
                    <label>密码：</label>
                    <input name="password" placeholder="请输入商品密码" type="password" class="dfinput" /><i></i>
                </li>
                 <li>
                    <label>确认密码：</label>
                    <input name="repassword" placeholder="请输入确认密码" type="password" class="dfinput" /><i></i>
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
    $(".formtitle span").click(function(event){
        $(this).addClass('active').siblings("span").removeClass('active') ;
        var index = $(this).index();
        $("ul.forminfo").eq(index).show().siblings(".forminfo").hide();
    });
     $(".formtitle span").eq(0).click();
</script>

</html>
