<?php

namespace HashyooSwoole\Chat;

use HashyooSwoole\Facades\DatabaseTable;

trait Online
{
//    private $table = null;

    /*连接*/
    public function on($fd,$user_id,$data = []){
        $arr_data = ['fd'=>$fd];
        $arr_data = array_merge($arr_data,$data);
       return DatabaseTable::table('im_online')->set($user_id,$arr_data);
    }

    /*断开*/
    public function leave(){
        $arr_data = ['fd'=>0,'fd'=>0];
        $arr_data = array_merge($arr_data,$data);
        return DatabaseTable::table('im_online')->set($user_id,$arr_data);
    }


}
