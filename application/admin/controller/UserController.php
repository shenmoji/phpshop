<?php 
namespace app\admin\controller; //所在的命名空间
use app\admin\model\User;
use app\admin\model\Role;
use think\Controller;
class UserController extends CommonController {

    public function add(){
    	if(request()->isPost()){
    		//1、接收参数
    	 	$postData = input('post.');
    	 	//2、验证器验证
    	 	$result = $this->validate($postData,'User.add',[],true);
    	 	if($result !== true){
    	 		$this->error(implode(',',$result));
    	 	}
    	 	//3、入库
    	 	$userModel = new User();
    	 	//模型中入库前钩子实现
    	 	//$postData['password'] = md5($postData['password'].config('password_salt'));
    	 	if($userModel->allowField(true)->save($postData)){
    	 		//入库成功
    	 		$this->success("入库成功",url("admin/user/index"));
    	 	}else{
    	 		//入库失败
    	 		$this->error("入库失败");
    	 	}
    	}
        $appd = new Role;
        $appdd =$appd->select()->toArray();
       // halt($appdd);
    	return $this->fetch('',[
            'appdd'=>$appdd
        ]);
    }

    public function index(){
    	/*$lists = User::alias('t1')
                ->field('t1.*,t2.role_name')
                ->join("sh_role t2",'t1.role_id=t2.role_id','left')
                ->paginate(5);*/
            $lists = User::paginate(5);
            $roleData = Role::select();
            $roles = [];
            foreach($roleData as $role){
                $roles[$role['role_id']] = $role;
            }

         // halt($lists);
        
    		return $this->fetch('',['lists'=>$lists,'roles'=>$roles]);
    	
    }
    public function upd(){
    	if(request()->isPost()){
    		$postData = input('post.');
    		$result = $this->validate($postData,'User.upd',[],true);
    		if($result!==true){
    			$this->error(implode(',',$result));
    		}
    		$userModel = new User();
    		if($userModel->allowField(true)->isUpdate(true)->save($postData)!==false){
    			$this->success("编辑成功",url('admin/user/index'));
    		}else{
    			$this->error("编辑失败");
    		}
    	}
    	$user_id = input('user_id');
        $appd = new Role;
        $appdd =$appd->select()->toArray();
    	$data = User::find($user_id);
    	return $this->fetch('',[
            'data'=>$data, 
            'appdd' =>$appdd
        ]);
    }
    public function ajaxchangeActive(){
    	if(request()->isAjax()){
    		$is_active = input('is_active');
    		$user_id = input('user_id');
    		$update_active = $is_active?0:1;
    		$data = [
    			'is_active' => $update_active,
    			'user_id' => $user_id
    		];
    		$userModel = new User();
    		if($userModel->update($data)!==false){
    			return json(['status'=>200,'is_active'=>$update_active]);
    		}else{
    			return json(['status'=>-1,'is_active'=>$update_active]);
    		}
    	}
    }
    public function del(){
        $postData = input('user_id');
        // halt($postData);
        $use = User::destroy($postData);
        // halt($use);
        if($use){
            $this->success("删除成功",url('admin/user/index'));
        }else{
            $this->error("删除失败 请重试");
        }
        
    }
    public function ajaxDelCat(){
        if(request()->isAjax()){
            $user_id = input('user_id');
            // halt($user_id);
            if(User::destroy($user_id)){
                return json(['code'=>'200','message'=>'删除成功']);
            }else{
                return json(['code'=>'-1','message'=>'删除失败']);
            }
        }
    }
   

}