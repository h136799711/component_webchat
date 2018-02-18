<?php
/**
 * 注意：本内容仅限于博也公司内部传阅,禁止外泄以及用于其他的商业目的
 * @author    hebidu<346551990@qq.com>
 * @copyright 2018 www.itboye.com Boye Inc. All rights reserved.
 * @link      http://www.itboye.com/
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 * Revision History Version
 ********1.0.0********************
 * file created @ 2018-02-12 15:27
 *********************************
 ********1.0.1********************
 *
 *********************************
 */

namespace by\component\chat_server\helper;


use by\component\chat_server\resp\BaseResp;
use by\component\chat_server\resp\ErrorResp;
use GatewayWorker\Lib\Gateway;

class ResponseHelper
{
    public static function sendToOneByClientId($clientId, BaseResp $resp) {
        $json = $resp->toJson();
        Gateway::sendToClient($clientId, $json);
    }

    public static function sendToOneByUid($uid, BaseResp $resp) {
        $clientAll = Gateway::getClientIdByUid($uid);
        if (count($clientAll) > 0) {
            $clientId = $clientAll[0];
            $json = $resp->toJson();
            Gateway::sendToClient($clientId, $json);
        } else {
            $errResp = new ErrorResp(['err_msg' => '该'.$uid.'没有对于的Client_id']);
            Gateway::sendToCurrentClient($errResp->toJson());
        }
    }
}