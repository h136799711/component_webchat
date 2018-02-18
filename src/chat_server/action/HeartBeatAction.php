<?php
/**
 * Created by PhpStorm.
 * User: hebidu
 * Date: 2018-02-13
 * Time: 17:23
 */

namespace by\component\chat_server\action;


use by\component\chat_server\req\BaseReq;
use by\component\chat_server\resp\HeartBeatResp;

class HeartBeatAction
{
    public function process($clientId, BaseReq $req)
    {
        return (new HeartBeatResp($req->toArray()));
    }
}