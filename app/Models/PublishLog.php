<?php
/**
 * Created by PhpStorm.
 * User: baichou
 * Date: 2018/2/22
 * Time: 18:01
 */

namespace App\Models;


use Universe\Support\Model;

class PublishLog extends Model
{
    public function getAuthor()
    {
        return $this->hasOne(User::class,'id','author');
    }
}