<?php
/**
 * User: johnxu <fsyzxz@163.com>
 * HomePage: http://www.johnxu.net
 * Date: 2017/7/12
 */

namespace johnxu\wechat;

/**
 * 二维码管理
 * Class Qrcode
 * @package johnxu\wechat
 */
class Qrcode extends Base
{
    protected $uri = 'https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=';
    
    /**
     * 创建临时二维码
     * @param array $param
     * @return array
     */
    public function create( array $param )
    {
        $expire   = isset( $param['expire_seconds'] ) ? $param['expire_seconds'] : 604800;
        $uri      = $this -> uri . $this -> getAccessToken();
        $data     = array(
            'action_name' => 'QR_SCENE', 'expire_seconds' => $expire, 'action_info' => [ 'scene' => $param ],
        );
        $response = Http ::post( $uri, $data ) -> getBody();
        
        return $this -> get( $response );
    }
    
    /**
     * 创建永久二维码
     * @param array $param
     * @return array
     */
    public function createLimitCode( array $param )
    {
        $uri      = $this -> uri . $this -> getAccessToken();
        $data     = array(
            'action_name' => 'QR_LIMIT_SCENE', 'action_info' => [ 'scene' => $param ],
        );
        $respones = Http ::post( $uri, $data ) -> getBody();
        
        return $this -> get( $respones );
    }
    
    /**
     * 通过ticket获二维码图片
     * @param $ticket
     * @return string
     */
    public function getQrcode( $ticket )
    {
        return "https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=" . urlencode( $ticket );
    }
}