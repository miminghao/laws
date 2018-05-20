<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 2018/3/14
 * Time: 16:33
 */

namespace app\index\model;


use think\Model;

class Event extends Model
{
    protected function scopeIsdel($query)
    {
        $query -> where('is_del',0);
    }
}