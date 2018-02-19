<?php
/**
 * 注意：本内容仅限于博也公司内部传阅,禁止外泄以及用于其他的商业目的
 * @author    hebidu<346551990@qq.com>
 * @copyright 2018 www.itboye.com Boye Inc. All rights reserved.
 * @link      http://www.itboye.com/
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 * Revision History Version
 ********1.0.0********************
 * file created @ 2018-02-12 15:24
 *********************************
 ********1.0.1********************
 *
 *********************************
 */

namespace by\component\chat_server\resp;


use by\component\chat_server\constants\RespType;

/**
 * Class LoginResp
 * 响应登录
 * @package by\component\chat_server\resp
 */
class LoginResp extends BaseResp
{
    private $uid;
    private $nick;
    private $avatar;
    private $clientId;
    private $onlineList;

    public function __construct($data = [])
    {
        parent::__construct($data);
        $this->setType(RespType::Login);
    }

    /**
     * @return mixed
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * @param mixed $avatar
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
    }

    /**
     * @return mixed
     */
    public function getNick()
    {
        return $this->nick;
    }

    /**
     * @param mixed $nick
     */
    public function setNick($nick)
    {
        $this->nick = $nick;
    }

    /**
     * @return mixed
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * @param mixed $clientId
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
    }

    /**
     * @return mixed
     */
    public function getUid()
    {
        return $this->uid;
    }

    /**
     * @param mixed $uid
     */
    public function setUid($uid)
    {
        $this->uid = $uid;
    }

    /**
     * @return mixed
     */
    public function getOnlineList()
    {
        return $this->onlineList;
    }

    /**
     * @param mixed $onlineList
     */
    public function setOnlineList($onlineList)
    {
        $this->onlineList = $onlineList;
    }
}