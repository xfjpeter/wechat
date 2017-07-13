<?php
/**
 * User: johnxu <fsyzxz@163.com>
 * HomePage: http://www.johnxu.net
 * Date: 2017/7/12
 */

namespace johnxu\wechat;

/**
 * 长链接转短链接
 * Class ShortUrl
 * @package johnxu\wechat
 */
class Shorturl extends Base
{
    /**
     * 长链接转短链接
     * @param string $long_uri
     * @return array
     */
    public function makeShorUrl( $long_uri )
    {
        $uri   = $this -> api_uri . '/cgi-bin/shorturl?access_token=' . $this -> getAccessToken();
        $param = array(
            'action' => 'long2short', 'long_url' => $long_uri,
        );
        
        $response = Http ::post( $uri, $param ) -> getBody();
        
        return $this -> get( $response );
    }
}