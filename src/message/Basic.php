<?php
/**
 * User: johnxu <fsyzxz@163.com> 549716096
 * HomePage: http://www.johnxu.net
 * Date: 2017/7/12
 */
namespace johnxu\wechat\message;
/**
 * 消息类型
 * Trait Basic
 * @package johnxu\wechat\message
 */
trait Basic
{
    /**
     * 文本消息
     * @return bool
     */
    public function isTextMsg()
    {
        return $this->message->MsgType == self::MSG_TYPE_TEXT;
    }

    /**
     * 图像消息
     * @return bool
     */
    public function isImageMsg()
    {
        return $this->message->MsgType == self::MSG_TYPE_IMAGE;
    }

    /**
     * 语音消息
     * @return bool
     */
    public function isVoiceMsg()
    {
        return $this->message->MsgType == self::MSG_TYPE_VOICE;
    }

    /**
     * 地址消息
     * @return bool
     */
    public function isLocationMsg()
    {
        return $this->message->MsgType == self::MSG_TYPE_LOCATION;
    }

    /**
     * 链接消息
     * @return bool
     */
    public function isLinkMsg()
    {
        return $this->message->MsgType == self::MSG_TYPE_LINK;
    }

    /**
     * 视频消息
     * @return bool
     */
    public function isVideoMsg()
    {
        return $this->message->MsgType == self::MSG_TYPE_VIDEO;
    }

    /**
     * 小视频消息
     * @return bool
     */
    public function isSmallVideoMsg()
    {
        return $this->message->MsgType == self::MSG_TYPE_SMALL_VIDEO;
    }
}