<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 2018/3/17
 * Time: 9:47
 */

namespace app\index\controller;


class Lawyers extends Common
{
    public function lawyer()
    {
        return $this->fetch();
    }
}