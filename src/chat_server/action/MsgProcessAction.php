<?php
/**
 * Created by PhpStorm.
 * User: hebidu
 * Date: 2018-02-13
 * Time: 16:52
 */

namespace by\component\chat_server\action;


use by\component\chat_server\constants\ReqType;
use by\component\chat_server\req\ReqFactory;
use by\infrastructure\helper\CallResultHelper;

class MsgProcessAction
{

    static $registerAction = [

    ];

    public static function initAction()
    {
        self::$registerAction[ReqType::OnlineUser] = new OnlineUserAction();
        self::$registerAction[ReqType::Pong] = new PongAction();
        self::$registerAction[ReqType::Ping] = new HeartBeatAction();
        self::$registerAction[ReqType::Login] = new LoginAction();
        self::$registerAction[ReqType::TextMessage] = new TextMessageAction();
    }

    /**
     * 处理消息
     * @param $clientId
     * @param $message_data
     * @return \by\infrastructure\base\CallResult
     */
    public function index($clientId, $message_data)
    {
        if (count(self::$registerAction) == 0) {
            self::initAction();
        }
        //1. json消息转化为结构化的数据
        $res = ReqFactory::getOne($message_data);
        if ($res->isFail()) {
            return $res;
        }

        $req = $res->getData();
        if (method_exists($req, "getType")) {
            // 是否可处理的类型
            foreach (self::$registerAction as $key => $value) {
                if ($key == $req->getType()) {
                    if (method_exists($value, "process")) {
                        return $value->process($clientId, $req);
                    }
                }
            }
        }

        return CallResultHelper::fail('无法处理的消息');
    }

}