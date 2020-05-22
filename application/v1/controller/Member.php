<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/5/14 0014
 * Time: 14:50
 */
namespace  app\v1\controller;

use think\Controller;
use think\Db;
use app\v1\controller\Base;

class Member extends Base {

    protected $table ='users';

    public function index(){
        $data = Db::name($this->table)->where(['status'=>1,'role'=>1])->order('id desc')->paginate(15);
        $this->assign('data',$data);
        return $this->fetch();
    }

    public function add(){
       if($this->request->isPost()){
           $data['users'] = input('post.users','','trim');
           $data['pwd']   = md5(input('post.pwd','','trim'));
           $data['role']   =input('post.role');
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
        if($this->request->isGet()){
            $mid = input('get.mid','','int');
            if(empty($mid) || !isset($mid)){
                return false;
            }
            $infos = Db::name($this->table)->where(['id'=>$mid,'role'=>1,'status'=>1])->find();
            $this->assign('infos',$infos);
            return $this->fetch();
        }

        if($this->request->isPost()){
            $mid = input('post.mid');
            $data['users'] = input('post.users','','trim');
            $data['pwd']   = input('post.pwd','','trim');
            $data['role']  = input('post.pwd','','trim');
            if(empty($mid) || !isset($mid)){
                return false;
            }
            $info = Db::name($this->table)
                ->where(['id'=>$mid])
                ->update(['users'=>$data['users'],'pwd'=>md5($data['pwd'])]);

            if($info !== false){
                return json(['code'=>200,'msg'=>'修改成功']);
            }else{
                return json(['code'=>400,'msg'=>'修改失败']);
            }
        }
         return  false;
    }


    public function del(){
        if($this->request->isGet()){
            $mid = input('get.mid');
            if(empty($mid) || !isset($mid)){
                return false;
            }
            $infos = Db::name($this->table)->where(['id'=>$mid,'role'=>1])->update(['status'=>0]);

            if($infos !== false){
                return json(['code'=>200,'msg'=>'删除成功']);
            }else{
                return json(['code'=>400,'msg'=>'删除失败']);
            }

        }
        return  false;
    }
}