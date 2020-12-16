<?php
//
//namespace HashyooSwoole\Middleware;
//
//use Closure;
//use Illuminate\Http\Request;
//use HashyooSwoole\Server\AccessOutput;
//use Symfony\Component\HttpFoundation\Response;
//
///**
// * Class AccessLog
// *
// * @codeCoverageIgnore
// */
//class AccessLog
//{
//    /**
//     * @var \HashyooSwoole\Server\AccessOutput
//     */
//    protected $output;
//
//    /**
//     * AccessLog constructor.
//     *
//     * @param \HashyooSwoole\Server\AccessOutput $output
//     */
//    public function __construct(AccessOutput $output)
//    {
//        $this->output = $output;
//    }
//
//    /**
//     * Handle the incoming request.
//     *
//     * @param  \Illuminate\Http\Request $request
//     * @param  \Closure $next
//     *
//     * @return mixed
//     */
//    public function handle($request, Closure $next)
//    {
//        return $next($request);
//    }
//
//    /**
//     * Handle the outgoing request and response.
//     *
//     * @param \Illuminate\Http\Request $request
//     * @param \Symfony\Component\HttpFoundation\Response $response
//     */
//    public function terminate(Request $request, Response $response)
//    {
//        $this->output->log($request, $response);
//    }
//}
