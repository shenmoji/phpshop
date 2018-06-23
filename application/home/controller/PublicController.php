<?php  
namespace app\home\controller;
use think\Controller;
use app\home\model\Member;
//use app\home\validate;
class PublicController extends Controller{
	//注册
	public function register(){
		if(request()->isPost()){
		    //接收参数
		    $postData = input('post.');
		    //验证器验证
		    $result = $this->validate($postData,'Member.register',[],true);
		    if($result !== true){
		    	$this->error(implode(',',$result));
		    }
		    if(md5($postData['phoneCaptcha'].config('sms_salt'))!==cookie('sms') ){
		    	$this->error("手机验证码输入错误");
		    }
		    //入库
		    $memModel = new Member();
		    if($memModel->allowField(true)->save($postData)){
		    	$this->success("入库成功",url("home/public/login"));
		    }else{
		    	$this->error("入库失败");
		    }
		}
		return $this->fetch('');
	}
	//手机号
	public function sendSms(){
		if(request()->isAjax()){
			$phone = input('phone');

			$result = $this->validate(['phone'=>$phone],'Member.sms',[]);
			if($result !== true){
				return json(['code'=>-1,'message'=>$result]);
			}
			$rand = mt_rand(1000,9999);
			$sms = md5($rand.config('sms_salt'));
			cookie('sms',$sms,300);
			return sendSms($phone,array($rand,5),'1');
		}
		// sendSms('18674085233',array('221',5),1);
	}
	//登录
	public function login(){
		if(request()->isPost()){
		    //接收参数
		    $postData = input('post.');
		    // halt($postData);
		    //验证器验证
		    $result = $this->validate($postData,'Member.login',[],true);
		    if($result !== true){
		    	$this->error(implode(',',$result));
		    }
		    //入库
		    $menModel = new Member();
		    $static = $menModel->checkUser($postData['username'],$postData['password']);
		    // halt($static);
		    if($static){
		    	if(input('return_url')){
		    		$this->redirect('home/goods/detail?goods_id='.input("return_url"));
		    	}
		    	$this->redirect("home/index/index");
		    }else{
		    	$this->error("登录失败,请检查用户名或密码");
		    }
		}
		return $this->fetch('');
	}
	//退出
	public function logon($value=''){
		session('home_username',null);
		session('member_id',null);
		$this->redirect("home/public/login");
	}
	//邮箱
	public function testEmail(){
		dump( sendEmail('2321123809@qq.com','端午节快乐','吃粽子') );
	}
	//密码找回
	public function findEmail(){
		if(request()->isAjax()){
		    //接收参数
		    $email = input('email');
		    // $captcha = input('captcha');,'captcha'=>$captcha
		    // halt($email);
		    //验证器验证
		    $result = $this->validate(['email'=>$email],'Member.email',[]);
		    if($result !== true){
		    	$this->error($result);
		    }
		    $time=time();
		   
		    $title='php15商城修改密码';
		    
		    if( $userInfo = Member::where('email',$email)->find() ){
 				$member_id = $userInfo['member_id'];
  				$hash = md5($member_id.$time.config('email_salt'));
		    	$href = $_SERVER['REQUEST_SCHEME']."://".$_SERVER['SERVER_NAME']."/home/public/updpassword/member_id/".$userInfo['member_id'].'/time/'.$time.'/hash/'.$hash; 
		    	$content = "<a href='{$href}'>点我修改密码</a>";

		    	
		    	// dump( sendEmail($email,'端午节快乐','吃粽子') );
		    	if(sendEmail($email,$title,$content)){
		    		return json(['code'=>200,'message'=>"邮箱已发送 请查收"]);
		    	}else{
		    		return json(['code'=>-21,'message'=>"邮箱发送失败,请联系管理员"]);
		    	}

		    }else{
		    	return json(['code'=>-2,'message'=>"邮箱不存在"]);
		    }
		    
		}
		return $this->fetch('');
	}
	//更新密码
	public function updPassword(){
		
		if( request()->isAjax() ){
			$postData = input('post.');
			// halt($postData);
			$result = $this->validate($postData,'Member.mima',[],true);
			if($result !== true){
				$this->error(implode(',', $result));
			}
			
			$memModel = new Member();
			if($memModel->isUpdate(true)->allowField(true)->save($postData)!==false){
				return json(['code'=>200,'message'=>"更新成功,转到登录页面"]);
			}else{
				return json(['code'=>-1,'message'=>"更新成功"]);
			}
		}
		$member_id = input('member_id');
		$oldtime = input('time');
		$hash = input('hash');
		// dump($oldtime );exit;
		if(md5( $member_id.$oldtime.config('email_salt')) !== $hash ){
			exit("无效的链接地址,你对地址干了什么?");
		}
		//有效期420s
		if($oldtime+420<time()){
			exit("早干嘛去了,现在才来,没用了");
		}
		return $this->fetch('',
			['member_id'=>$member_id]);
	}
}