<?php
/**
 * Created by PhpStorm.
 * User: huolian
 * Date: 2018/6/14
 * Time: 上午11:23
 */

namespace App\Models;

use App\Models\BasicModel;

class Eloquent extends BasicModel
{
    protected $date = ['deleted_at'];
    protected $table = 'test';
    public function index()
    {
        return self::hasOne('App\Models\Test');
    }
}