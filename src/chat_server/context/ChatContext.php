<?php
/**
 * Created by PhpStorm.
 * User: hebidu
 * Date: 2018-02-18
 * Time: 17:26
 */

namespace by\component\chat_server\context;


class ChatContext
{
    /**
     * 最大客户端链接数 100
     */
    const MAX_CLIENT_COUNT = 100;
    /**
     * Chat服务器定时器-单位 默认 1秒
     */
    const CHAT_TICK = 1;

    /**
     * 客服所在组
     */
    const SERVICE_GROUP_ID = "S11111111";

    private $onlineCustomerServiceList;
    private $onlineCustomerServiceCount;
    private $userCount;
    private $serverStartTime;
    private $serverRunTime;

    /**
     * @return mixed
     */
    public function getOnlineCustomerServiceList()
    {
        return $this->onlineCustomerServiceList;
    }

    /**
     * @param mixed $onlineCustomerServiceList
     */
    public function setOnlineCustomerServiceList($onlineCustomerServiceList)
    {
        $this->onlineCustomerServiceList = $onlineCustomerServiceList;
    }

    /**
     * @return mixed
     */
    public function getServerStartTime()
    {
        return $this->serverStartTime;
    }

    /**
     * @param mixed $serverStartTime
     */
    public function setServerStartTime($serverStartTime)
    {
        $this->serverStartTime = $serverStartTime;
    }

    /**
     * @return mixed
     */
    public function getServerRunTime()
    {
        return $this->serverRunTime;
    }

    /**
     * @param mixed $serverRunTime
     */
    public function setServerRunTime($serverRunTime)
    {
        $this->serverRunTime = $serverRunTime;
    }

    /**
     * @return mixed
     */
    public function getOnlineCustomerServiceCount()
    {
        return $this->onlineCustomerServiceCount;
    }

    /**
     * @param mixed $onlineCustomerServiceCount
     */
    public function setOnlineCustomerServiceCount($onlineCustomerServiceCount)
    {
        $this->onlineCustomerServiceCount = $onlineCustomerServiceCount;
    }

    /**
     * @return mixed
     */
    public function getUserCount()
    {
        return $this->userCount;
    }

    /**
     * @param mixed $userCount
     */
    public function setUserCount($userCount)
    {
        $this->userCount = $userCount;
    }


}