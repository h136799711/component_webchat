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
use by\component\chat_server\resp\LoginResp;
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
        $nick = $req->getNick();

        $resp = new LoginResp();
        $resp->setRespId($req->getReqId());
        $resp->setRespTime(time());
        $resp->setClientId($clientId);
        $resp->setUid($uid);
        $resp->setOnlineList(\Events::$context->getOnlineCustomerServiceList());
        Gateway::sendToCurrentClient($resp->toJson());

        return CallResultHelper::success();
    }
}