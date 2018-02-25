<?php
/**
 * 注意：本内容仅限于博也公司内部传阅,禁止外泄以及用于其他的商业目的
 * @author    hebidu<346551990@qq.com>
 * @copyright 2018 www.itboye.com Boye Inc. All rights reserved.
 * @link      http://www.itboye.com/
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 * Revision History Version
 ********1.0.0********************
 * file created @ 2018-02-25 09:05
 *********************************
 ********1.0.1********************
 *
 *********************************
 */

namespace by\component\chat_server\req;


class TextMessageReq extends BaseReq
{
    private $toUid;
    private $text;

    /**
     * @return mixed
     */
    public function getToUid()
    {
        return $this->toUid;
    }

    /**
     * @param mixed $toUid
     */
    public function setToUid($toUid)
    {
        $this->toUid = $toUid;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param mixed $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

}