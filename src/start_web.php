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

require_once __DIR__ . '/../vendor/autoload.php';

use Workerman\WebServer;
use Workerman\Worker;

// WebServer
$web = new WebServer("http://0.0.0.0:55151");
// WebServer进程数量
$web->count = 2;
// 设置站点根目录
$web->addRoot('chat.8raw.com', __DIR__.'/chat_web_client');

// 如果不是在根目录启动，则运行runAll方法
if(!defined('GLOBAL_START'))
{
    Worker::runAll();
}

