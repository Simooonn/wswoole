<?php

namespace HashyooSwoole\Common\ModelMongodb;

use Common\Model\NewsArticle;

class MongoConversation extends BaseMongo
{
    //聊天会话
    protected $collection = 'conversation';//等价于数据表
    protected $primaryKey = 'conversation_id';
    protected $guarded = [];

    public function chat_history(){
        return $this->hasMany(MongoChatMessage::class,'conversation_id','conversation_id');
    }


}
