<?php
/**
 * User: johnxu <fsyzxz@163.com>
 * HomePage: http://www.johnxu.net
 * Date: 2017/7/12
 */

namespace johnxu\wechat;

/**
 * 网页授权管理
 * Class Auth
 * @package johnxu\wechat
 */
class Oauth extends Base
{
    private function request( $type, $redirect_uri = '', $qrCode = false )
    {
        $status = isset( $_GET['code'] ) && isset( $_GET['state'] ) && $_GET['state'] == 'STATE';
        if ( $status ) {
            $uri = $this -> api_uri . "/sns/oauth2/access_token?appid=" . $this -> appid . "&secret=" . $this -> appsecret . "&code=" . $_GET['code'] . "&grant_type=authorization_code";
            
            return $this -> get( Http ::get( $uri ) -> getBody() );
        } else {
            $redirect_uri = $redirect_uri ? urlencode( $redirect_uri ) : urlencode( $this -> currentPageURL() );
            $uri          = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=" . $this -> appid . "&redirect_uri=" . $redirect_uri . "&response_type=code&scope=" . $type . "&state=STATE#wechat_redirect";
            header( 'location:' . $uri );
            die;
        }
    }
    
    /**
     * 获取用户openid
     * @param string $redirect_uri 重定向地址
     * @return array
     */
    public function snsapiBase( $redirect_uri = '' )
    {
        return $this -> request( 'snsapi_base', $redirect_uri );
    }
    
    /**
     * 是用来获取用户的基本信息的
     * @param string $redirect_uri 重定向地址
     * @return array|bool|mixed
     */
    public function snsapiUserinfo($redirect_uri = '')
    {
        $data = $this -> request( 'snsapi_userinfo', $redirect_uri );
        if ( isset( $data['openid'] ) ) {
            $uri = $this -> api_uri . "/sns/userinfo?access_token=" . $data['access_token'] . "&openid=" . $data['openid'] . "&lang=zh_CN";
            
            return $this -> get( Http ::get( $uri ) -> getBody() );
        }
    }
    
    /**
     * 获取当前页地址
     * @return string
     */
    public function currentPageURL()
    {
        $pageURL = 'http';
        
        if ( isset( $_SERVER["HTTPS"] ) && $_SERVER["HTTPS"] != "off" ) {
            $pageURL .= "s";
        }
        $pageURL .= "://";
        
        if ( $_SERVER["SERVER_PORT"] != "80" ) {
            $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
        } else {
            $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
        }
        
        return $pageURL;
    }
}