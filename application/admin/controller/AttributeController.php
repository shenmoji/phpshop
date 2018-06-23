<?php 
namespace app\admin\controller;
use app\admin\model\Type;
use app\admin\model\Attribute;
use think\Controller;
class AttributeController extends CommonController{
	public function add(){
		$typeModel = new Type();
		if(request()->isPost()){
		    //接收参数
		    $postData = input('post.');
		    // halt($postData);
		    if($postData['attr_input_type'] == '0'){
		    	$result = $this->validate($postData,'Attribute.ding',[],true);
		    }else{
		    	//验证器验证
		    	$result = $this->validate($postData,'Attribute.add',[],true);
		    }
		    
		    if($result !== true){
		    	$this->error(implode(',',$result));
		    }
		    //入库
		    $AttributeModel = new Attribute();
		    if($AttributeModel->allowField(true)->save($postData)){
		    	$this->success("入库成功",url("admin/Attribute/index"));
		    }else{
		    	$this->error("入库失败");
		    }
		}
		$types = $typeModel->select();
		return $this->fetch('',[
			'types' => $types
		]);
	}
	public function index(){
		//方式一:连表取出属性的所属商品类型
		// $lists = Attribute::alias('t1')
		// 		->field('t1.*,t2.type_name')
		// 		->join('sh_type t2','t1.type_id = t2.type_id','left')
		// 		->select();
		//取出属性的所属商品类型	
		$lists = Attribute::select();
		$typeData = Type::select()->toArray();
		//循环$typeData以每个元素的type_id做下标
		$types = [];
		foreach($typeData as $type){
			$types[ $type['type_id'] ] = $type;
		}
		// dump($lists);
		// halt($types);
		return $this->fetch('',[
			'lists' => $lists, 
			'types' => $types
		]);
	}
	public function upd($value=''){
		$attributeModel = new Attribute();
		if(request()->isPost()){
		    //接收参数
		    $postData = input('post.');
		    //验证器验证
		    if($postData['attr_input_type'] == 0){
		    	$result = $this->validate($postData,'Attribute.ding',[],true);
		    }else{
		    	$result = $this->validate($postData,'Attribute.upd',[],true);
		    }
		    
		    if($result !== true){
		    	$this->error(implode(',',$result));
		    }
		    //入库
		   
		    if($attributeModel->allowField(true)->isUpdate(true)->save($postData)){
		    	$this->success("更新成功",url("admin/attribute/index"));
		    }else{
		    	$this->error("更新失败");
		    }
		}
		$attr_id = input('attr_id');
		$data = $attributeModel->find($attr_id);
		$types = Type::select();
		return $this->fetch('',[
			'data'=>$data, 
			'types' => $types
		]);
	}
	public function ajaxdel($value=''){
		if(request()->isAjax()){
			$attr_id = input('attr_id');
			if(Attribute::destroy($attr_id)){
				return json(['code'=>200,'message'=>'删除成功']);
			}else{
				return json(['code'=>-221,'message'=>'删除失败']);
			}
		}
	}
}