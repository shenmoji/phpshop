<?php  
namespace app\admin\controller;
use app\admin\model\Category;
use app\admin\model\Goods;
use app\admin\validate;
class CategoryController extends CommonController{
	public function add($value=''){
		$catModel = new Category();
		if(request()->isPost()){
		    //接收参数
		    $postData = input('post.');
		    //验证器验证
		    $result = $this->validate($postData,'Category.add',[],true);
		    if($result !== true){
		    	$this->error(implode(',',$result));
		    }
		    //入库
		    $catModel = new Category();
		    if($catModel->allowField(true)->save($postData)){
		    	$this->success("入库成功",url("admin/category/index"));
		    }else{
		    	$this->error("入库失败");
		    }
		}
		$cats = $catModel->getSonsCat();
		// halt($cats);
		return $this->fetch('',[
			'cats' => $cats
		]);
	}
	public function index($value=''){
		$catModel = new Category();
		$lists = $catModel->getSonsCat();
		return $this->fetch('',[
			'lists' => $lists
		]);
	}
	public function upd($value=''){
		$catModel = new Category();
		if(request()->isPost()){
		    //接收参数
		    $postData = input('post.');
		    //验证器验证
		    
		    $result = $this->validate($postData,'Category.add',[],true);
		    if($result !== true){
		    	$this->error(implode(',',$result));
		    }
		    //入库
		    if($catModel->allowField(true)->isUpdate(true)->save($postData)){
		    	$this->success("入库成功",url("admin/category/index"));
		    }else{
		    	$this->error("入库失败");
		    }
		}
		$cat_id = input('cat_id');
		$data = $catModel->find($cat_id);
		$cats = $catModel->getSonsCat();
		return $this->fetch('',[
			'data' => $data, 
			'cats' => $cats
		]);
	}
	public function ajaxdel($value=''){
		if(request()->isAjax()){
			$goods_id = input('goods_id');
			// halt($cat_id);
			//$catModel = Category::where('pid','eq',$cat_id)->find();
			
			// if($catModel){
			// 	return json(['code'=>-211,'message'=>'不能删除非叶子名称']);
			// }	
				
				if(Goods::destroy($goods_id)){
					return json(['code'=>200,'message'=>'删除成功']);
				}else{
					return json(['code'=>-221,'message'=>'删除失败']);
				}
			
		}
	}
}