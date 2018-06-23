<?php 
namespace app\home\validate;
use think\Validate;
class Member extends Validate{
	protected $rule = [
		'username' => 'require|unique:member',
		'password' => 'require',
		'email' => 'require',
		'captcha'=>"require|captcha:3",
		'phone' => 'require|unique:member',
		'repassword' => 'require|confirm:password'
	];
	protected $message = [
		'username.require' => '用户名称必填',
		'captcha.require' => '验证码必填',
		'phone.require' => '手机号必填',
		'phone.unique' => '手机号已注册',
		'captcha.captcha' => '验证码错误',
		'password.require' => '密码必填',
		'email.require' => '邮箱必填',
		'repassword.require' => '请再次输入密码',
		'username.unique' => '用户名重复',
		'repassword.confirm' => '二次密码不一致',
	];
	protected $scene = [
		'register' => ['username','password','email','repassword'],
		'login' => ['username'=>"require",'password'=>"require",'captcha'],
		'upd' => ['username'=>"require",'password'=>"require",'repassword'=>"require"],
		'mima' => ['password'=>"require",'repassword'=>"require"],
		'sms' => ['phone'],
		'email' => ['email'],
	];
}