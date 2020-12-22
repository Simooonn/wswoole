<?php

namespace HashyooSwoole\Chat;

use HashyooSwoole\Common\ModelMongodb\MongoChatMessage;
use HashyooSwoole\Common\ModelMongodb\MongoConversation;
use HashyooSwoole\Facades\DatabaseTable;

trait Conversation
{
    /************* 会话 *************/

    /*会话列表*/
    public function conversation_list($ws,$fd,$from_uid,$data = []){
        $from_user = DatabaseTable::table('im_online')->get($from_uid);

        //获取用户会话列表
        $result = MongoConversation::where('user_id',$from_uid)->orderBy('created_at','desc')->get()->toarray();
        foreach ($result as &$value)
        {
            if($value['data']['from_uid'] == $from_uid){
                $value['is_me'] = true;
                $to_user = DatabaseTable::table('im_online')->get($value['data']['to_uid']);
            }
            else{
                $value['is_me'] = false;
                $to_user = DatabaseTable::table('im_online')->get($value['data']['from_uid']);
            }
            $value['opposite_user'] = $to_user;
            $arr_where = [
                'conversation_id'=>$value['conversation_id'],
                'to_uid'=>$from_uid,
                'to_is_read'=>false,
            ];
            $value['not_read_num'] = MongoChatMessage::where($arr_where)->count();
        }

        $rrrrr = wswoole_success('获取成功',$result,'conversation_list');
        $result = wswoole_push($ws,$fd,$rrrrr);
        if($result){
            return $rrrrr;
        }
        else{
            return wswoole_error('获取失败',[],'conversation_list');
        }

    }

    /*会话-聊天记录*/
    public function conversation_chat_history($ws,$fd,$from_uid,$conversation_id,$data = []){
        $page = $data['page'];
        $from_user = DatabaseTable::table('im_online')->get($from_uid);

        //获取会话-聊天记录
        $result = MongoChatMessage::where('conversation_id',$conversation_id)->orderBy('created_at','desc')->paginate(20,[],'page',$page)->toarray();
        $result = swoole_list($result);
        foreach ($result['data'] as &$value)
        {
            if($value['from_uid'] == $from_uid){
                $value['is_me'] = true;
                $value['from_user'] = $from_user;
                $opposite_user = DatabaseTable::table('im_online')->get($value['to_uid']);
                $value['to_user'] = $opposite_user;
                $value['opposite_user'] = $opposite_user;
            }
            else{
                $value['is_me'] = false;
                $opposite_user = DatabaseTable::table('im_online')->get($value['from_uid']);
                $value['from_user'] = $opposite_user;
                $value['to_user'] = $from_user;
                $value['opposite_user'] = $opposite_user;
            }
        }

        $rrrrr = wswoole_success('获取成功',$result,'chat_history');
        $result = wswoole_push($ws,$fd,$rrrrr);
        if($result){
            return $rrrrr;
        }
        else{
            return wswoole_error('获取失败',[],'chat_history');
        }

    }

    /*会话已读*/
    public function conversation_read($ws,$fd,$from_uid,$conversation_id){
        $arr_where = [
            'conversation_id'=>$conversation_id,
            'to_uid'=>$from_uid,
            'to_is_read'=>false,
        ];
        MongoChatMessage::where($arr_where)->update(['to_is_read'=>true]);
        $rrrrr = wswoole_success('已读成功',[],'conversation_read');
        return $rrrrr;


    }

    /*删除会话（删除会话时会清空会话里整个聊天记录）*/
    public function del_conversation($ws,$fd,$from_uid,$conversation_id){
        //删除会话
        $arr_where = [
            'conversation_id'=>$conversation_id,
            'user_id'=>$from_uid,
        ];
        MongoConversation::where($arr_where)->delete();

        //删除聊天记录
        $arr_where = [
            'conversation_id'=>$conversation_id,
        ];
        MongoChatMessage::where($arr_where)->delete();
        $rrrrr = wswoole_success('删除成功',[],'conversation_del');
        return $rrrrr;
    }






}
