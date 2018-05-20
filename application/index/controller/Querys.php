<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 2018/3/14
 * Time: 14:23
 */

namespace app\index\controller;


use think\Db;

class Querys extends Common
{
    public function index()
    {
        return $this->fetch();
    }

    /**
     * 对应查询
     */
    public function seek()
    {
        $que = input('post.');
        $sql = Db::table('laws')->where($que)->select();
        return json_encode($sql);
    }
}