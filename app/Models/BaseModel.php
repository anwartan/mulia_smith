<?php

namespace App\Models;

use App\Builder\RedisQueryBuilder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Redis;

abstract class BaseModel extends Model
{   

    protected $redis = false;

    public function save(array $options = [])
    {
        $result = parent::save($options);
        if(!$this->redis) {
            return $result;
        }

        if ($result) {
            Redis::set($this->getRedisKey(), $this->toJson());
        }

        return $result;
    }

    public function delete()
    {
        $result = parent::delete();

        if ($result) {
            Redis::del($this->getRedisKey());
        }

        return $result;
    }

    protected function getRedisKey() {
        
        return "$this->table:$this->id";
    }

    public function newEloquentBuilder($query)
    {
        return new RedisQueryBuilder($query); 
    }

    protected $apiCasts = [];

    public function toArray()
    {
        if (request()->is('api/*')) {
            $this->casts = $this->apiCasts;
        }

        return parent::toArray();
    }
}
