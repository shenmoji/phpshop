<?php 
namespace app\home\controller;
use think\Controller;
use app\home\model\Category;
use app\home\model\Goods;
class CategoryController extends Controller{
	public function index(){
		$navCats = Category::where(['is_show'=>1,'pid'=>'0'])->select();

		$cat_id = input('cat_id');
		// halt($cat_id);
		$catModel = new Category();
		$familyCats = $catModel->getFamilyCats($cat_id);
 
		/***********分类左侧折叠菜单******************/
		$catsData = Category::select()->toArray();
		$cats = [];
		//1、以cat_id作为下标
		foreach ($catsData as $cat){
		    $cats[ $cat['cat_id'] ] = $cat;
		}
		$children = [];
		//2、以pid进行分组
		foreach ($catsData as $cat){
		    $children[ $cat['pid'] ][] = $cat['cat_id'];
		}
		//***************获取当前分类$cat_id的所有子孙分类id****************************/
		$catModel = new Category();
		$sonsCatsId = $catModel->getSonsCatId($cat_id);
		//加上当前的分类cat_id
		$sonsCatsId[]=intVal($cat_id);
		// dump($cat_id);//16
		// dump($sonsCatsId);//18 19 16
		//取出所有子孙分类sonCatsId中的所有的商品
		$condition = [
		    'is_sale' => ['eq',1],
		    'is_delete' => 0,
		    'cat_id' => ['in',$sonsCatsId] 
		];
		$catsGoods = Goods::where($condition)->select();
		// halt($catsGoods);
		return $this->fetch('',[
		    'familyCats' => $familyCats,
		    'cats' => $cats,
		    'navCats' => $navCats,
		    'children' => $children,
		    'catsGoods' => $catsGoods
		]);
				
	}
	
}