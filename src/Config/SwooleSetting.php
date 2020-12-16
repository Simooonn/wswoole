<?php
/**
 * Created by PhpStorm.
 * User: liuning
 * Date: 2018/4/9
 * Time: 11:35
 */

namespace HashyooSwoole\Config;

use Illuminate\Contracts\Container\Container;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;

class SwooleSetting
{
    protected $config;

    /**
     * HTTP server manager constructor.
     *
     *
     * @throws \Exception
     */
    public function __construct()
    {
        $this->config = App::make('config')->get('hashyoo_wswoole');
    }


    /**
     * host
     * 主机
     *
     * @return string
     * @author wumengmeng <wu_mengmeng@foxmail.com>
     */
    public function wswoole_host(){
        return Arr::get($this->config, 'server.host');
    }

    /**
     * port
     * 端口
     * @return int
     * @author wumengmeng <wu_mengmeng@foxmail.com>
     */
    public function wswoole_port(){
        return Arr::get($this->config, 'server.port');
    }


    public function wswoole_is_daemon(){
        return Arr::get($this->config, 'server.options.daemonize');
    }

    public function wswoole_reactor_num(){
        return Arr::get($this->config, 'server.options.reactor_num');
    }

    public function wswoole_worker_num(){
        return Arr::get($this->config, 'server.options.worker_num');
    }

    public function wswoole_task_worker_num(){
        return Arr::get($this->config, 'server.options.task_worker_num');
    }

    public function wswoole_max_request(){
        return Arr::get($this->config, 'server.options.max_request');
    }

    public function wswoole_log_file(){
        //ROOT_PATH . 'storage\\logs\\swoole.log'
        return Arr::get($this->config, 'server.options.log_file');
    }

    public function wswoole_pid_file(){
        return Arr::get($this->config, 'server.options.pid_file');
    }

    public function wswoole_tables(){
        return Arr::get($this->config, 'tables');
    }
//    /* 是否开启 websocket */
//    public function websocket_enabled(){
//        return Arr::get($this->config, 'websocket.enabled', true);
//    }
//
//    /* 是否开启访问日志 */
//    public function access_log(){
//        return Arr::get($this->config, 'server.access_log', false);
//    }

}

