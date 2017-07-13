<?php
/**
 * User: johnxu <fsyzxz@163.com> 549716096
 * HomePage: Http://www.johnxu.net
 * Date: 2017/7/12
 */
namespace johnxu\wechat\message;

use johnxu\wechat\Http;

/**
 * 群发管理
 * Class SendAll
 * @package johnxu\wechat\message
 */
trait SendAll
{
    /**
     * 群发消息正式发送
     * @param $data
     * @return mixed
     */
    public function sendAll( $data )
    {
        $uri      = $this -> api_uri . '/cgi-bin/message/mass/sendall?access_token=' . $this -> getAccessToken();
        $response = Http ::post( $uri, $data ) -> getBody();
        
        return $this -> get( $response );
    }
    
    /**
     * 群发消息预览发送
     * @param $data
     * @return mixed
     */
    public function preview( $data )
    {
        $uri      = $this -> api_uri . '/cgi-bin/message/mass/preview?access_token=' . $this -> getAccessToken();
        $response = Http ::post( $uri, $data ) -> getBody();
        
        return $this -> get( $response );
    }
    
    /**
     * 删除群发消息
     * @param $data
     * @return mixed
     */
    public function delMassMessage( $data )
    {
        $uri      = $this -> api_uri . '/cgi-bin/message/mass/delete?access_token=' . $this -> getAccessToken();
        $response = Http ::post( $uri, $data ) -> getBody();
        
        return $this -> get( $response );
    }
    
    /**
     * 查询群发消息发送状态
     * @param $data
     * @return mixed
     */
    public function getMassMessageState( $data )
    {
        $uri      = $this -> api_uri . '/cgi-bin/message/mass/get?access_token=' . $this -> getAccessToken();
        $response = Http ::post( $uri, $data ) -> getBody();
        
        return $this -> get( $response );
    }
    
    /**
     * 群发消息推送事件
     * @return bool
     */
    public function isMassMessage()
    {
        return $this -> message -> MsgType == 'event' && $this -> message -> Event == 'MASSSENDJOBFINISH' && isset( $this -> message -> TotalCount );
    }
}