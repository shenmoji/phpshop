<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:69:"D:\www.php15shop.com\public/../application/admin\view\index\left.html";i:1528789019;}*/ ?>
﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>无标题文档</title>
    <link href="<?php echo config('admin_static'); ?>/css/style.css" rel="stylesheet" type="text/css" />
    <script language="JavaScript" src="<?php echo config('admin_static'); ?>/js/jquery.js"></script>
    <script type="text/javascript">
    $(function() {
        //导航切换
        $(".menuson li").click(function() {
            $(".menuson li.active").removeClass("active")
            $(this).addClass("active");
        });

        $('.title').click(function() {
            var $ul = $(this).next('ul');
            $('dd').find('ul').slideUp();
            if ($ul.is(':visible')) {
                $(this).next('ul').slideUp();
            } else {
                $(this).next('ul').slideDown();
            }
        });
    })
    </script>
</head>

<body style="background:#f0f9fd;">
    <div class="lefttop"><span></span>※ 控制面板 ※</div>
    <dl class="leftmenu">
         <!-- 循环一级权限 -->
         <?php echo session('role_id'); foreach(session('menuAuth') as $one_menu):?>
        <dd>
            <div class="title">
                <span><img src="<?php echo config('admin_static'); ?>/images/leftico01.png" /></span><?php echo $one_menu['auth_name']; ?>
            </div>
            <ul class="menuson">
                <!-- 循环一级中的二级权限 -->
                <?php foreach($one_menu['sonsAuth'] as $two_menu):?>
                <li>
                    <cite></cite><a href="<?php echo '/index.php/admin/'.$two_menu['auth_c'].'/'.$two_menu['auth_a']; ?>" target="rightFrame"><?php echo $two_menu['auth_name']; ?></a><i></i>
                </li>
                <?php  endforeach;?>
            </ul>
        </dd>
        <?php  endforeach;?>  
    </dl>
</body>

</html>
