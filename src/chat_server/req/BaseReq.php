<?php
/**
 * 注意：本内容仅限于博也公司内部传阅,禁止外泄以及用于其他的商业目的
 * @author    hebidu<346551990@qq.com>
 * @copyright 2018 www.itboye.com Boye Inc. All rights reserved.
 * @link      http://www.itboye.com/
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 * Revision History Version
 ********1.0.0********************
 * file created @ 2018-02-12 15:10
 *********************************
 ********1.0.1********************
 *
 *********************************
 */

namespace by\component\chat_server\req;


use by\infrastructure\helper\Object2DataArrayHelper;

abstract class BaseReq
{
    private $type;
    private $reqId;
    private $reqTime;

    public function __construct($data = [])
    {
        if (is_array($data)) {
            Object2DataArrayHelper::setData($this, $data);
        }
    }

    public function toArray()
    {
        return Object2DataArrayHelper::getDataArrayFrom($this);
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getReqId()
    {
        return $this->reqId;
    }

    /**
     * @param mixed $reqId
     */
    public function setReqId($reqId)
    {
        $this->reqId = $reqId;
    }

    /**
     * @return mixed
     */
    public function getReqTime()
    {
        return $this->reqTime;
    }

    /**
     * @param mixed $reqTime
     */
    public function setReqTime($reqTime)
    {
        $this->reqTime = $reqTime;
    }
}