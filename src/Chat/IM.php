<?php

namespace HashyooSwoole\Chat;

//error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT & ~E_NOTICE);
use HashyooSwoole\Facades\DatabaseTable;

error_reporting(E_ALL &  ~E_NOTICE);

class IM
{
    use Online,Chat,Conversation;

    /**
     *
     *  $data =  [
     *  'from_uid'=>1,
     *  'to_uid'=>2,
     *  'method'=>'chat-send_message',
     *  //user-register[注册] user-online[上线] user-leave[离开] user-update[更新用户信息]
     *  //chat-send_message[发送单聊文字]  chat-send_voice[发送单聊语音]  chat-send_image[发送单聊图片]  chat-send_goods[发送单聊商品]  chat-send_video[发送单聊视频]
     *  //conversation-list[会话列表] conversation-chat_history[会话-聊天记录] conversation-read[会话已读]
     *  'data'=>'消息',//数据内容
     *  'last_message_at'=>null,
     *  ];
     */

    public function im_event($ws,$fd, $data){
        $from_uid = $data['from_uid'];
        $to_uid = $data['to_uid'];
        $conversation_id = $data['conversation_id'];
//        var_dump($data);

        //发送信息
        //user-register[注册] user-online[上线] user-leave[离开] user-update[更新用户信息]
        //chat-send_message[发送单聊文字]  chat-send_voice[发送单聊语音]  chat-send_image[发送单聊图片]  chat-send_goods[发送单聊商品]  chat-send_video[发送单聊视频]
        //conversation-list[会话列表] conversation-chat_history[会话-聊天记录] conversation-read[会话已读] conversation-del[删除会话]
        $method = $data['method'];
        switch ($method)
        {
            case 'user-online'://上线
                $result = $this->online($ws,$fd,$from_uid,$data['data']);
                break;
            case 'chat-send_message'://发送单聊文字
                $result = $this->chat_publish($ws,$fd,$from_uid,$to_uid,$data);
                break;
            case 'chat-send_voice'://发送单聊语音
                $result = $this->chat_publish($ws,$fd,$from_uid,$to_uid,$data);
                break;
            case 'chat-send_image'://发送单聊图片
                $result = $this->chat_publish($ws,$fd,$from_uid,$to_uid,$data);
                break;
            case 'chat-send_goods'://发送单聊商品
                $result = $this->chat_publish($ws,$fd,$from_uid,$to_uid,$data);
                break;
            case 'chat-send_video'://发送单聊视频
                $result = $this->chat_publish($ws,$fd,$from_uid,$to_uid,$data);
                break;
            case 'conversation-list'://会话列表
                $result = $this->conversation_list($ws,$fd,$from_uid);
                break;
            case 'conversation-chat_history'://会话-聊天记录
                $result = $this->conversation_chat_history($ws,$fd,$from_uid,$conversation_id,$data);
                break;
            case 'conversation-read'://会话已读
                $result = $this->conversation_read($ws,$fd,$from_uid,$conversation_id);
                break;
            case 'conversation-del'://删除会话
                $result = $this->del_conversation($ws,$fd,$from_uid,$conversation_id);
                break;
            default:
                $result = wswoole_error('unknown error',[],'other');
                wswoole_push($ws,$fd,$result);
        }
        return $result;

    }


}
