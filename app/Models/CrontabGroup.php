<?php
/**
 * Created by PhpStorm.
 * User: baichou
 * Date: 2018/2/22
 * Time: 18:01
 */

namespace App\Models;


use Universe\Support\Model;

class CrontabGroup extends Model
{
    public function getAuthor()
    {
        return $this->hasOne(User::class,'id','author');
    }

    public function getEnvList()
    {
        return $this->belongsToMany(Environment::class,CrontabGroupEnv::class,'env_id','group_id');
    }
}