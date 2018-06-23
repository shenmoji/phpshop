<?php  
namespace app\admin\controller;
use app\admin\model\Attribute;
use app\admin\model\Type;
class TypeController extends CommonController{
	public function add(){
		if(request()->isPost()){
		    //接收参数
		    $postData = input('post.');
		    //去除空格
		    // $postData['mark']=trim($postData['mark']);
		    //验证器验证
		    $result = $this->validate($postData,'Type.add',[],true);
		    if($result !== true){
		    	$this->error(implode(',',$result));
		    }
		    //入库
		    $typeModel = new Type();
		    if($typeModel->allowField(true)->save($postData)){
		    	$this->success("入库成功",url("admin/type/index"));
		    }else{
		    	$this->error("入库失败");
		    }
		}
		return $this->fetch('');

	}
	public function index($value=''){
		$typeModel = new Type();
		$lists = $typeModel->select();
		// halt($lists);
		return $this->fetch('',[
			'lists' => $lists
		]);
	}
	public function upd($value=''){
		$TypeModel = new Type();
		$type_id = input('type_id');
		// halt($type_id);
		$data=$TypeModel->find($type_id);
		// halt($data);
		if(request()->isPost()){
		    //接收参数
		    $postData = input('post.');
		    //验证器验证
		    $result = $this->validate($postData,'Type.upd',[],true);
		    if($result !== true){
		    	$this->error(implode(',',$result));
		    }
		    //入库
		   
		    if($TypeModel->isUpdate(true)->save($postData)){
		    	$this->success("入库成功",url("admin/Type/index"));
		    }else{
		    	$this->error("入库失败");
		    }
		}
		return $this->fetch('',[
			'data' => $data
		]);

	}
	public function ajaxdel(){
		if(request()->isAjax()){
			$type_id = input('type_id');
			if(Type::destroy($type_id)){
				return json(['code'=>200,'message'=>'删除成功']);
			}else{
				return json(['code'=>-221,'message'=>'删除失败']);
			}
		}
	}
	public function getAttr($value=''){
		
		$type_id = input('type_id',0,'intval');
		// halt($type_id);
		$lists = Attribute::alias('t1')
					->field('t1.*,t2.type_name')
					->join('sh_type t2','t1.type_id = t2.type_id','left')
					->where('t1.type_id',$type_id)
					->select();
					// halt($lists);
		return $this->fetch('',[
			'lists' => $lists,
		]);
	}
}