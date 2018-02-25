<?php
/**
 * Created by PhpStorm.
 * User: hebidu
 * Date: 2018-02-18
 * Time: 16:48
 */

namespace by\component\chat_server\req;


use by\component\chat_server\constants\ReqType;
use by\infrastructure\helper\CallResultHelper;

class ReqFactory
{
    /**
     * @param $message_data
     * @return \by\infrastructure\base\CallResult
     */
    public static function getOne($message_data)
    {
        if (!is_array($message_data) || !array_key_exists('type', $message_data)) {
            return CallResultHelper::fail('无法转化为req类型, 缺少type参数');
        }

        $req = null;
        // 根据类型执行不同的业务
        switch ($message_data['type']) {
            case ReqType::Pong:
                $req = new HeartBeatReq($message_data);
                break;
            // 客户端回应服务端的心跳
            case ReqType::Ping:
                $req = new HeartBeatReq($message_data);
                break;
            // 客户端登录 message格式: {type:login, name:xx, room_id:1} ，添加到客户端，广播给所有客户端xx进入聊天室
            case ReqType::Login:
                $req = new LoginReq($message_data);
                break;
            // 客户端发言 message: {type:say, to_client_id:xx, content:xx}
            case ReqType::TextMessage:
                $req = new TextMessageReq($message_data);
                break;
            case ReqType::OnlineUser:
                $req = new ServiceOnlineUserReq($message_data);
                break;
            default:
                break;
        }

        if (is_null($req)) {
            return CallResultHelper::fail('无法识别的请求类型');
        } else {
            return CallResultHelper::success($req);
        }
    }
}