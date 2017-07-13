<?php
/**
 * User: johnxu <fsyzxz@163.com> 549716096
 * HomePage: http://www.johnxu.net
 * Date: 2017/7/12
 */
namespace johnxu\wechat\customservice;

use johnxu\wechat\Http;

/**
 * 客服消息管理
 * Class CustomMessage
 * @package johnxu\wechat\customservice
 */
trait CustomMessage
{
    /**
     * 发送消息
     * @param $data
     * @return mixed
     */
    public function send( $data )
    {
        $uri    = $this->api_uri . '/cgi-bin/message/custom/send?access_token=' . $this->getAccessToken();
        $response = Http::post( $uri, $data );

        return $this->get( $response );
    }

    /**
     * 发送文本消息
     * @param $toUser
     * @param $content
     * @return mixed
     */
    public function sendTest( $toUser, $content )
    {
        return $this->send( $toUser, 'text', array( 'content' => $content ) );
    }

    /**
     * 发送图片消息
     * @param $toUser
     * @param $media_id
     * @return mixed
     */
    public function sendImage( $toUser, $media_id )
    {
        return $this->send( $toUser, 'image', array( 'media_id' => $media_id ) );
    }

    /**
     * 发送语音消息
     * @param $toUser
     * @param $media_id
     * @return mixed
     */
    public function sendVoice( $toUser, $media_id )
    {
        return $this->send( $toUser, 'voice', array( 'media_id' => $media_id ) );
    }

    /**
     * 发送视频消息
     * @param        $toUser
     * @param        $media_id
     * @param        $title
     * @param string $desc
     * @return mixed
     */
    public function sendVideo( $toUser, $media_id, $title, $desc = '' )
    {
        return $this->send( $toUser, 'video', array(
            'media_id'    => $media_id,
            'title'       => $title,
            'description' => $desc,
        ) );
    }

    /**
     * 发送音乐消息
     * @param        $toUser
     * @param        $thumb_media_id
     * @param        $url
     * @param        $title
     * @param string $desc
     * @param string $hq_url
     * @return mixed
     */
    public function sendMusic( $toUser, $thumb_media_id, $url, $title, $desc = '', $hq_url = '' )
    {
        return $this->send( $toUser, 'music', array(
            'title'          => $title,
            'description'    => $desc,
            'musicurl'       => $url,
            'thumb_media_id' => $thumb_media_id,
            'hqmusicurl'     => $hq_url || $url,
        ) );
    }

    /**
     * 发送图文消息
     * @param $toUser
     * @param $articles
     * @return mixed
     */
    public function sendNews( $toUser, $articles )
    {
        return $this->send( $toUser, 'news', array(
            'articles' => $articles,
        ) );
    }
}