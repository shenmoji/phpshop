<?php 
namespace app\admin\validate;
use think\Validate;
class Goods extends Validate{
	protected $rule = [
		'goods_name' => 'require|unique:goods',
		'goods_price' => 'require',
		'goods_number' => 'require|regex:\d+',
		'cat_id' => 'require'
	];
	protected $message = [
		'goods_name.require' => '商品名称必填',
		'goods_price.require' => '价格必填',
		'goods_number.require' => '库存必填',
		'cat_id.require' => '请先选择一个分类',
		'goods_name.unique' => '商品名称重复',
		'goods_number.regex' => '库存数量必须大于0',
	];
	protected $scene = [
		'add' => ['goods_name','goods_price','goods_number','cat_id']
	];
}