<?php 
namespace app\home\controller;
use think\Controller;
use think\Db;
use app\home\model\Goods;
use app\home\model\Category;
class GoodsController extends Controller{
	public function detail($value=''){
		$navCats = Category::where(['is_show'=>1,'pid'=>'0'])->select();

		$cat_id = input('cat_id');
		// halt($cat_id);
		$catModel = new Category();
		$familyCats = $catModel->getFamilyCats($cat_id);
		$goods_id = input('goods_id',0,'intval');
		$goods_data = Goods::find($goods_id);
		//面包屑导航
		$catModel = new Category();
		$familyData = $catModel->getFamilyCats($goods_data['cat_id']);
		/*************图片路径进行json_decode操作*********************/
		$goods_data['goods_img'] = json_decode($goods_data['goods_img']);
		$goods_data['goods_middle'] = json_decode($goods_data['goods_middle']);
		$goods_data['goods_thumb'] = json_decode($goods_data['goods_thumb']);
		/*  *********取出商品的单选属性attr_type ***************************** */
		$singelData = Db::name('goods_attr')
						->alias('t1')
						->field('t1.*,t2.*')
						->join('sh_attribute t2','t1.attr_id = t2.attr_id','left')
						->where("t1.goods_id=$goods_id and t2.attr_type=1")
						->select();
		// 把具有相同属性的attr_id分为同一组
		$single_data = [];
		foreach($singelData as $k=>$attr){
			$single_data[ $attr['attr_id'] ][]=$attr;	
		}
		
		// halt($single_data);
		$onlyData = Db::name('goods_attr')
					->alias('t1')
					->field('t1.*,t2.attr_name')
					->join('sh_attribute t2','t1.attr_id = t2.attr_id','left')
					->where("t1.goods_id=$goods_id and t2.attr_type=0")
					->select();
					//浏览历史
		$goodsModel= new Goods();
		$history = $goodsModel->addGoodsToHistory($goods_id);
		$history = implode(',',$history);
		$sql = "select * from sh_goods where goods_id in ($history) order by field(goods_id,$history)";
		$historyGoods = Db::query($sql);
		// halt($onlyData);
		return $this->fetch('',[
			'goods_data' => $goods_data, 
			'single_data' => $single_data, 
			'onlyData' => $onlyData, 
			'familyData' => $familyData,
			'historyGoods'=>$historyGoods
		]);
	}
	public function ajaxaddcart(){
		if(request()->isAjax()){
			if(!session('member_id')){
				return json(['code'=>-1,'message'=>'请先登录!']);
			}
			$goods_id = input('goods_id');
			$goods_attr_ids = input('goods_attr_ids');
			$goods_number = input('goods_number');
			$cart = new \cart\Cart();
			$cart->addCart($goods_id,$goods_attr_ids,$goods_number);
			return json(['code'=>200,'message'=>"添加购物车成功"]);
		}
	}
}