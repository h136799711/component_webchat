<?php
/**
 * Created by PhpStorm.
 * User: hebidu
 * Date: 2018-02-13
 * Time: 17:08
 */

namespace by\component\chat_server\action;


use by\component\chat_server\context\ChatContext;
use by\component\chat_server\req\BaseReq;
use by\component\chat_server\req\LoginReq;
use by\component\chat_server\resp\LoginResp;
use by\component\chat_server\resp\NewUserResp;
use by\infrastructure\helper\CallResultHelper;
use GatewayWorker\Lib\Gateway;

class LoginAction
{
    /**
     * @param $clientId
     * @param BaseReq $req
     * @return \by\infrastructure\base\CallResult
     * @throws \Exception
     */
    public function process($clientId, BaseReq $req)
    {

        if (!($req instanceof LoginReq)) {
            return CallResultHelper::fail('req 不是LoginReq');
        }

        $uid = $req->getUid();
        $nick = $req->getNick();
        $roomId = $req->getRoomId();
        $resp = new LoginResp();
        $resp->setRespId($req->getReqId());
        $resp->setRespTime(time());
        $resp->setClientId($clientId);
        $resp->setUid($uid);

        if ($roomId == ChatContext::SERVICE_GROUP_ID) {
            // 发送新客服上线给客服组
            $this->sendToServiceGroup($req, ChatContext::SERVICE_GROUP_ID);
            Gateway::joinGroup($clientId, ChatContext::SERVICE_GROUP_ID);
        } elseif ($roomId == ChatContext::USER_GROUP_ID) {
            // 通知客服有新用户咨询上线
            $this->sendToServiceGroup($req, ChatContext::USER_GROUP_ID);
            Gateway::joinGroup($clientId, ChatContext::USER_GROUP_ID);
        }

        Gateway::bindUid($clientId, $uid);

        $session = Gateway::getSession($clientId);
        $session['userinfo'] = $req->toArray();
        Gateway::updateSession($clientId, $session);
        $onlineList = Gateway::getClientInfoByGroup(ChatContext::SERVICE_GROUP_ID);
        $resp->setOnlineList($onlineList);

        Gateway::sendToClient($clientId, $resp->toJson());

        return CallResultHelper::success();
    }

    /**
     * @param LoginReq $req
     * @param string $userType
     * @throws \Exception
     */
    private function sendToServiceGroup(LoginReq $req, $userType = ChatContext::SERVICE_GROUP_ID)
    {
        $newUserResp = new NewUserResp();
        $newUserResp->setRespTime(time());
        $newUserResp->setUid($req->getUid());
        $newUserResp->setAvatar($req->getAvatar());
        $newUserResp->setNick($req->getNick());
        $newUserResp->setUserType($userType);
        Gateway::sendToGroup(ChatContext::SERVICE_GROUP_ID, $newUserResp->toJson());
    }
}