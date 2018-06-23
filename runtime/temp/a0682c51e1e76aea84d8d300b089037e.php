<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:68:"D:\www.php15shop.com\public/../application/admin\view\goods\add.html";i:1529417048;}*/ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>无标题文档</title>
    <style type="text/css">
        
        
    </style>
    <link href="<?php echo config('admin_static'); ?>/css/style.css" rel="stylesheet" type="text/css" />
   <script type="text/javascript" charset="utf-8" src="/plugin/ueditor/ueditor.config.js"></script>
   <script type="text/javascript" charset="utf-8" src="/plugin/placeImage.js"></script>
    <script type="text/javascript" charset="utf-8" src="/plugin/ueditor/ueditor.all.min.js"> </script>
    <!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
    <!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
    <script type="text/javascript" charset="utf-8" src="/plugin/ueditor/lang/zh-cn/zh-cn.js"></script>
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
            <span>商品属性信息</span>
            <span>商品相册</span>
            <span>商品描述</span>

        </div>
        <form action="" method="post" enctype = multipart/form-data>
            <ul class="forminfo">
                <li>
                    <label>商品名称</label>
                    <input name="goods_name" placeholder="请输入商品名称" type="text" class="dfinput" /><i>名称不能超过30个字符</i>
                </li>
                <li>
                    <label>商品价格</label>
                    <input name="goods_price" placeholder="请输入商品价格" type="text" class="dfinput" /><i></i>
                </li>
                <li>
                    <label>商品库存</label>
                    <input name="goods_number" placeholder="请输入商品数量" type="text" class="dfinput" />
                </li>
                <li>
                    <label>商品分类</label>
                    <select name="cat_id" class="dfinput">
                        <option value="">请选择分类</option>
                        <?php if(is_array($cats) || $cats instanceof \think\Collection || $cats instanceof \think\Paginator): $i = 0; $__LIST__ = $cats;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cat): $mod = ($i % 2 );++$i;?>
                        <option value="<?php echo $cat['cat_id']; ?>"><?php echo str_repeat('&nbsp;&nbsp;',$cat['deep']*2); ?><?php echo $cat['cat_name']; ?></option>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </li>
                <li>
                    <label>是否在回收站</label>
                    <input name="is_delete"  type="radio" value="0" checked="checked" />否
                    <input name="is_delete"  type="radio" value="1" />是
                </li>
                 <li>
                    <label>是否上架</label>
                    <input name="is_sale"  type="radio" value="0"  />否
                    <input name="is_sale"  type="radio" value="1" checked="checked"/>是
                </li>
                 <li>
                    <label>是否新品</label>
                    <input name="is_new"  type="radio" value="0" />否
                    <input name="is_new"  type="radio" value="1"  checked="checked"/>是
                </li>
                 <li>
                    <label>是否热卖</label>
                    <input name="is_hot"  type="radio" value="0" />否
                    <input name="is_hot"  type="radio" value="1" checked="checked" />是
                </li>
                 <li>
                    <label>是否推荐</label>
                    <input name="is_best"  type="radio" value="0" />否
                    <input name="is_best"  type="radio" value="1" checked="checked" />是
                </li>
                <!--
                <li><label>是否审核</label><cite><input name="" type="radio" value="" checked="checked" />是&nbsp;&nbsp;&nbsp;&nbsp;<input name="" type="radio" value="" />否</cite></li>
                -->
                
                
            </ul>

            <ul class="forminfo">
                 <li>
                    <label>商品类型</label>
                    <select name="type_id" class="dfinput">
                        <option value="">请选择商品类型</option>
                        <?php if(is_array($types) || $types instanceof \think\Collection || $types instanceof \think\Paginator): $i = 0; $__LIST__ = $types;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$type): $mod = ($i % 2 );++$i;?>
                        <option value="<?php echo $type['type_id']; ?>"><?php echo $type['type_name']; ?></option>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                    <li id="attrContain">
                        
                    </li>
                </li>
            </ul>

            <ul class="forminfo">
                <li>
                    <label>商品相册</label>
                   <a href="javascript:void(0);" style="margin-right:10px;" onclick="clong(this)">[ + ]</a> <input name="img[]"  type="file" class="dfinput Acle" id="f" onchange="change()" /><i>支持上传多张图片</i>
                </li>
                <p>预览</p>
                <p>
                    <img id="preview" width="200px">
                </p>
            </ul>

            <ul class="forminfo">
                <li>
                    <label>商品描述</label>
                    <textarea name="goods_desc" id="goods_desc" >
                        
                    </textarea>
                </li>
                
                <!--
                <li><label>是否审核</label><cite><input name="" type="radio" value="" checked="checked" />是&nbsp;&nbsp;&nbsp;&nbsp;<input name="" type="radio" value="" />否</cite></li>
                -->
            </ul>

			<li>
                    <label>&nbsp;</label>
                    <input name="" id="btnSubmit" type="submit" class="btn" value="确认保存" />
             </li>
        </form>
    </div>
