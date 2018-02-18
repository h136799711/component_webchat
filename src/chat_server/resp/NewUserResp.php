<?php
/**
 * Created by PhpStorm.
 * User: hebidu
 * Date: 2018-02-18
 * Time: 20:28
 */

namespace by\component\chat_server\resp;


use by\component\chat_server\constants\RespType;

class NewUserResp extends BaseResp
{
    private $userType;
    private $uid;
    private $nick;
    private $avatar;

    public function __construct($data = [])
    {
        parent::__construct($data);
        $this->setType(RespType::NewUser);
    }

    /**
     * @return mixed
     */
    public function getUserType()
    {
        return $this->userType;
    }

    /**
     * @param mixed $userType
     */
    public function setUserType($userType)
    {
        $this->userType = $userType;
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


}