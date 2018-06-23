<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:69:"D:\www.php15shop.com\public/../application/admin\view\user\index.html";i:1528888092;}*/ ?>
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
                    <th>名称</th>
                    <th>角色</th>
                    <th>是否可用</th>
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
                    <td><?php echo $list['username']; ?></td>
                    <td class="t1"><?php echo $roles[ $list['role_id'] ]['role_name']; ?></td>
                    <td><a class="changeActive" user_id="<?php echo $list['user_id']; ?>" is_active="<?php echo $list['is_active']; ?>" href="javascript:;"><?php echo !empty($list['is_active'])?'可用':'禁用';; ?></a></td>
                    <td><?php echo $list['create_time']; ?></td>
                    <td><?php echo $list['update_time']; ?></td>
    <td>
        <a href="<?php echo url('admin/user/upd',['user_id'=>$list['user_id']]); ?>" class="tablelink">编辑</a>
         <!-- <a href="<?php echo url('admin/user/del',['user_id'=>$list['user_id']]); ?>" onclick="return confirm('确定要删除吗?')"  class=" delCat tablelink"> 删除</a> -->
     <a href="javascript:;" user_id="<?php echo $list['user_id']; ?>" onclick="return confirm('确定要删除吗?')"  class=" delCat tablelink"> 删除</a>
     </td>
                </tr>
               <?php endforeach; endif; else: echo "" ;endif; ?>
            </tbody>
        </table><!-- paginList -->
        <div class="pagination">
           <?php echo $lists->render(); ?>
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
        $(".changeActive").click(function(){
            var is_active = $(this).attr('is_active');
            var user_id = $(this).attr('user_id');
            var _self = $(this);
            $.get("<?php echo url('admin/user/ajaxChangeActive'); ?>",{"is_active":is_active,'user_id':user_id},function(json){
                if(json.status == 200){
                    _self.html(json.is_active == 1?'可用':'禁用');
                    _self.attr('is_active',json.is_active);
                }else{
                    alert(json.message);
                }
            },'json')
        });
        $(".delCat").click(function(){
            if(confirm("确认删除?") == false){
                return ;
            }
            var user_id = $(this).attr('user_id');
            $.get("<?php echo url('admin/user/ajaxDelCat'); ?>",{"user_id":user_id},function(data){
                console.log(data);
            },'json');
        });
       // var t1 = $(".t1").html();
       // if(t1 == 1){
       //      t1.html("神墨迹221");
       // }else if(t1 == 2 ){
       //      t1.html("神墨迹");
       // }else{
       //      t1.html(" ");
       // }

     
           
    </script>
</body>

</html>
