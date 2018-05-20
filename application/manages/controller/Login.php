<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 2018/3/19
 * Time: 10:54
 */

namespace app\manages\controller;


use think\Controller;
use think\Db;
use think\Session;

class Login extends Controller
{
//    登录验证
    public function login()
    {
        if (request()->isPost())
        {
            $ins = input('post.');
            $sql = Db::table('admins')->where('nicks',$ins['nickname'])->find();
            if (!$sql)
            {
                $this->error('用户名密码错误！','login/login');
            }elseif (md5($ins['password']) == $sql['passwd'])
            {
//                return '登录成功！';

//                halt($sql);
                Session::set('name',$sql);
//                halt(Session::get('name'));
                $this->success('登录成功！','usermanage/users');
            }else{
                $this->error('用户名密码错误！','login/login');
//                return '用户名密码错误!';
            }
        }

        return $this->fetch();
    }

//登录退出
    public function signout()
    {
        session(null);
        $this->redirect('login');
    }
}