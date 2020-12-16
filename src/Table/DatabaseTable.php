<?php

namespace HashyooSwoole\Table;

use Illuminate\Support\Facades\App;
use Swoole\Table;

class DatabaseTable
{
    private $table = null;
    public function table($table = ''){
        $this->table =  App::make(SwooleTable::class)->get($table);
        return $this;
    }


    /**
     *
     *
     * @param string $key
     * @param array  $value
     *
     * @return bool
     * @author wumengmeng <wu_mengmeng@foxmail.com>
     */
    public function set(string $key, array $value):bool
    {
        if(is_null($this->table)){
            return false;
        }
        return $this->table->set($key,$value);
    }

    public function incr(string $key, string $column, int $incrby = 1): int
    {
        if(is_null($this->table)){
            return 0;
        }
        return $this->table->incr( $key,  $column,  $incrby);
    }

    public function decr(string $key, string $column, int $incrby = 1): int
    {
        if(is_null($this->table)){
            return 0;
        }
        return $this->table->decr( $key,  $column,  $incrby);
    }



    /**
     *
     *
     * @param string      $key
     * @param string|null $field
     *
     * @return array|false
     * @author wumengmeng <wu_mengmeng@foxmail.com>
     */
    public function get(string $key, string $field = null)
    {
        if(is_null($this->table)){
            return false;
        }
        return $this->table->get($key,$field);
    }

    /**
     *
     *
     * @param string $key
     *
     * @return bool
     * @author wumengmeng <wu_mengmeng@foxmail.com>
     */
    public function exist(string $key): bool
    {
        if(is_null($this->table)){
            return false;
        }
        return $this->table->exist($key);
    }

    /**
     *
     *
     * @return int
     * @author wumengmeng <wu_mengmeng@foxmail.com>
     */
    public function count(): int
    {
        if(is_null($this->table)){
            return 0;
        }
        return $this->table->count();
    }

    /**
     *
     *
     * @param string $key
     *
     * @return bool
     * @author wumengmeng <wu_mengmeng@foxmail.com>
     */
    public function del(string $key): bool
    {
        if(is_null($this->table)){
            return false;
        }
        return $this->table->del($key);
    }

}
