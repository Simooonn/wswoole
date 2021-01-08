<?php

namespace HashyooSwoole\Chat;

use HashyooSwoole\Common\ModelMongodb\MongoChatMessage;
use HashyooSwoole\Common\ModelMongodb\MongoConversation;
use HashyooSwoole\Facades\DatabaseTable;
trait Chat
{
    /************* 聊天 *************/

    /*发送单聊消息*/
    public function chat_publish($ws,$fd,$from_uid,$to_uid,$data = []){
        if(empty($to_uid)){
            $result =  wswoole_error("not found to_uid!",[],'chat');
            wswoole_push($ws,$fd,$result);
            return $result;
        }
        $from_user = DatabaseTable::table('im_online')->get($from_uid);
        $to_user = DatabaseTable::table('im_online')->get($to_uid);
        $to_fd = $to_user['fd'];

        /*if(empty($to_fd)){
            $result = wswoole_error("对方已下线!");
            wswoole_push($ws,$fd,$result);
            return $result;
        }*/
        $data['from_is_read'] = true;
        $data['to_is_read'] = false;
        $now_time = time();
        $data['created_at'] = yoo_ymdhis($now_time);
        $data['display_at'] = null;

        if(!empty($data['last_message_at'])){
            $last_message_time = strtotime($data['last_message_at']);
            if( $now_time - $last_message_time >= 5*60){
                $data['display_at'] = date('Y-m-d H:i');
            }
        }
        $arr_data = $data;

        //给对方发送消息
        $data['from_user'] = $from_user;
        $data['to_user'] = $to_user;


        /* 更新会话 */
        // 1-更新发送方会话
        $send_conversation_id = md5('two_'.$from_uid.'_'.$to_uid);
        $arr_where = ['conversation_id'=>$send_conversation_id];
        $arr_data_conver = ['data'=>$arr_data,'user_id'=>$from_uid];
        $result = MongoConversation::UpdateOrCreate($arr_where,$arr_data_conver);

        // 2-更新接收方会话
        $receive_conversation_id = md5('two_'.$to_uid.'_'.$from_uid);
        $arr_where = ['conversation_id'=>$receive_conversation_id];
        $arr_data_conver = ['data'=>$arr_data,'user_id'=>$to_uid];
        $result = MongoConversation::UpdateOrCreate($arr_where,$arr_data_conver);

        /* 添加消息记录 */
        // 1-添加发送方消息记录
        $arr_data['conversation_id'] = $send_conversation_id;
        $result = MongoChatMessage::create($arr_data);

        // 2-添加接收方消息记录
        $arr_data['conversation_id'] = $receive_conversation_id;
        $result = MongoChatMessage::create($arr_data);

        $result = wswoole_push($ws,$to_fd,wswoole_success('发送成功',$data,'chat'));
        return wswoole_success("发送成功");

    }




}
