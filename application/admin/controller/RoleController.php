<?php 
namespace app\admin\controller;
use app\admin\model\Role;
use app\admin\model\Auth;
use think\Db;
use app\admin\validate;
class RoleController extends CommonController{
	public function add(){
		if(request()->isPost()){
			$postData = input('post.');
			$result = $this->validate($postData,'Role.add',[],true);
			if($result !== true){
				$this->error(implode(',',$result));
			}
			$roleModel = new Role();
			if($roleModel->save($postData)){
				$this->success("添加成功",url("admin/role/index"));
			}else{
				$this->error("添加失败");
			}
		}
		//取出所有的权限
		$authModel = new Auth();
		$authData = $authModel->select()->toArray();
		/*  循环所有的权限*以auth_id为每个元素的下标  */
		$auths = [];
		foreach($authData as $auth){
			$auths[ $auth['auth_id'] ] = $auth;
		}

		/*  循环所有的权限* 通过pid进行划分为同一组  */
		$children = [];
		foreach($authData as $auth){
			$children[ $auth['pid'] ][] = $auth['auth_id'];
		}
		/*   输出模板*分配数据    */
		return $this->fetch('',[
			'auths' => $auths,
			'children' => $children
		]);
	}
	public function index(){
		$sql = "SELECT t1.*, GROUP_CONCAT(t2.auth_name SEPARATOR '|') all_auth FROM sh_role t1 LEFT JOIN sh_auth t2 ON FIND_IN_SET(t2.auth_id, t1.auth_id_list) GROUP BY t1.role_id";
		//执行原生的sql语句
		$lists = Db::query($sql);
		return $this->fetch('',['lists' => $lists]);
	}
	public function upd(){
		$authModel = new Auth();
		$roleModel = new Role();
		$role_id = input('role_id');
		//查询出所有的权限
		$authsData = $authModel->select()->toArray();
		//把$authsData的每个元素的auth_id为下标
		$auths = [];
		foreach($authsData as $auth){
			$auths[ $auth['auth_id'] ] = $auth;
		}
		//把$authsData的每个元素进行pid分组
		$children = [];
		foreach($authsData as $auth){
			//后面要加(), 不然会被覆盖
			// dump($auth);
			$children[ $auth['pid'] ][] = $auth['auth_id'];
		}
		$data = $roleModel->find($role_id);
		if(request()->isPost()){
			$roleData = input('post.');
			//halt($roleData);
			$result = $this->validate($roleData,'Role.upd',[],true);
			if($result !== true){
				$this->error(implode(',',$result));
			}
			$roleData['auth_id_list'] = implode(',',$roleData['auth_id_list']);
			// halt($roleData);
			$role = $roleModel->isUpdate(true)->save($roleData);
			// halt($role);
			if($role){
				$this->success("更新成功",url('admin/role/index'));
			}else{
				$this->error("更新失败,请重试");
			}
		}
		// dump($roleModel);
		// halt($children);
		return $this->fetch('',[
			'data' => $data, 
			'auths' => $auths, 
			'children' => $children
		]);
	}
	public function del(){
		
		$role_id = input("role_id");

		$result = Role::destroy($role_id);
		if($result){
			$this->success("删除成功",url('admin/auth/index'));
		}else{
			$this->error("删除失败");
		}
	}

	
}