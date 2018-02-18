<?php
/**
 * 注意：本内容仅限于博也公司内部传阅,禁止外泄以及用于其他的商业目的
 * @author    hebidu<346551990@qq.com>
 * @copyright 2018 www.itboye.com Boye Inc. All rights reserved.
 * @link      http://www.itboye.com/
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 * Revision History Version
 ********1.0.0********************
 * file created @ 2018-02-12 15:12
 *********************************
 ********1.0.1********************
 *
 *********************************
 */

namespace by\component\chat_server\constants;

/**
 * Class RespType
 * 响应消息类型
 * @package by\component\chat_server\constants
 */
class RespType
{

    /**
     *
     */
    const Pong = "122";

    /**
     * 登录 - 连接
     */
    const Login = "100";

    /**
     * 普通消息 - 文本消息
     */
    const TextMessage = "101";

    /**
     * 登出
     */
    const Logout = "199";

    const Error = "-1";
}