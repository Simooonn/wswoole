<?php

namespace HashyooSwoole\Common\ModelMongodb;

use Jenssegers\Mongodb\Eloquent\Model;
class BaseMongo extends Model
{
    protected $connection='mongodb';//链接数据库方式 mongodb

    public  function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }
}


