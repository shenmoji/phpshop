<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:71:"D:\www.php15shop.com\public/../application/admin\view\category\add.html";i:1529150636;}*/ ?>
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
                    <label>分类名称:</label>
                   <input type="text" name="cat_name" class="dfinput" placeholder="请输入属性名称"/>
                </li>
                <li>
                    <label>选择父分类</label>
                    <select name="pid" class="dfinput">
                        <option value="">请选择分类</option>
                        <option value="0">顶级分类</option>
                        <?php if(is_array($cats) || $cats instanceof \think\Collection || $cats instanceof \think\Paginator): $i = 0; $__LIST__ = $cats;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cat): $mod = ($i % 2 );++$i;?>
                        <option value="<?php echo $cat['cat_id']; ?>"><?php echo str_repeat('&nbsp;&nbsp;',$cat['deep']*2); ?><?php echo $cat['cat_name']; ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </li>
                
                
                 <li>
                    <label>导航栏</label>
                    
                       <input type="radio" name="is_show"  value="1"  checked="checked" /> 显示
                       <input type="radio" name="is_show"  value="0" /> 不显示
                   
                   
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
   //   var mark = $("textarea[name='attr_values']").val();
   //     var reg = /\s+/g;
   //      $("textarea[name='attr_values']").val(mark.replace(reg,''));

   //      $("input[name='attr_input_type']").click(function(){
   //          var val = $(this).val();
   //          if(val == 0){
   //              $("textarea[name='attr_values']").prop('disabled',true).val('');
   //          }else{
   //              $("textarea[name='attr_values']").prop('disabled',false);
   //          }
   //      });
   // $("textarea[name='attr_values']").prop('disabled',true);

</script>

</html>
