<?php

namespace HashyooSwoole\Chat;

use HashyooSwoole\Facades\DatabaseTable;

trait Online
{
    /************* 上线 *************/

    /*连接*/
    public function online($ws,$fd,$user_id = '',$data = []){
        $arr_data = [
            'fd'=>$fd,
            'user_id'=>$user_id,
            'nickname'=>yoo_string_trim($data['nickname']),
            'avatar'=>yoo_string_trim($data['avatar']),
            'status'=>'online',
        ];
        $result = DatabaseTable::table('im_online')->set($user_id,$arr_data);

        if($result){
            $result =  wswoole_success("online success!",[],'online');
        }
        else{
            $result =  wswoole_error('online fail!!!',[],'online');
        }
        wswoole_push($ws,$fd,$result);
        return $result;
    }


    /* 退出 */
    public function leave(){
        $arr_data = [
            'fd'=>0,
            'user_id'=>$user_id,
            'status'=>'offline',
        ];
        $result = DatabaseTable::table('im_online')->set($user_id,$arr_data);
        return $result;
    }


}
