<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/5/22
 * Time: 17:33
 */
namespace  app\v1\controller;

use think\Controller;
use think\Db;
use think\Request;
use app\v1\controller\Base;

class Goods extends Base {
  protected $table ='goods';

    public function index(){
        $list = Db::name($this->table)->where('status',1)->order('id desc')->paginate(15);
        $this->assign('list',$list);
        return $this->fetch();
    }

   public function add(){
       if($this->request->isPost()){
           $data['imgs'] = input('post.imgs','','trim');
           $data['title']   = input('post.title','','trim');
           $data['dan']   = input('post.dan','','trim');
           $data['type_id']   =input('post.type_id');
           $data['counts']   =input('post.counts');
           $data['create_time']   = time();

           $res = Db::name($this->table)->insertGetId($data);

           if($res !== false){
               return json(['code'=>200,'msg'=>'添加成功']);
           }else{
               return json(['code'=>400,'msg'=>'添加失败']);
           }
       }
       return $this->fetch();
   }

    public function edit(){
        if($this->request->isPost()){
            $data['imgs'] = input('post.imgs','','trim');
            $data['title']   = input('post.title','','trim');
            $data['dan']   = input('post.dan','','trim');
            $data['type_id']   =input('post.type_id');
            $data['counts']   =input('post.counts');
            $data['create_time']   = time();
            $mid = input('post.mid');

            if(empty($mid) || !isset($mid)){
                return false;
            }
            $info = Db::name($this->table)->where(['id'=>$mid])->update($data);

            if($info !== false){
                return json(['code'=>200,'msg'=>'修改成功']);
            }else{
                return json(['code'=>400,'msg'=>'修改失败']);
            }
        }
        $mid = input('get.mid','','int');
        if(empty($mid) || !isset($mid)){
            return false;
        }
        $infos = Db::name($this->table)->where('id',$mid)->where('status',1)->find();
        $this->assign('infos',$infos);
        return $this->fetch();
    }


    public function del(){
        if($this->request->isGet()){

        }
    }

    /**
     * 上传图片
     */
    public function uploadfimgs(){
        // 获取上传文件
        $file =$this->request->file('file');
        // 验证图片,并移动图片到框架目录下。
        $path = ROOT_PATH.'public/uploads/imgs/wen/';

        if(!is_dir($path)){
            mkdir($path,0755,true);
        }

        $info = $file->move($path);
        if($info){
            $mes = $info->getSaveName();
            $mes = str_replace("\\",'/',$mes);
            return json(['code'=>'200','msg'=>'上传成功','path'=>'/uploads/imgs/wen/'.$mes]);
        }else{
            // 文件上传失败后的错误信息
            $mes = $file->getError();
            return json(['code'=>'400','msg'=>$mes]);
        }
    }

}