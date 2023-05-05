<?php

namespace App\Builder;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Redis;

class RedisQueryBuilder extends Builder
{

    protected $useRedis = false;
    protected $redisKey;
    protected $redisTtl;

    public function remember($key = null, $ttl = null)
    {
        $this->useRedis = true;
        $this->redisKey = $key;
        $this->redisTtl = $ttl;
        return $this;
    }

    public function get($columns = ['*'])
    {
        if ($this->useRedis) {
            $cached = Redis::get($this->redisKey);
            if ($cached !== null) {
                return unserialize($cached);
            }
        }

        $results = parent::get($columns);
        if(empty($this->redisKey)) {
            $generateKey = $this->generateKey();
        } else {
            $generateKey = $this->redisKey;
        }

        if ($this->useRedis) {
            $ttl = $this->redisTtl ?: config('cache.ttl');
            if(is_null($ttl)) {
                Redis::setex($generateKey, $ttl, serialize($results));
            }else {
                Redis::set($generateKey, serialize($results));
            }
            $this->useRedis = false;
        }

        return $results;
    }

    protected function generateKey()
    {
        return 'query:' . md5($this->toSql() . serialize($this->getBindings()));
    }
}
