<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:68:"D:\www.php15shop.com\public/../application/admin\view\order\upd.html";i:1529745989;}*/ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>无标题文档</title>
    <link href="<?php echo config('admin_static'); ?>/css/style.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo config('admin_static'); ?>/css/page.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="<?php echo config('admin_static'); ?>/js/jquery.js"></script>
    <script type="text/javascript" src="/plugin/layer/layer.js"></script>
    <script type="text/javascript">
        

    </script>
    <script type="text/javascript">
    $(document).ready(function() {
        $(".click").click(function() {
            $(".tip").fadeIn(200);
        });

        $(".tiptop a").click(function() {
            $(".tip").fadeOut(200);
        });

        $(".sure").click(function() {
            $(".tip").fadeOut(100);
        });

        $(".cancel").click(function() {
            $(".tip").fadeOut(100);
        });

    });
    </script>
</head>

<body>
    <div class="place">
        <span>位置：</span>
        <ul class="placeul">
            <li><a href="#">首页</a></li>
            <li><a href="#">数据表</a></li>
            <li><a href="#">基本内容</a></li>
        </ul>
    </div>
    <div class="rightinfo">
        
        
        <div class="pagination">
           <form action="" method="post" id="theform">
               <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
               <ul class="forminfo">
                   <li>
                       <label>订单号</label>
                       <input type="text" disabled="disabled" value="<?php echo $data['order_id']; ?>" class="dfinput">
                   </li>
                   <li>
                       <label>选择物流公司</label>
                       <select name="company" class="dfinput">
                        <option value="">请选择物流公司</option>
                        <option value="yuantong">圆通</option>
                        <option value="shentong">申通</option>
                        <option value="zhongtong">中通</option>
                        <option value="yunda">韵达</option>
                        <option value="shunfeng">顺丰</option>
                       </select>
                   </li>
                   <li>
                       <label>运单号</label>
                       <input type="text" name="number"  placeholder="请输入物流运单号" class="dfinput">
                   </li>
                   <li>
                       <label>&nbsp;</label>
                       <input type="submit" value="确认保存" class="btn" id="btnSubmit">
                   </li>
               </ul>
           </form>
        </div>
        <div class="tip">
            <div class="tiptop"><span>提示信息</span>
                <a></a>
            </div>
            <div class="tipinfo">
                <span><img src="<?php echo config('admin_static'); ?>/images/ticon.png" /></span>
                <div class="tipright">
                    <p>是否确认对信息的修改 ？</p>
                    <cite>如果是请点击确定按钮 ，否则请点取消。</cite>
                </div>
            </div>
            <div class="tipbtn">
                <input name="" type="button" class="sure" value="确定" />&nbsp;
                <input name="" type="button" class="cancel" value="取消" />
            </div>
        </div>
    </div>
    <script type="text/javascript">
       
    </script>
</body>

</html>
