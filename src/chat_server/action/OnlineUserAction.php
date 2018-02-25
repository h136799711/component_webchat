<?php
/**
 * 注意：本内容仅限于博也公司内部传阅,禁止外泄以及用于其他的商业目的
 * @author    hebidu<346551990@qq.com>
 * @copyright 2018 www.itboye.com Boye Inc. All rights reserved.
 * @link      http://www.itboye.com/
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 * Revision History Version
 ********1.0.0********************
 * file created @ 2018-02-25 15:12
 *********************************
 ********1.0.1********************
 *
 *********************************
 */

namespace by\component\chat_server\action;


use by\component\chat_server\context\ChatContext;
use by\component\chat_server\helper\ResponseHelper;
use by\component\chat_server\req\BaseReq;
use by\component\chat_server\req\ServiceOnlineUserReq;
use by\component\chat_server\resp\ServiceOnlineUserResp;
use by\infrastructure\helper\CallResultHelper;
use GatewayWorker\Lib\Gateway;

class OnlineUserAction
{
    public function process($clientId, BaseReq $req)
    {
        if ($req instanceof ServiceOnlineUserReq) {

            $data = Gateway::getClientInfoByGroup(ChatContext::USER_GROUP_ID);
            $resp = new ServiceOnlineUserResp();
            $resp->setOnlineUser(array_values($data));
            ResponseHelper::sendToOneByClientId($clientId, $resp);
        }

        return CallResultHelper::success();
    }

}