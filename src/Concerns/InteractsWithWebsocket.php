<?php

namespace HashyooSwoole\Concerns;

//use Throwable;
//use Illuminate\Pipeline\Pipeline;
//use HashyooSwoole\Server\Sandbox;
//use HashyooSwoole\Websocket\Parser;
//use HashyooSwoole\Websocket\Pusher;
//use HashyooSwoole\Websocket\Websocket;
//use HashyooSwoole\Transformers\Request;
//use HashyooSwoole\Server\Facades\Server;
//use HashyooSwoole\Websocket\HandlerContract;
//use Illuminate\Contracts\Container\Container;
//use Swoole\WebSocket\Server as WebsocketServer;
//use HashyooSwoole\Websocket\Rooms\RoomContract;
//use HashyooSwoole\Exceptions\WebsocketNotSetInConfigException;
//
///**
// * Trait InteractsWithWebsocket
// *
// * @property \Illuminate\Contracts\Container\Container $container
// * @property \Illuminate\Contracts\Container\Container $app
// * @property array $types
// */
use HashyooSwoole\Chat\IM;
use HashyooSwoole\Facades\DatabaseTable;
use Illuminate\Support\Facades\Request;

trait InteractsWithWebsocket
{
//    /**
//     * @var boolean
//     */
//    protected $isServerWebsocket = false;
//
//    /**
//     * @var \HashyooSwoole\Websocket\HandlerContract
//     */
//    protected $websocketHandler;
//
//    /**
//     * @var \HashyooSwoole\Websocket\Parser
//     */
//    protected $payloadParser;
//
//    /**
//     * @var \HashyooSwoole\Websocket\Rooms\RoomContract
//     */
//    protected $websocketRoom;

    /**
     * Websocket server events.
     *
     * @var array
     */
    protected $wsEvents = ['open', 'message', 'close'];

//    /**
//     * "onHandShake" listener.
//     * @param \Swoole\Http\Request $swooleRequest
//     * @param \Swoole\Http\Response $response
//     */
//    public function onHandShake($swooleRequest, $response)
//    {
//        $this->onOpen(
//            $this->app->make(Server::class),
//            $swooleRequest,
//            $response
//        );
//    }

    /**
     * "onOpen" listener.
     *
     * @param $ws
     * @param $request
     *
     * @author wumengmeng <wu_mengmeng@foxmail.com>
     */
    public function onOpen($ws, $request)
    {
//        $from_user = DatabaseTable::table('im_online')->get('wu_88');
//        var_dump($from_user);


        /*    $request->fd;//客户端id
            $request->header;//
            $request->server;//
            $request->cookie;//
            $request->get;//get参数
            $request->files;//
            $request->post;//post参数
            $request->tmpfiles;//*/
        try {
            wswoole_push($ws,$request->fd,wswoole_success('connect success!',[],'connect'));
        }
        catch (\Exception $exception) {
            echo '失败';
//            return yoo_hello_fail('失败',$exception->getMessage());
        }
    }

    /**
     * "onMessage" listener.
     *
     * @param \Swoole\Websocket\Server $ws
     * @param \Swoole\Websocket\Frame $frame
     */
    public function onMessage($ws, $frame)
    {
//        try {
            $data = json_decode($frame->data,true);
            $fd = $frame->fd;//客户端id
            $IM = new IM();
            $result = $IM->im_event($ws,$fd, $data);
//        }
//        catch (\Exception $exception) {
//            echo '失败';
            //            return yoo_hello_fail('失败',$exception->getMessage());
//        }

//
//        //错误 给客户端发送通知
//        if($result['code'] != 200){
//            $ws->push($frame->fd, $result['msg']);
//        }

    }

    /**
     * "onClose" listener.
     *
     * @param \Swoole\Websocket\Server $server
     * @param int $fd
     * @param int $reactorId
     */
    public function onClose($ws, $fd)
    {
        try {
            wswoole_push($ws,$request->fd,wswoole_success("client-{$fd} is closed",[],'close'));
        }
        catch (\Exception $exception) {
            echo '失败';
            //            return yoo_hello_fail('失败',$exception->getMessage());
        }
//        echo "client-{$fd} is closed";
    }

//    /**
//     * Indicates if a packet is websocket push action.
//     *
//     * @param mixed
//     *
//     * @return bool
//     */
//    protected function isWebsocketPushPacket($packet)
//    {
//        if (! is_array($packet)) {
//            return false;
//        }
//
//        return $this->isServerWebsocket
//            && array_key_exists('action', $packet)
//            && $packet['action'] === Websocket::PUSH_ACTION;
//    }
//
//
//    /**
//     * Push websocket message to clients.
//     *
//     * @param \Swoole\Websocket\Server $server
//     * @param mixed $data
//     */
//    public function pushMessage($server, array $data)
//    {
//        $pusher = Pusher::make($data, $server);
//        $pusher->push($this->payloadParser->encode(
//            $pusher->getEvent(),
//            $pusher->getMessage()
//        ));
//    }
//
//    /**
//     * Set frame parser for websocket.
//     *
//     * @param \HashyooSwoole\Websocket\Parser $payloadParser
//     *
//     * @return \HashyooSwoole\Concerns\InteractsWithWebsocket
//     */
//    public function setPayloadParser(Parser $payloadParser)
//    {
//        $this->payloadParser = $payloadParser;
//
//        return $this;
//    }
//
//    /**
//     * Get frame parser for websocket.
//     */
//    public function getPayloadParser()
//    {
//        return $this->payloadParser;
//    }

