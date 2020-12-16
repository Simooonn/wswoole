<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Websocket handler for onOpen and onClose callback
    | Replace this handler if you want to customize your websocket handler
    |--------------------------------------------------------------------------
    */
    'handler' => HashyooSwoole\Websocket\SocketIO\WebsocketHandler::class,

    /*
    |--------------------------------------------------------------------------
    | Default frame parser
    | Replace it if you want to customize your websocket payload
    |--------------------------------------------------------------------------
    */
    'parser' => HashyooSwoole\Websocket\SocketIO\SocketIOParser::class,

    /*
    |--------------------------------------------------------------------------
    | Websocket route file path
    |--------------------------------------------------------------------------
    */
    'route_file' => base_path('routes/websocket.php'),

    /*
    |--------------------------------------------------------------------------
    | Default middleware for on connect request
    |--------------------------------------------------------------------------
    */
    'middleware' => [
        // HashyooSwoole\Websocket\Middleware\DecryptCookies::class,
        // HashyooSwoole\Websocket\Middleware\StartSession::class,
        // HashyooSwoole\Websocket\Middleware\Authenticate::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Websocket handler for customized onHandShake callback
    |--------------------------------------------------------------------------
    */
    'handshake' => [
        'enabled' => false,
        'handler' => HashyooSwoole\Websocket\HandShakeHandler::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Default websocket driver
    |--------------------------------------------------------------------------
    */
    'default' => 'table',

    /*
    |--------------------------------------------------------------------------
    | Websocket client's heartbeat interval (ms)
    |--------------------------------------------------------------------------
    */
    'ping_interval' => 25000,

    /*
    |--------------------------------------------------------------------------
    | Websocket client's heartbeat interval timeout (ms)
    |--------------------------------------------------------------------------
    */
    'ping_timeout' => 60000,

    /*
    |--------------------------------------------------------------------------
    | Room drivers mapping
    |--------------------------------------------------------------------------
    */
    'drivers' => [
        'table' => HashyooSwoole\Websocket\Rooms\TableRoom::class,
        'redis' => HashyooSwoole\Websocket\Rooms\RedisRoom::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Room drivers settings
    |--------------------------------------------------------------------------
    */
    'settings' => [

        'table' => [
            'room_rows' => 4096,
            'room_size' => 2048,
            'client_rows' => 8192,
            'client_size' => 2048,
        ],

        'redis' => [
            'server' => [
                'host' => env('REDIS_HOST', '127.0.0.1'),
                'password' => env('REDIS_PASSWORD', null),
                'port' => env('REDIS_PORT', 6379),
                'database' => 0,
                'persistent' => true,
            ],
            'options' => [
                //
            ],
            'prefix' => 'swoole:',
        ],
    ],
];
