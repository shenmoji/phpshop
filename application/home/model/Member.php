<?php 
namespace app\home\model;
use think\Model;

class Member extends Model{
	protected $pk = 'member_id';
	protected $autoWriteTimestamp = true;

	protected static function init(){
		Member::event('before_insert',function($mem){
			//实现注册的密码加密
			if(isset($mem['password'])){
			$mem['password'] = md5($mem['password'].config('password_salt'));
			}
		});
	

		Member::event('before_update',function($mem){
			if(isset($mem['password'])){
				//实现更新密码注册的密码加密
				$mem['password'] = md5($mem['password'].config('password_salt'));
			}
			
			
		});
	}
	//检测用户名和密码是否正确
	public function checkUser($username,$password){
		$condtion = [
			'username' => $username,
			'password' => md5($password.config("password_salt"))
		];
		$userInfo = $this->where($condtion)->find();
		if($userInfo){
			session('home_username',$userInfo['username']);
			session('member_id',$userInfo['member_id']);
			return true;
		}else{
			return false;
		}
	}
}