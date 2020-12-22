<?php

namespace HashyooSwoole\Chat;

use HashyooSwoole\Facades\DatabaseTable;

trait User
{
    /************* 用户 *************/

    /**
     * 注册用户
     *
     * @param string $userId 请求的用户 Id，应用内唯一标识，重复的用户 Id 将被当作为同一用户，支持大小写英文字母、数字、部分特殊符号 + = - _ 的组合方式，最大长度 64 字节。
     * @param string $name 用户名称，最大长度 128 字节。用来在 Push 推送时显示用户的名称，重新获取 Token 传入新的名称后，将覆盖之前的用户名称。
     * @param string $portraitUri 用户头像 URI，最大长度 1024 字节。
     *
     * @return array
     *
     *
     * code    Int    返回码，200 为正常。
     * token    String    用户 Token，可以保存应用内，长度在 256 字节以内，Token 中携带 IM 服务动态导航地址，开发者不需要进行处理，正常使用即可。
     * userId    String    用户 Id，与输入的用户 Id 相同
     *
     * @author wumengmeng <wu_mengmeng@foxmail.com>
     */
    public function user_register($userId = '',$name = '',$portraitUri = ''){
        $arr_data = ['fd'=>$fd];

        $arr_data['avatar'] = json_encode($a);
        $arr_data = array_merge((array)$arr_data,(array)$data);
        $result = DatabaseTable::table('im_online')->set($user_id,$arr_data);
        return $result;
    }

    /**
     * 查询用户信息
     *
     * @param string $userId
     *
     * @return array
     * @author wumengmeng <wu_mengmeng@foxmail.com>
     */
    public function user_info($userId = ''){
        return [];
    }

    /**
     * 刷新用户信息
     *
     * @param string $userId
     *
     * @return array
     * @author wumengmeng <wu_mengmeng@foxmail.com>
     */
    public function user_refresh_info($userId = ''){
        return [];
    }






}
