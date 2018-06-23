<?php 
namespace app\admin\validate;
use think\Validate;
class Role extends Validate{
	protected $rule = [
		'role_name' => 'require|unique:role',
	];
	protected $message = [
		'role_name.require' => '角色名称必填',
		'role_name.unique' => "角色名称重复",
	];
	protected $scene = [
		'add' => ['role_name'],
		'upd' => ['role_name'],
	];
}