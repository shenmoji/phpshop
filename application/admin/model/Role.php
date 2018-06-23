<?php 
namespace app\admin\model;
use think\Model;
class Role extends Model{
	protected $pk = 'role_id';
	protected $autoWriteTimestamp = true;
	protected static function init(){
		Role::event('before_insert',function($role){
			$role['auth_id_list'] = implode(',',$role['auth_id_list']);
		});
	}
	public function getone($id){
		return $this->where(['role_id'=>$id])->find();
	}
}