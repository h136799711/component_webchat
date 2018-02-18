<?php
/**
 * Created by PhpStorm.
 * User: hebidu
 * Date: 2018-02-13
 * Time: 17:08
 */

namespace by\component\chat_server\action;


use by\component\chat_server\req\BaseReq;
use by\component\chat_server\req\LoginReq;
use by\infrastructure\helper\CallResultHelper;
use GatewayWorker\Lib\Gateway;

class LoginAction
{
    public function index($clientId, BaseReq $req)
    {

        if (!($req instanceof LoginReq)) {
            return CallResultHelper::fail('req 不是LoginReq');
        }

        $uid = $req->getUid();
        $nickname = $req->getNick();


        $clients_list = Gateway::getClientSessionsByGroup($room_id);
        if (count($clients_list) > 100) {

        }

        $client_name = htmlspecialchars($message_data['client_name']);
        $_SESSION['room_id'] = $room_id;
        $_SESSION['client_name'] = $client_name;

        // 获取房间内所有用户列表
        foreach ($clients_list as $tmp_client_id => $item) {
            $clients_list[$tmp_client_id] = $item['client_name'];
        }
        $clients_list[$client_id] = $client_name;

        // 转播给当前房间的所有客户端，xx进入聊天室 message {type:login, client_id:xx, name:xx}
        $new_message = array('type' => $message_data['type'], 'client_id' => $client_id, 'client_name' => htmlspecialchars($client_name), 'time' => date('Y-m-d H:i:s'));
        Gateway::sendToGroup($room_id, json_encode($new_message));
        Gateway::joinGroup($client_id, $room_id);

        // 给当前用户发送用户列表
        $new_message['client_list'] = $clients_list;
        Gateway::sendToCurrentClient(json_encode($new_message));
    }
}