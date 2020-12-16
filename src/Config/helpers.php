<?php
use HashyooSwoole\Facades\SwooleSetting;

function wswoole_host(){
    return SwooleSetting::wswoole_host();
}

function wswoole_port(){
    return SwooleSetting::wswoole_port();
}

function wswoole_is_daemon(){
    return SwooleSetting::wswoole_is_daemon();
}


function wswoole_reactor_num(){
    return SwooleSetting::wswoole_reactor_num();
}

function wswoole_worker_num(){
    return SwooleSetting::wswoole_worker_num();
}


function wswoole_task_worker_num(){
    return SwooleSetting::wswoole_task_worker_num();
}

function wswoole_max_request(){
    return SwooleSetting::wswoole_max_request();
}

function wswoole_log_file(){
    return SwooleSetting::wswoole_log_file();
}

function wswoole_pid_file(){
    return SwooleSetting::wswoole_pid_file();
}

function wswoole_tables(){
    return SwooleSetting::wswoole_tables();
}

///* 是否开启 websocket */
//function websocket_enabled(){
//    return SwooleSetting::websocket_enabled();
//}

/* 是否开启访问日志 */
//function access_log(){
//    return SwooleSetting::access_log();
//}