</body>
<script>
    var ue = UE.getEditor('goods_desc');
    $(".formtitle span").click(function(event){
        $(this).addClass('active').siblings("span").removeClass('active') ;
        var index = $(this).index();
        $("ul.forminfo").eq(index).show().siblings(".forminfo").hide();
    });
     $(".formtitle span").eq(0).click();

     var mark = $("textarea[name='goods_desc']").val();
       var reg = /\s+/g;
        $("textarea[name='goods_desc']").val(mark.replace(reg,''));
</script>
<script type="text/javascript">
    function clong(obj){

        if($(obj).html() == '[ + ]'){
            var new_li = $(obj).parent().clone();
            new_li.find('a').html('[ - ]');
            //追加到当前元素的后面
            $(obj).parent().after(new_li);
        }else{
            $(obj).parent().remove();
        }
    }
    //为第二个选项卡中的单选属性添加克隆
    function attrclong(obj){

        if($(obj).html() == '[ + ]'){
            var new_li = $(obj).parent().clone();
            new_li.find('a').html('[ - ]');
            //追加到当前元素的后面
            $(obj).parent().after(new_li);
        }else{
            $(obj).parent().remove();
        }
    }
</script>
<script type="text/javascript">
    $('select[name="type_id"]').change(function(){
        var type_id = $(this).val();
        if(type_id == ''){
            return false;
        }else{
            $.get("<?php echo url('admin/goods/ajaxGetTypeAttr'); ?>",{"type_id":type_id},function(attr){
                console.log(attr);
                //拼接获取数据
                var html = "<ul>";
                //每个属性都是一个li标签,循环创建
                for(var i = 0,length = attr.length;i<length;i++){
                    //拼接li
                    html += "<li>";
                    //判断是否为单选属性
                        if(attr[i].attr_type == 1){
                            html += "<a href='javascript:void(0);' onclick = 'attrclong(this)'>[ + ]</a>";
                        }
                        //拼接属性名称
                        html += attr[i].attr_name+":&nbsp;";
                        
                        //如果为单选属性(1)name需要加[]  ==> name=goodsAttrValue['attr_id'][]
                        //如果为单选属性(0)name需要加[]  ==> name=goodsAttrValue['attr_id'][]
                        var hasManyValue = attr[i].attr_type == 1?'[]':'';
                        //判断是否为列表录入
                        if(attr[i].attr_input_type == 0){
                            //拼接input
                            html += "<input type='text' name='goodsAttrValue["+attr[i].attr_id+"]"+hasManyValue+"' placeholder='输入属性值' class='dfinput'>";
                        }else{
                            //下拉框录入
                            var attr_values = attr[i].attr_values;
                            html += "<select class='dfinput' name='goodsAttrValue["+attr[i].attr_id+"]"+hasManyValue+"' >";
                                var single_attr_value = attr_values.split('|');
                                for(var j = 0,p = single_attr_value.length;j < p; j++){
                                    html += "<option>"+single_attr_value[j]+"</option>";
                                }
                            html += "</select>"; 
                        }
                        //单选属性输入价格这一步和第一个if判断一样 可以移动到上面  然后改变样式
                        if(attr[i].attr_type ==1){
                            html += "&nbsp;&nbsp;价格: <input style='width:100px' placeholder='请输入价格' type='text' class='dfinput' name='goodsAttrPrice["+attr[i].attr_id+"][]' >";
                        }
                    html += "</li>";
                }
                html += "<li>";
                $("#attrContain").html(html);
            },'json');
        }
    });

</script>


</html>
