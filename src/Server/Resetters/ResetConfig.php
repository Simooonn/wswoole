<?php
//
//namespace HashyooSwoole\Server\Resetters;
//
//use HashyooSwoole\Server\Sandbox;
//use Illuminate\Contracts\Container\Container;
//
//class ResetConfig implements ResetterContract
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
//        $app->instance('config', clone $sandbox->getConfig());
//
//        return $app;
//    }
//}
