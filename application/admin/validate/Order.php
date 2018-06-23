<?php 
namespace app\admin\validate;
use think\Validate;
class Order extends Validate{
	protected $rule = [
		'id' => 'require',
		'company' => 'require',
		'number' => 'require'
	];
	protected $message = [
		'id.require' => '运单单号未获取,请重试',
		'company.require' => '请选择物流公司',
		'number.require' => '运单号必填',
	];
	protected $scene = [
		'wuliu' => ['id','company','number'],
	];
}