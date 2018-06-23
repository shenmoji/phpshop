<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:70:"D:\www.php15shop.com\public/../application/admin\view\order\tbody.html";i:1529753632;}*/ ?>
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