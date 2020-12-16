<?php
//
//namespace HashyooSwoole\Server\Resetters;
//
//use Illuminate\Contracts\Container\Container;
//use HashyooSwoole\Server\Sandbox;
//
//class ClearInstances implements ResetterContract
//{
//    /**
//     * "handle" function for resetting app.
//     *
//     * @param \Illuminate\Contracts\Container\Container $app
//     * @param \HashyooSwoole\Server\Sandbox $sandbox
//     *
//     * @return \Illuminate\Contracts\Container\Container
//     */
//    public function handle(Container $app, Sandbox $sandbox)
//    {
//        $instances = $sandbox->getConfig()->get('swoole_http.instances', []);
//
//        foreach ($instances as $instance) {
//            $app->forgetInstance($instance);
//        }
//
//        return $app;
//    }
//}
