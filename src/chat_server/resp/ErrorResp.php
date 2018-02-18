<?php
/**
 * Created by PhpStorm.
 * User: hebidu
 * Date: 2018-02-13
 * Time: 16:56
 */

namespace by\component\chat_server\resp;


use by\component\chat_server\constants\RespType;

class ErrorResp extends BaseResp
{
    private $errMsg;

    public function __construct(array $data = [])
    {
        parent::__construct($data);
        $this->setType(RespType::Error);
    }

    /**
     * @return mixed
     */
    public function getErrMsg()
    {
        return $this->errMsg;
    }

    /**
     * @param mixed $errMsg
     */
    public function setErrMsg($errMsg)
    {
        $this->errMsg = $errMsg;
    }
}