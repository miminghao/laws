<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 2018/3/14
 * Time: 10:31
 */

namespace app\index\model;


use think\Model;

class Users extends Model
{
    protected function scopeIsdel($query)
    {
        $query -> where('is_del',0);
    }
}