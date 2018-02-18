<?php
/**
 * This file is part of workerman.
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the MIT-LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @author walkor<walkor@workerman.net>
 * @copyright walkor<walkor@workerman.net>
 * @link http://www.workerman.net/
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 */

/**
 * 用于检测业务代码死循环或者长时间阻塞等问题
 * 如果发现业务卡死，可以将下面declare打开（去掉//注释），并执行php start.php reload
 * 然后观察一段时间workerman.log看是否有process_timeout异常
 */
//declare(ticks=1);

/**
 * 聊天主逻辑
 * 主要是处理 onMessage onClose
 */
class Events
{
    /**
     * 服务器端的全局统计信息
     * @var \by\component\chat_server\context\ChatContext
     */
    private static $context = null;
    private static $tick = 0;

    public static function onWorkerStart(\Workerman\Worker $businessWorker)
    {
        if ($businessWorker->id == 0) {
            self::initContext();
            self::initTimer();
        }
    }


    /**
     * 有消息时
     * @param int $client_id
     * @param mixed $message
     * @return bool|void
     * @throws Exception
     */
    public static function onMessage($client_id, $message)
    {
        // debug
//        echo "client:{$_SERVER['REMOTE_ADDR']}:{$_SERVER['REMOTE_PORT']} gateway:{$_SERVER['GATEWAY_ADDR']}:{$_SERVER['GATEWAY_PORT']}  client_id:$client_id session:" . json_encode($_SESSION) . " onMessage:" . $message . "\n";

        // 客户端传递的是json数据
        $message_data = json_decode($message, true);
        if (!$message_data) {
            $errResp = new \by\component\chat_server\resp\ErrorResp(['err_msg' => '数据格式错误(必须json)']);
            \by\component\chat_server\helper\ResponseHelper::sendToOneByClientId($client_id, $errResp);
            return ;
        }

        $result = (new \by\component\chat_server\action\MsgProcessAction())->index($client_id, $message_data);
        if ($result->isFail()) {
            $errResp = new \by\component\chat_server\resp\ErrorResp(['err_msg' => $result->getMsg()]);
            \by\component\chat_server\helper\ResponseHelper::sendToOneByClientId($client_id, $errResp);
            return ;
        }
    }

    /**
     * 当客户端断开连接时
     * @param integer $client_id 客户端id
     * @throws Exception
     */
    public static function onClose($client_id)
    {
        // 从房间的客户端列表中删除

    }

    public static function update()
    {
        self::$tick++;
        // 每3个Chat时钟时间更新一次context信息
        if (self::$tick % 3 == 0) {
            self::$context->setOnlineCustomerServiceCount(0);
            self::$context->setServerRunTime(self::$context->getServerRunTime() + 3);
            self::$context->setUserCount(\GatewayWorker\Lib\Gateway::getAllClientCount());
            $onlineCustomerServiceCount = \GatewayWorker\Lib\Gateway::getClientCountByGroup(\by\component\chat_server\context\ChatContext::SERVICE_GROUP_ID);
            self::$context->setOnlineCustomerServiceCount($onlineCustomerServiceCount);
            self::$context->setOnlineCustomerServiceList(\GatewayWorker\Lib\Gateway::getClientInfoByGroup(\by\component\chat_server\context\ChatContext::SERVICE_GROUP_ID));
        }
    }


    /**
     * 定时器
     */
    private static function initTimer()
    {
        \Workerman\Lib\Timer::add(\by\component\chat_server\context\ChatContext::CHAT_TICK, array('Events', 'update'), array(), true);
    }


    private static function initContext()
    {
        if (self::$context == null) self::$context = new \by\component\chat_server\context\ChatContext();
        self::$context->setServerStartTime(time());
        self::$context->setServerRunTime(0);
    }

}
