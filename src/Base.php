<?php
namespace johnxu\wechat;
/**
 * User: johnxu <fsyzxz@163.com> 549716096
 * HomePage: http://www.johnxu.net
 * Date: 2017/7/12
 */
/**
 * Class Base
 * @package johnxu\wechat
 */
class Base extends Error
{
    public $appid;
    public $appsecret;
    // 微信服务发来的消息
    public $message;
    // 微信api根地址
    public $api_uri = 'https://api.weixin.qq.com';
    // 验证令牌
    public $access_token;

    public function __construct()
    {
        // 基本配置
        $this->appid     = Config::get( 'appid' );
        $this->appsecret = Config::get( 'appsecret' );
        $this->setAccessToken();
        $this->setMessage();
    }

    /**
     * 获取实例
     * @param string $api
     * @return mixed
     */
    public function instance( $api )
    {
        $class = '\\Org\\Wechat\\' . ucfirst( $api );

        return new $class;
    }

    /**
     * 获取消息
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * 获取微信发来的消息
     * @return bool
     */
    public function setMessage()
    {
        if ( isset( $GLOBALS['HTTP_RAW_POST_DATA'] ) ) {
            $content = $GLOBALS['HTTP_RAW_POST_DATA'];
        } else {
            $content = file_get_contents( 'php://input' );
        }
        $xml_parser = xml_parser_create();
        if ( ! xml_parse( $xml_parser, $content, true ) ) {
            xml_parser_free( $xml_parser );

            return false;
        } else {
            $this->message = simplexml_load_string( $content, 'SimpleXMLElement', LIBXML_NOCDATA );
        }

        return true;
    }

    public function __get( $name )
    {
        return isset( $this->message->$name ) ? $this->message->$name : null;
    }

    /**
     * 获取消息类型
     * @return mixed
     */
    public function getMessageType()
    {
        if ( isset( $this->message->MsgType ) ) {
            return $this->message->MsgType;
        }
    }

    /**
     * 获取access_token
     * @return string
     */
    public function getAccessToken()
    {
        return $this->access_token;
    }

    /**
     * 设置access_token
     * @param bool $force 是否强制刷新access_token
     * @throws \Exception
     */
    public function setAccessToken( $force = false )
    {
        static $access_token;
        //缓存文件
        if ( ! $access_token ) {
            $cache_data = ( new Cache() )->read( $this->appid . $this->appsecret );
            if ( $force === false && $cache_data ) {
                $data = $cache_data;
            } else {
                $uri  = $this->api_uri . '/cgi-bin/token?grant_type=client_credential&appid=' . $this->appid . '&secret=' . $this->appsecret;
                $data = Http::get( $uri )->getBody();
                if ( isset( $data['errmsg'] ) ) {
                    throw new \Exception( $data['errmsg'] );
                }
                // 缓存access_token
                ( new Cache() )->write( $this->appid . $this->appsecret, $data, $data['expires_in'] - 200 );
            }
            $access_token = $data['access_token'];
        }
        $this->access_token = $access_token;
    }

    /**
     * 微信接口整合验证进行绑定
     * @return bool
     */
    public function valid()
    {
        if ( ! $_GET['echostr'] || ! $_GET['signature'] || ! $_GET['timestamp'] || ! $_GET['nonce'] ) {
            return false;
        }
        $signature = $_GET['signature'];
        $timestamp = $_GET['timestamp'];
        $nonce     = $_GET['nonce'];
        $echostr   = $_GET['echostr'];
        $token     = Config::get( 'token' );
        $tmpArr    = array( $token, $timestamp, $nonce );
        sort( $tmpArr );
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );
        if ( $tmpStr == $signature ) {
            echo $echostr;
            exit;
        } else {
            return false;
        }
    }
}