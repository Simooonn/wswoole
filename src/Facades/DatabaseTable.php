<?php

namespace HashyooSwoole\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static  table()
 * @method static  set()
 * @method static  incr()
 * @method static  decr()
 * @method static  get()
 * @method static  exist()
 * @method static  count()
 * @method static  del()
 *
 * @see \HashyooSwoole\Table\DatabaseTable
 */
class DatabaseTable extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'DatabaseTable';
    }
}
