<?php

/**
 * This is only for `function not exists` in config/swoole_http.php.
 */
if (! function_exists('swoole_cpu_num')) {
    function swoole_cpu_num(): int
    {
        return 4;
    }
}

function os_is_win(){
    return strtoupper(substr(PHP_OS,0,3))==='WIN' ?: false;
}

/**
 * This is only for `function not exists` in config/swoole_http.php.
 */
if (! defined('SWOOLE_SOCK_TCP')) {
    define('SWOOLE_SOCK_TCP', 1);
}

if (! defined('SWOOLE_PROCESS')) {
    define('SWOOLE_PROCESS', 3);
}

function wswoole_success($s_msg = '', $arr_result = [],$type = ''){
    $n_error_code = 200;
//    $s_error_msg  = '';
    return [
        'code'       => 200,
        'type'        => $type,
        'msg'        => $s_msg,
        'result'     => $arr_result,
    ];
}

function wswoole_error($s_msg = '',  $arr_result = [],$type = '')
{
    $n_code      = 1;

    return [
        'code'       => $n_code,
        'type'        => $type,
        'msg'        => $s_msg,
        'result'     => $arr_result,
    ];
}

function wswoole_push($ws,$fd,$data){
    if(is_array($data)){
        $data = json_encode($data);
    }
    return $ws->push($fd, $data);
}

/*会话id*/
function conversation_id($type,$arr_data){
    $conversation_id = '';
    if($type == 'chat'){
        $from_uid = $arr_data['from_uid'];
        $to_uid = $arr_data['to_uid'];
        if($from_uid >= $to_uid){
            $conversation_id = 't_'.$to_uid.'_'.$from_uid;
        }
        else{
            $conversation_id = 't_'.$from_uid.'_'.$to_uid;
        }
    }
    $conversation_id = md5($conversation_id);

    return $conversation_id;
}

function swoole_list($list = []){
    return [
        'data'=>$list['data'],
        'current_page'=>$list['current_page'],
        'last_page'=>$list['last_page'],
        'total'=>$list['total'],
    ];
}
