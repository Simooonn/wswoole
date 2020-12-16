<?php

namespace HashyooSwoole\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static  wswoole_host()
 * @method static  wswoole_port()
 * @method static  wswoole_is_daemon()
 * @method static  wswoole_reactor_num()
 * @method static  wswoole_worker_num()
 * @method static  wswoole_task_worker_num()
 * @method static  wswoole_max_request()
 * @method static  wswoole_log_file()
 * @method static  wswoole_pid_file()
 * @method static  wswoole_tables()
 *
 * @see \HashyooSwoole\Config\SwooleSetting
 */
class SwooleSetting extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'SwooleSetting';
    }
}
