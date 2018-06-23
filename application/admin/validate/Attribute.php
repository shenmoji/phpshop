<?php 
namespace app\admin\validate;
use think\Validate;
class Attribute extends Validate{
	protected $rule = [
		'type_id' => 'require',
		'attr_name' => 'require',
		'attr_input_type' => 'require',
		'attr_values' => 'require',
		'attr_type' => 'require',
	];
	protected $message = [
		'type_id.require' => '请输入类型',
		'attr_input_type.require'=> "请输入属性录入方式",
		'attr_name.require' => '请输入属性名称',
		'attr_type.require' => '请输入属性类型',
		'attr_values.require' =>'请输入属性值'
	];
	protected $scene = [
		'add' => ['type_id','attr_name','attr_type','attr_input_type','attr_values'],
		'ding' => ['type_id','attr_name','attr_type','attr_input_type'],
		
		'upd' => ['type_id','attr_name','attr_type','attr_input_type','attr_values'],
	];
}