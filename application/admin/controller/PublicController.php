<?php  
namespace app\admin\controller;
use think\Controller;
use app\admin\model\User;
class PublicController extends Controller{
	public function login(){
		if(request()->isPost()){
			$postData = input('post.');
			//调用验证器
			$result = $this->validate($postData,"User.login",[],true);
			if($result !== true){
				$this->error(implode(',',$result));
			}
			//调用查询
			$userModel = new User();
			if($userModel->checkUser($postData['username'],$postData['password'])){
				$this->redirect("admin/index/index");
			}else{
				$this->error("用户名或密码错误或被封号");
			}
		}
		return $this->fetch('');
	}
	public function logout(){
		session('username',null);
		$this->redirect("admin/public/login");
	}
}