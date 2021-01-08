<?php

namespace HashyooSwoole\Common\ModelMongodb;

class MongoChatMessage extends BaseMongo
{
    //聊天消息记录
    protected $collection = 'chat_message';//等价于数据表
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function conversation(){
        return $this->belongsTo(MongoConversation::class,'conversation_id','conversation_id');
    }
}
