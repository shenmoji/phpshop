<?php 
namespace app\home\validate;
use think\Validate;
class Order extends Validate{
	protected $rule = [
		'receiver' => 'require',
		'address' => 'require',
		'tel' => 'require',
		'zcode' => 'require',
	];
	protected $message = [
		'receiver.require' => '请输入收货人',
		'address.require'=> "请输入收货地址",
		'tel.require' => '请输入联系电话',
		'zcode.require' => '请输入邮编',
	];
	protected $scene = [
		'add' => ['tel','address','receiver','zcode'],
	];
}