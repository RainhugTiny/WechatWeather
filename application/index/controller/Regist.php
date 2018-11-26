<?php
namespace app\index\controller;
 
use think\Controller;
class Regist extends Controller{
      public function index()
      {
        return $this->fetch();
      }
      public function regist()
    {
      $id=input("post.user_id");
      $name=input("post.user_name");
      $password=input("post.user_pwd");
      if(empty($name)){
    	$this->error('用户名不能为空');
      }
      if(empty($password)){
    	$this->error('密码不能为空');
      }
          	
      // 验证用户名
      $has = db('users')->where('user_name', $name)->find();
      if(!empty($has)){
        $this->error('用户名已存在');
      }
      $user=['user_name'=>$name,'user_pwd'=>md5($password)];
      $ok=db('users')->insert($user);
      // 记录用户登录信息
      cookie('user_name', $name, 3600);  // 一个小时有效期
      echo "您好： " . cookie('user_name') . ', <a href="' . url('login/index') . '">请登陆</a>';
    }
}