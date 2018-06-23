<?php 
namespace app\home\controller;
use think\Controller;
use app\home\model\Member;
class MemberController extends Controller{
	public function qqLogin($value=''){
		include "../extend/qqLogin/API/qqConnectAPI.php";
		$qc = new \QC();
		$qc->qq_login();
	}
	public function qqCallback(){
		include "../extend/qqLogin/API/qqConnectAPI.php";
		$qc = new \QC();
		$token = $qc->qq_callback();
		$openid = $qc->get_openid();
		$qc = new \QC($token,$openid);
		$userInfo = Member::where('openid',$openid)->find();
		//判断该用户之前有没有用qq登录过
		// echo $userInfo["data"]['member_id'];
		// halt($userInfo['data']);
		// halt($userInfo);
		if($userInfo){
			session('home_username',$userInfo['username']?$userInfo['username']:$userInfo['nickname']);
			session("member_id",$userInfo['member_id']);
			// halt($member['member_id']);
			$this->redirect('home/index/index');
		}else{
			//没有说明是第一次使用qq登录
			$qqUserInfo = $qc->get_user_info();
			$data = ['openid'=>$openid,'nickname'=>$qqUserInfo['nickname']];
			$member = Member::create($data);
			session('home_username',$member['nickname']);
			session('member_id',$member['member_id']);
			// halt($member['member_id']);
			$this->redirect("home/index/index");
		}
	}
}