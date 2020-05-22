<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/5/23
 * Time: 0:22
 */
namespace  app\v1\controller;

use think\Controller;
use think\Db;
use app\v1\controller\Base;

class Xiao extends Base {

    protected $table ='users';

    public function index(){
        $data = Db::name($this->table)->where(['status'=>1,'role'=>2])->order('id desc')->paginate(15);
        $this->assign('data',$data);
        return $this->fetch();
    }

    public function add(){
        if($this->request->isPost()){
            $data['users'] = input('post.users','','trim');
            $data['pwd']   = md5(input('post.pwd','','trim'));
            $data['rep_relname'] = input('post.relname','','trim');
            $data['rep_email'] = input('post.email','','trim');
            $data['rep_region'] = input('post.region','','trim');
            $data['rep_tel'] = input('post.tel','','trim');
            $data['role']  =2;
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
            $infos = Db::name($this->table)->where(['id'=>$mid,'role'=>2])->where('status',1)->find();
            $this->assign('infos',$infos);
            return $this->fetch();
        }

        if($this->request->isPost()){
            $mid = input('post.mid');
            $data['users'] = input('post.users','','trim');
            $data['pwd']   = md5(input('post.pwd','','trim'));
            $data['rep_relname'] = input('post.relname','','trim');
            $data['rep_email'] = input('post.email','','trim');
            $data['rep_region'] = input('post.region','','trim');
            $data['rep_tel'] = input('post.tel','','trim');
            $data['role']  =2;
            if(empty($mid) || !isset($mid)){
                return false;
            }
            $info = Db::name($this->table)
                ->where(['id'=>$mid,'role'=>2])
                ->update($data);

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
            $infos = Db::name($this->table)->where(['id'=>$mid,'role'=>2])->update(['status'=>0]);

            if($infos !== false){
                return json(['code'=>200,'msg'=>'删除成功']);
            }else{
                return json(['code'=>400,'msg'=>'删除失败']);
            }

        }
        return  false;
    }
}