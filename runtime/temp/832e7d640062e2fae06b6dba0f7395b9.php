<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:69:"D:\www.php15shop.com\public/../application/admin\view\type\index.html";i:1528959744;}*/ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>无标题文档</title>
    <link href="<?php echo config('admin_static'); ?>/css/style.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo config('admin_static'); ?>/css/page.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="<?php echo config('admin_static'); ?>/js/jquery.js"></script>
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
        <div class="tools">
            <ul class="toolbar">
                <li><span><img src="<?php echo config('admin_static'); ?>/images/t01.png" /></span>添加</li>
                <li><span><img src="<?php echo config('admin_static'); ?>/images/t02.png" /></span>修改</li>
                <li><span><img src="<?php echo config('admin_static'); ?>/images/t03.png" /></span>删除</li>
                <li><span><img src="<?php echo config('admin_static'); ?>/images/t04.png" /></span>统计</li>
            </ul>
        </div>
        <table class="tablelist">
            <thead>
                <tr>
                    <th>
                        <input name="" type="checkbox" value="" id="checkAll" />
                    </th>
                    <th>类型名称</th>
                    <th>描述</th>
              
                    <th>创建时间</th>
                    <th>更新时间</th>
                    <th>操作</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php if(is_array($lists) || $lists instanceof \think\Collection || $lists instanceof \think\Paginator): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?>
                <tr>
                    <td>
                        <input name="" type="checkbox" value="" />
                    </td>
                    <td><?php echo $list['type_name']; ?></td>
                    <td class="t1"><?php echo $list['mark']; ?></td>
                    <
                    <td><?php echo $list['create_time']; ?></td>
                    <td><?php echo $list['update_time']; ?></td>
    <td>
        <a href="<?php echo url('admin/type/getAttr',['type_id'=>$list['type_id']]); ?>" class="tablelink">查看属性</a>
       <a href="<?php echo url('admin/type/upd',['type_id'=>$list['type_id']]); ?>" class="tablelink">编辑</a>
     <a href="javascript:;" type_id="<?php echo $list['type_id']; ?>"  class="delCat tablelink"> 删除</a>
     </td>
                </tr>
               <?php endforeach; endif; else: echo "" ;endif; ?>
            </tbody>
        </table><!-- paginList -->
        <div class="pagination">
        
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
        $('.tablelist tbody tr:odd').addClass('odd');
    </script>
    <script type="text/javascript">
        $(".delCat").click(function(){
            if(confirm("确定删除?") == false){
                return false;
            }
            var _self = $(this);
            var type_id = _self.attr('type_id');
            // alert(type_id);
            $.get("<?php echo url('admin/type/ajaxdel'); ?>",{"type_id":type_id},function(data){
                if(data.code == 200){
                    _self.parent().parent().remove();
                }else{
                    alert('删除时候');
                }
            },'json')
        });
       
    
    </script>
</body>

</html>
