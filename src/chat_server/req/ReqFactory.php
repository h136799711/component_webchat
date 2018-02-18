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
            // 客户端回应服务端的心跳
            case ReqType::Ping:
                $req = new HeartBeatReq($message_data);
                break;
            // 客户端登录 message格式: {type:login, name:xx, room_id:1} ，添加到客户端，广播给所有客户端xx进入聊天室
            case ReqType::Login:
                $req = new LoginReq($message_data);
                break;
            // 客户端发言 message: {type:say, to_client_id:xx, content:xx}
//            case ReqType::TextMessage:
//
//                // 非法请求
//                if (!isset($_SESSION['room_id'])) {
//                    throw new \Exception("\$_SESSION['room_id'] not set. client_ip:{$_SERVER['REMOTE_ADDR']}");
//                }
//                $room_id = $_SESSION['room_id'];
//                $client_name = $_SESSION['client_name'];
//
//                // 私聊
//                if ($message_data['to_client_id'] != 'all') {
//                    $new_message = array(
//                        'type' => 'say',
//                        'from_client_id' => $client_id,
//                        'from_client_name' => $client_name,
//                        'to_client_id' => $message_data['to_client_id'],
//                        'content' => "<b>对你说: </b>" . nl2br(htmlspecialchars($message_data['content'])),
//                        'time' => date('Y-m-d H:i:s'),
//                    );
//                    Gateway::sendToClient($message_data['to_client_id'], json_encode($new_message));
//                    $new_message['content'] = "<b>你对" . htmlspecialchars($message_data['to_client_name']) . "说: </b>" . nl2br(htmlspecialchars($message_data['content']));
//                    return Gateway::sendToCurrentClient(json_encode($new_message));
//                }
//
//                $new_message = array(
//                    'type' => 'say',
//                    'from_client_id' => $client_id,
//                    'from_client_name' => $client_name,
//                    'to_client_id' => 'all',
//                    'content' => nl2br(htmlspecialchars($message_data['content'])),
//                    'time' => date('Y-m-d H:i:s'),
//                );
//                return Gateway::sendToGroup($room_id, json_encode($new_message));
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