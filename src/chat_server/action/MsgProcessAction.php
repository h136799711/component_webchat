<?php
/**
 * Created by PhpStorm.
 * User: hebidu
 * Date: 2018-02-13
 * Time: 16:52
 */

namespace by\component\chat_server\action;


use by\component\chat_server\constants\ReqType;
use by\component\chat_server\req\HeartBeatReq;
use by\component\chat_server\req\LoginReq;
use by\component\chat_server\resp\ErrorResp;

class MsgProcessAction
{
    public function index($clientId, $message_data)
    {

        $req = $this->getReq($message_data);
        if ($req == null) {
            return new ErrorResp(['err_msg' => '无法识别的数据']);
        }

        $resp = null;
        switch ($req->getType()) {
            // 客户端回应服务端的心跳
            case ReqType::Ping:
                $resp = (new HeartBeatAction())->process($clientId, $req);
                break;
            // 客户端登录 message格式: {type:login, name:xx, room_id:1} ，添加到客户端，广播给所有客户端xx进入聊天室
            case ReqType::Login:
                $resp = new LoginAction($clientId, $req);
                break;
            default:
                break;
        }

        return $resp;
    }

    private function getReq($message_data)
    {
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
        return $req;
    }
}