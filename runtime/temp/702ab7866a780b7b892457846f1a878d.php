<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:70:"D:\www.php15shop.com\public/../application/admin\view\order\index.html";i:1529757818;s:60:"D:\www.php15shop.com\application\admin\view\order\tbody.html";i:1529753632;}*/ ?>
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
        <div class="tools">
            <ul class="toolbar">
                <li><span><img src="<?php echo config('admin_static'); ?>/images/t01.png" /></span>添加</li>
                <li><span><img src="<?php echo config('admin_static'); ?>/images/t02.png" /></span>修改</li>
                <li><span><img src="<?php echo config('admin_static'); ?>/images/t03.png" /></span>删除</li>
                <li><span><img src="<?php echo config('admin_static'); ?>/images/t04.png" /></span>统计</li>
            </ul>
        </div>
        <form method="get" style="margin-bottom: 10px">
            输入收货人/电话/订单号/地址:<input type="text" name="keyword" id="keyword" class="dfinput" placeholder="输入收货人/电话/订单号/地址">
            <input type="button" class="dfinput" style="width: 100px;" id="search" value="查询">
        </form>
        <table class="tablelist">
            <thead>
                <tr>
                    <th>
                        <input name="" type="checkbox" value="" id="checkAll" />
                    </th>
                    <th>订单号</th>
                    <th>购买人</th>
                    <th>收货人/收货地址</th>
                    <th>电话/邮编</th>
                    <th>总金额</th>
                    <th>付款状态</th>
                    <th>发货状态</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                 <?php if(is_array($lists) || $lists instanceof \think\Collection || $lists instanceof \think\Paginator): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?>
                <tr>
                    <td>
                        <input name="" type="checkbox" value="" />
                    </td>
                    <td><?php echo $list['order_id']; ?></td>
                    <td><?php echo $list['username']; ?></td>
                    <td><?php echo $list['receiver']; ?>/<?php echo $list['address']; ?></td>
                    <td><?php echo $list['tel']; ?>/<?php echo $list['zcode']; ?></td>
                    <td>￥<?php echo $list['total_price']; ?></td>
                    <td><?php echo config('pay_status')[$list['pay_status']]; ?></td>
                    <td><?php echo config('send_status')[$list['send_status']]; ?></td>
                    <td>
                        <?php if( $list['pay_status']==1 && $list['send_status']==0 ){?>
                        <a href="<?php echo url('admin/order/upd',['id'=>$list['id']]); ?>"   class="showContent tablelink">配置物流</a> 
                        <?php  } else if( $list['pay_status']==1 && $list['send_status']==1 ){　?>
                        <a href="javascript:;" number="<?php echo $list['number']; ?>" company="<?php echo $list['company']; ?>" class="wuliu tablelink">查看物流</a>
                        <?php  } else if($list['pay_status']==0){ ?>
                        <span style="color:pink">请等待买家付款</span>
                        <?php  } ?>
                    
                        
                    </td>
                </tr>
<?php endforeach; endif; else: echo "" ;endif; ?>
            </tbody>
        </table>
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
        //ajax无刷新分页(使用委托方式绑定单击事件，让后续新来的元素也有单击事件)
        $(".pagination").on('click','a',function(){
            var href = $(this).attr('href');
            var keyword = $("input[name='keyword']").val();
            //阻止a标签的默认行为(禁止a标签跳转)
            $.get(href,{"keyword":keyword},function(json){
                // console.log(json);
                var reg = new RegExp(keyword, 'g');
                if(keyword){
                //把返回的数据，进行替换即可
                //替换主体和分页页码数据
                //关键字为真我们才替换
                    $("tbody").html(json.tbody.replace(reg,"<span style='color:red'>"+keyword+"</span>"));
                }else{
                    $("tbody").html(json.tbody);
                }
                $(".pagination").html(json.pagelist);
            },'json')
            return false;
        });
    </script>
    <!-- 订单查询 -->
    <script type="text/javascript">
        $('tbody').on('click','.wuliu',function(){
            // alert(1);
            var company = $(this).attr('company');
            var number = $(this).attr('number');
            var param = {"company":company,"number":number};
            // alert(123);
            $.get("<?php echo url('admin/order/querywuliu'); ?>",param,function(text){
                layer.open({
                    type:2,
                    title:'物流信息',
                    shadeClose:true,
                    shade:0.8,
                    area:['650px','550px'],
                    content:text
                });
            },'text');
        });
    </script>
    <!-- 关键字搜索 -->
    <script type="text/javascript">
        $("#search").click(function(){
            // alert(123);
            var keyword = $("input[name='keyword']").val();
            $.get("<?php echo url('admin/order/index'); ?>",{"keyword":keyword},function(json){
                var reg = new RegExp(keyword,'g');
                if(keyword){
                    $("tbody").html(json.tbody.replace(reg,"<span style='color:red'>"+keyword+"</span>"));   
                }else{
                    $("tbody").html(json.tbody);
                }
                $(".pagination").html(json.pagelist);
            },'json');
        })
    </script>
</body>

</html>
