<?php
/**
 * User: johnxu <fsyzxz@163.com> 549716096
 * HomePage: http://www.johnxu.net
 * Date: 2017/7/12
 */
namespace johnxu\wechat\message;
/**
 * 事件消息
 * Trait Event
 * @package johnxu\wechat\message
 */
trait Event
{
    /**
     * 关注
     * @return bool
     */
    public function isSubscribeEvent()
    {
        return $this->message->MsgType == 'event'
            && $this->message->Event == self::EVENT_TYPE_SUBSCRIBE;
    }

    /**
     * 取消关注
     * @return bool
     */
    public function isUnSubscribeEvent()
    {
        return $this->message->MsgType == 'event'
            && $this->message->Event == self::EVENT_TYPE_UNSUBSCRIBE;
    }

    /**
     * 未关注用户扫描二维码
     * @return bool
     */
    public function isSubscribeScanEvent()
    {
        return $this->message->MsgType == 'event'
            && $this->message->Event == self::EVENT_TYPE_UNSUBSCRIBE_SCAN;
    }

    /**
     * 已关注用户扫描二维码
     * @return bool
     */
    public function isScanEvent()
    {
        return $this->message->MsgType == 'event'
            && $this->message->Event == self::EVENT_TYPE_SUBSCRIBE_SCAN;
    }

    /**
     * 上报地理位置事件
     * @return bool
     */
    public function isLocationEvent()
    {
        return $this->message->MsgType == 'event'
            && $this->message->Event == self::EVENT_TYPE_LOCATION;
    }
}