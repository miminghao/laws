<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 2018/3/14
 * Time: 17:18
 */

namespace app\index\controller;


class Message extends Common
{
    public function index()
    {
        return $this->fetch();
    }

    /**
     * 交流页面
     * @return mixed
     */
    public function chat()
    {
        return $this->fetch();
    }

    public function chats()
    {
        $qq = input('post.');
//        fopen('111.txt');

        halt( $qq);
    }
}