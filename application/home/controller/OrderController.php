<?php 
namespace app\home\controller;
use think\Controller;
use app\home\model\Goods;
use app\home\model\Order;
use app\home\model\OrderGoods;
use think\Db;
class OrderController extends Controller{
	public function orderinfo(){
		$goodsModel = new Goods();
		$cartData = $goodsModel->getcartgoodsdata();
		// halt($cartData);
		if(!session('member_id')){
			$this->error("请先登录");
		}
		if(request()->isPost()){
			$this->_writeOrder();die;
		}
		return $this->fetch('',[
			'cartdata' => $cartData
		]);
	}
	private function _writeOrder(){
		$postData = input('post.');
		$result = $this->validate($postData,'Order.add',[],true);
		if($result !== true){
			$this->error(implode(',',$result));
		}
		$goodsModel = new Goods();	
		$cartData = $goodsModel->getcartgoodsdata();
		$total_price = 0;
		foreach($cartData as $cart){
			$total_price += ($cart['goodsInfo']['goods_price']+$cart['attrInfo']['attr_total_price'])*$cart['goods_number'];
		}
		//1/
		$orderData = $postData;
		$orderData['total_price'] = $total_price;
		$orderData['member_id'] = session('member_id');
		$orderData['order_id'] = date("Ymd").time().uniqid();
		Db::startTrans();
		try{
			//2/捕获异常 
			//成功提交事务
			////4
			$order = Order::create($orderData);
			if(!$order){
				throw new \Exception("订单表入库失败");
			}
			foreach($cartData as $cart){
				$orderGoods = OrderGoods::create([
					'order_id' => $orderData['order_id'],
					'goods_id' => $cart['goods_id'],
					'goods_attr_ids' => $cart['goods_attr_ids'],
					'goods_number' => $cart['goods_number'],
					'goods_price' => ($cart['goodsInfo']['goods_price']+$cart['attrInfo']['attr_total'])*$cart['goods_number']
				]);
				$condition = [
					'goods_id' => $cart['goods_id'],
					'goods_number' => ['>=',$cart['goods_number']]
				];
				$num = Goods::where($condition)->setDec('goods_number',$cart['goods_number']);
				if(!$orderGoods || !$num){
					throw new \Exception('订单商品表失败,或超库存');
				}
			}
			Db::commit();
			$cart = new \cart\Cart();
			$cart->clearCart();
		}catch(\Exception $e){
			//3/处理异常
			Db::rollback();
			$this->error($e->getMessage());
		}
		//5: 支付宝进行支付操作
		$this->_payMoney($orderData['order_id'],$total_price);
	}
	private function _payMoney($order_id,$total_price,$title='php15支付宝',$content="没几百万你还来学什么PHP??!!"){
		$payData = [
			'WIDout_trade_no' => $order_id,
			'WIDsubject' => $title,
			'WIDtotal_amount' =>$total_price,
			'WIDbody' => $content 
		];
		include "../extend/alipay/pagepay/pagepay.php";
	}
	public function returnurl(){
		require_once("../extend/alipay/config.php");
		require_once("../extend/alipay/pagepay/service/AlipayTradeService.php");
		$arr = input("get.");
		$alipaySevice = new \AlipayTradeService($config);
		$result = $alipaySevice->check($arr);
		if($result){
			// halt($arr);
			
			//商户订单号
			$out_trade_no = htmlspecialchars($_GET['out_trade_no']);
			//支付宝交易号
			$trade_no = htmlspecialchars($_GET['trade_no']);
			$data = [
				'pay_status' => 1,
				'ali_order_id' => $trade_no
			];
		if(Order::where('order_id',$out_trade_no)->update($data)){
			$this->success("支付成功",url("home/order/selforder"));
			}else{
			$this->error("支付异常",url("home/index/index"));
			}
		}else{
			echo "验证失败";
		}
	}

	public function selforder(){
		$member_id = session('member_id');
		if(!$member_id){
			$this->error("请登录后再操作");
		}
		$lists = Order::where("member_id",$member_id)->select();
		return $this->fetch('',[
			'lists'=>$lists
		]);
	}
	public function payMoney($value=''){
		$id = input('id');
		$data = Order::find($id);
		if($data){
			$this->_payMoney($data['order_id'],$data['total_price']);
		}else{
			$this->error("支付异常,请稍后再试");
		}
	}
}