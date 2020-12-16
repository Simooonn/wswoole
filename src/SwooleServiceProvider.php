<?php

namespace HashyooSwoole;

use HashyooSwoole\Facades\SwooleSetting;
use HashyooSwoole\Server\PidManager;
use HashyooSwoole\Table\DatabaseTable;
use Illuminate\Support\ServiceProvider;
use HashyooSwoole\Facades\Server;
use HashyooSwoole\Commands\WebsocketCommand;
use Swoole\Websocket\Server as WebsocketServer;

/**
 * @codeCoverageIgnore
 */
abstract class SwooleServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;


    /**
     * @var \Swoole\Http\Server | \Swoole\Websocket\Server
     */
    protected static $server;
    protected static $swoole_setting;
    protected static $swoole_database_table;



    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishFiles();
        $this->loadConfigs();
        $this->mergeConfigs();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerServer();
        $this->registerSwooleSetting();
        $this->registerSwooleDatabaseTable();
        $this->registerManager();
        $this->registerCommands();
        $this->registerPidManager();
    }

    /**
     * Register manager.
     *
     * @return void
     */
    abstract protected function registerManager();


    /**
     * Publish files of this package.
     * 发布此包的文件
     */
    protected function publishFiles()
    {
        $this->publishes([
            __DIR__ . '/../config/hashyoo_wswoole.php' => config_path('hashyoo_wswoole.php'),
//            __DIR__ . '/../config/swoole_websocket.php' => config_path('swoole_websocket.php'),
//            __DIR__ . '/../routes/websocket.php' => base_path('routes/websocket.php'),
        ], 'laravel-swoole');
    }

    /**
     * Load configurations.
     */
    protected function loadConfigs()
    {
        // do nothing
    }

    /**
     * Merge configurations.
     */
    protected function mergeConfigs()
    {
//        $this->mergeConfigFrom(__DIR__ . '/../config/swoole_http.php', 'swoole_http');
//        $this->mergeConfigFrom(__DIR__ . '/../config/swoole_websocket.php', 'swoole_websocket');
    }

    /**
     * Register pid manager.
     * 注册pid管理器
     *
     * @return void
     */
    protected function registerPidManager(): void
    {
        $this->app->singleton(PidManager::class, function() {
            return new PidManager(wswoole_pid_file());
        });
    }


    /**
     * Register commands.
     */
    protected function registerCommands()
    {
        $this->commands([
            WebsocketCommand::class,
        ]);
    }

    /**
     * Create swoole server.
     */
    protected function createSwooleServer()
    {
        $server = WebsocketServer::class;
//        $host = wswoole_host();//websocket ip为0.0.0.0
        $host = '0.0.0.0';

        $port = wswoole_port();
        static::$server = new $server($host, $port);
    }

    /**
     * Set swoole server configurations.
     */
    protected function configureSwooleServer()
    {
        $options = [
            'daemonize' => wswoole_is_daemon(),
            'worker_num' => wswoole_worker_num(),
            'task_worker_num' => wswoole_task_worker_num(),
            'max_request' => wswoole_max_request(),
            'log_file' => wswoole_log_file()
        ];

        static::$server->set($options);
    }

    /**
     * Register manager.
     *
     * @return void
     */
    protected function registerServer()
    {
        $this->app->singleton(Server::class, function () {
            if (is_null(static::$server)) {
                $this->createSwooleServer();
                $this->configureSwooleServer();
            }

            return static::$server;
        });
        $this->app->alias(Server::class, 'swoole.server');
    }

    protected function registerSwooleSetting()
    {
        $this->app->singleton('SwooleSetting', function () {
            if (is_null(static::$swoole_setting)) {
                static::$swoole_setting = new \HashyooSwoole\Config\SwooleSetting();
            }

            return static::$swoole_setting;
        });
//        $this->app->alias(Server::class, 'swoole.server');
    }

    protected function registerSwooleDatabaseTable()
    {
        $this->app->singleton('DatabaseTable', function () {
            if (is_null(static::$swoole_database_table)) {
                static::$swoole_database_table = new DatabaseTable();
            }

            return static::$swoole_database_table;
        });
        //        $this->app->alias(Server::class, 'swoole.server');
    }


}
