<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:67:"D:\www.php15shop.com\public/../application/admin\view\type\add.html";i:1528959948;}*/ ?>
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
                    <label>类型名称</label>
                    <input name="type_name" placeholder="请输入类型" type="text" class="dfinput" />
                </li>
                
                <li>
                    <label>备注信息:</label>
                   <textarea name="mark" style="height: 170px;width: 360px; background-color: #abcdef;">
                       
                   </textarea>
                </li>
                 <!-- <li>
                    <label>创建时间:</label>
                    <input name="create_time" placeholder="请输入确认时间" type="text" class="dfinput" /><i></i>
                </li>
                 <li>
                    <label>更新时间:</label>
                    <input name="update_time" placeholder="请输入确认时间" type="text" class="dfinput" /><i></i>
                </li> -->

            </ul>
            <li>
                    <label>&nbsp;</label>
                    <input name="" id="btnSubmit" type="submit" class="btn" value="确认保存" />
             </li>
        </form>
    </div>
</body>
<script>
    var mark = $("textarea[name='mark']").val();
       var reg = /\s+/g;
        $("textarea[name='mark']").val(mark.replace(reg,''));
</script>

</html>