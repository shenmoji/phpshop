<?php 
namespace app\admin\controller;
use app\admin\model\Auth;
use app\admin\validate;
class AuthController extends CommonController{
	public function add(){
		if(request()->isPost()){
			$postData = input('post.');
			if($postData['pid'] == 0){
				$result = $this->validate($postData,'Auth.ding',[],true);
			}else{
				$result = $this->validate($postData,'Auth.add',[],true);
			}
			if($result !== true){
				$this->error(implode(',',$result));
			}
			$authModel = new Auth();
			if($authModel->save($postData)){
				$this->success("添加成功",url("admin/auth/index"));
			}else{
				$this->error("添加失败");
			}
		}
		$authModel = new Auth();
		$auths = $authModel->getAuthsSon();
		return $this->fetch('',[
			'auths' => $auths
		]);
	}
	public function index(){
		$auth = new Auth();
		$lists = $auth->getAuthsSon();
		return $this->fetch("",[
			'lists' => $lists
		]); 
	}
	public function upd(){
		$auth = new Auth();
		if(request()->isPost()){
			$postData = input('post.');
			if($postData['pid'] == 0){
				$result = $this->validate($postData,'Auth.ding',[],true);
			}else{
				$result = $this->validate($postData,'Auth.upd',[],true);
			}
			if($result !== true){
				$this->error(implode(',',$result));
			}
			if($auth->isUpdate(true)->save($postData)){
				$this->success('编辑成功',url("admin/auth/index"));
			}else{
				$this->error("编辑失败");
			}
		}
		$auth_id = input('auth_id');
		$data = $auth->find($auth_id);
		$auths = $auth->getAuthsSon();

		return $this->fetch('',[
			'data' => $data, 
			'auths' => $auths
		]);
	}
	public function del(){

		$auth_id = input("auth_id");
		$auth_pid = new Auth();
		$auth_ad = Auth::find($auth_id);
		if($auth_ad['auth_c'] == '' && $auth_ad['auth_a'] == ''){
			$this->error("此权限不是叶子权限 请勿删除!");
		}
		// halt($auth_id);
		$result = Auth::destroy($auth_id);
		if($result){
			$this->success("删除成功",url('admin/auth/index'));
		}else{
			$this->error("删除失败");
		}
	}
}