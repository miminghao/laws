<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 2018/3/17
 * Time: 10:24
 */

namespace app\index\controller;


class Login extends Common
{
    public function login()
    {
        return $this->fetch();
    }

    public function register()
    {
        return $this->fetch();
    }
}