    /**
     * Prepare settings if websocket is enabled.
     * 如果启用了websocket，请准备设置。
     */
    protected function prepareWebsocket()
    {
//        $config = $this->container->make('config');
//        $parser = $config->get('swoole_websocket.parser');
//
//        if (! $this->isServerWebsocket = $config->get('swoole_http.websocket.enabled')) {
//            return;
//        }
//
//        if ($config->get('swoole_websocket.handshake.enabled')) {
//            $this->wsEvents = array_merge($this->wsEvents, ['handshake']);
//        }

        $this->events = array_merge($this->events ?? [], $this->wsEvents);
//        $this->prepareWebsocketRoom();
//        $this->setPayloadParser(new $parser);
    }
//
//    /**
//     * Check if it's a websocket fd.
//     *
//     * @param int $fd
//     *
//     * @return bool
//     */
//    protected function isServerWebsocket(int $fd): bool
//    {
//        return array_key_exists(
//            'websocket_status',
//            $this->container->make(Server::class)
//                ->connection_info($fd)
//        );
//    }
//
//    /**
//     * Prepare websocket handler for onOpen and onClose callback.
//     *
//     * @throws \Exception
//     */
//    protected function prepareWebsocketHandler()
//    {
//        $handlerClass = $this->container->make('config')->get('swoole_websocket.handler');
//
//        if (! $handlerClass) {
//            throw new WebsocketNotSetInConfigException;
//        }
//
//        $this->setWebsocketHandler($this->app->make($handlerClass));
//    }

//    /**
//     * Prepare websocket room.
//     */
//    protected function prepareWebsocketRoom()
//    {
//        $config = $this->container->make('config');
//        $driver = $config->get('swoole_websocket.default');
//        $websocketConfig = $config->get("swoole_websocket.settings.{$driver}");
//        $className = $config->get("swoole_websocket.drivers.{$driver}");
//
//        $this->websocketRoom = new $className($websocketConfig);
//        $this->websocketRoom->prepare();
//    }
//
//    /**
//     * Set websocket handler.
//     *
//     * @param \HashyooSwoole\Websocket\HandlerContract $handler
//     *
//     * @return \HashyooSwoole\Concerns\InteractsWithWebsocket
//     */
//    public function setWebsocketHandler(HandlerContract $handler)
//    {
//        $this->websocketHandler = $handler;
//
//        return $this;
//    }
//
//    /**
//     * Get websocket handler.
//     *
//     * @return \HashyooSwoole\Websocket\HandlerContract
//     */
//    public function getWebsocketHandler(): HandlerContract
//    {
//        return $this->websocketHandler;
//    }
//
//    /**
//     * @param string $class
//     * @param array $settings
//     *
//     * @return \HashyooSwoole\Websocket\Rooms\RoomContract
//     */
//    protected function createRoom(string $class, array $settings): RoomContract
//    {
//        return new $class($settings);
//    }
//
//    /**
//     * Bind room instance to Laravel app container.
//     */
//    protected function bindRoom(): void
//    {
//        $this->app->singleton(RoomContract::class, function () {
//            return $this->websocketRoom;
//        });
//
//        $this->app->alias(RoomContract::class, 'swoole.room');
//    }
//
//    /**
//     * Bind websocket instance to Laravel app container.
//     */
//    protected function bindWebsocket()
//    {
//        $this->app->singleton(Websocket::class, function (Container $app) {
//            return new Websocket($app->make(RoomContract::class), new Pipeline($app));
//        });
//
//        $this->app->alias(Websocket::class, 'swoole.websocket');
//    }

//    /**
//     * Load websocket routes file.
//     */
//    protected function loadWebsocketRoutes()
//    {
//        $routePath = $this->container->make('config')
//            ->get('swoole_websocket.route_file');
//
//        if (! file_exists($routePath)) {
//            $routePath = __DIR__ . '/../../routes/websocket.php';
//        }
//
//        return require $routePath;
//    }
//
//    /**
//     * Indicates if the payload is websocket push.
//     *
//     * @param mixed $payload
//     *
//     * @return boolean
//     */
//    public function isWebsocketPushPayload($payload): bool
//    {
//        if (! is_array($payload)) {
//            return false;
//        }
//
//        return $this->isServerWebsocket
//            && ($payload['action'] ?? null) === Websocket::PUSH_ACTION
//            && array_key_exists('data', $payload);
//    }
}
