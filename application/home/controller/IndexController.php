<?php
namespace app\home\controller;
use think\Controller;
use app\home\model\Category;
use app\home\model\Goods;
class IndexController extends Controller{

    public function index(){
    	$navCats = Category::where(['is_show'=>1,'pid'=>'0'])->select();
    	// halt($navCats);
    	$catsData = Category::select()->toArray();
    	$cats = [];
    	foreach($catsData as $cat){
    		$cats[ $cat['cat_id'] ] = $cat;
    	}
    	$children = [];
    	foreach($catsData as $cat){
    		$children[ $cat['pid'] ][] = $cat['cat_id'];
    	}
    	//*********************取出推荐位商品***********************
    	$goodsModel = new Goods();
    	$hotGoods = $goodsModel->getTypeGoods('is_hot');
    	$newGoods = $goodsModel->getTypeGoods('is_new');
    	$bestGoods = $goodsModel->getTypeGoods('is_best');
    	$crazyGoods = $goodsModel->getTypeGoods('is_crazy');
    	$guessGoods = $goodsModel->getTypeGoods('is_guess');
        return $this->fetch('',[
        	'navCats' => $navCats, 
        	'cats' => $cats, 
        	'children' => $children, 
        	'newGoods'=>$newGoods,
        	'bestGoods'=>$bestGoods,
        	'crazyGoods'=>$crazyGoods,
        	'guessGoods'=>$guessGoods,
        	'hotGoods'=>$hotGoods,
        ]);
    }
}
