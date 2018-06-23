<?php 
namespace app\admin\model;
use think\Model;
use think\Db;
use app\admin\validate;
class Goods extends Model{
	protected $pk = 'goods_id';
	protected $autoWriteTimestamp = true;
	protected static function init(){
		Goods::event('before_insert',function($goods){
			//$goods表单提交过来的数据对象
			$goods['goods_sn'] = date('ymdhis').uniqid();// 生成唯一的货号
			$goods['add_time'] = time();
		});
		Goods::event('after_insert',function($goods){
			//$goods入库成功后的对象
			$postData = input('post.');
			$goodsAttrValue = $postData['goodsAttrValue']; //获取提交过来的属性值
			$goodsAttrPrice = $postData['goodsAttrPrice'];//获取提交过来的属性价格
			$goods_id = $goods['goods_id']; //获取商品入库成功后的主键goods_id
			//把商品值和价格入库到商品属性表sh_goods_attr中
			foreach($goodsAttrValue as $attr_id=>$attr_values){
				//如果属性值$attr_values是一个数组，说明是单选属性
				if(is_array($attr_values)){
					//单选属性进入这里
					foreach($attr_values as $k => $single_attr_value){
						$data = [
							'goods_id' => $goods_id,
							'attr_id' => $attr_id,
							'attr_value'=> $single_attr_value,
							'attr_price'=> $goodsAttrPrice[$attr_id][$k],
							'create_time' => time(),
							'update_time' => time()
						];
						//进行入库操作
						Db::name('goods_attr')->insert($data);
					}
				}else{
					//唯一属性进入这里
					$data = [
						'goods_id' => $goods_id,
						'attr_id' => $attr_id,
						'attr_value' =>$attr_values,
						'create_time' => time(),
						'update_time' => time()
					];
					//进行入库操作
					Db::name('goods_attr')->insert($data);
				}
			}
		});
	}
	public function uploadImg(){
		$goods_img = [];
		$files = request()->file('img');
		if( $files ){
			//定义上传文件的要求
			$condition = ['size' => 10*1024*1024,'ext'=>'jpg,gif,png,jpeg']; 
			//定义上传文件的目录
			$uploadDir = './upload/';
			//由于是多图,需要循环上传
			foreach($files as $file){
				//判断是否满足上传的要求,只上传满足添加的即可,不满足的不用管
				$info = $file->validate($condition)->move($uploadDir);
				if( $info ){
					$goods_img[] = str_replace('\\','/',$info->getSaveName());
				}
			}
		}
		return $goods_img;
	}

	
	public function thumbImg($goods_img){
		$middle = []; //用于存储中图 350*350
		$small = []; // 存小图 50*50
		//循环缩放 中图
		foreach($goods_img as $path){
			//炸开原图
			$path_arr = explode('/',$path);
			$middle_path = $path_arr[0].'/middle_'.$path_arr[1];
			//打开需要处理的原图
			$image = \think\Image::open('./upload/'.$path);
			//保存350*350 到指定路径
			$image->thumb(350,350,2)->save('./upload/'.$middle_path);
			$middle[] = $middle_path;
		}
		//循环缩放小图 
		foreach($goods_img as $path){
			$path_arr = explode('/',$path);
			$small_path = $path_arr[0].'/small_'.$path_arr[1];
			//打开需要处理的原图片
			$image = \think\Image::open('./upload/'.$path);
			//保存50*50到一个指定路径
			$image->thumb(50,50,2)->save('./upload/'.$small_path);
			$small[] = $small_path;
		}
		return ['middle'=>$middle,'small'=>$small];
	}
}