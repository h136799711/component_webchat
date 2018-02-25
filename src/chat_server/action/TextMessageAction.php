<?php
/**
 * 注意：本内容仅限于博也公司内部传阅,禁止外泄以及用于其他的商业目的
 * @author    hebidu<346551990@qq.com>
 * @copyright 2018 www.itboye.com Boye Inc. All rights reserved.
 * @link      http://www.itboye.com/
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 * Revision History Version
 ********1.0.0********************
 * file created @ 2018-02-25 09:09
 *********************************
 ********1.0.1********************
 *
 *********************************
 */

namespace by\component\chat_server\action;


use by\component\chat_server\req\BaseReq;
use by\component\chat_server\req\TextMessageReq;
use by\infrastructure\helper\CallResultHelper;
use GatewayWorker\Lib\Gateway;

class TextMessageAction
{

    public function process($clientId, BaseReq $req)
    {
        if ($req instanceof TextMessageReq) {

            $uid = $req->getToUid();
            $text = $req->getText();
            
            Gateway::sendToUid($uid, $text);
//            Gateway::sendToUid($uid, $text);
        }

        return CallResultHelper::success();
    }
}