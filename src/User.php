<?php
/**
 * User: johnxu <fsyzxz@163.com>
 * HomePage: http://www.johnxu.net
 * Date: 2017/7/12
 */

namespace johnxu\wechat;

use johnxu\wechat\user\Black;

/**
 * 用户管理
 * Class User
 * @package johnxu\wechat
 */
class User extends Base
{
    use Black;
    
    /**
     * 设置备注名称
     * @param string $openid 用户微信号
     * @param string $remark 用户备注名称
     * @return array
     */
    public function setRemark( $openid, $remark )
    {
        $uri      = $this -> api_uri . '/cgi-bin/user/info/updateremark?access_token=' . $this -> getAccessToken();
        $response = Http ::post( $uri, array( 'openid' => $openid, 'remark' => $remark ) );
        
        return $this -> get( $response );
    }
    
    /**
     * 获取用户基本信息
     * @param string $openid
     * @return array
     */
    public function getUserInfo( $openid )
    {
        $uri      = $this -> api_uri . "/cgi-bin/user/info?access_token={$this->access_token}&openid={$openid}&lang=zh_CN";
        $response = Http ::get( $uri ) -> getBody();
        
        return $this -> get( $response );
    }
    
    /**
     * 批量获取用户基本信息
     * @param $param
     * @return array
     */
    public function getUserInfoList( $param )
    {
        $uri      = $this -> api_uri . '/cgi-bin/user/info/batchget?access_token=' . $this -> getAccessToken();
        $response = Http ::post( $uri, $param ) -> getBody();
        
        return $this -> get( $response );
    }
    
    /**
     * 获取用户列表
     * @param $next_openid
     * @return array
     */
    public function getUserList( $next_openid = '' )
    {
        $uri = $this -> api_uri . '/cgi-bin/user/get?access_token=' . $this -> getAccessToken();
        if ( $next_openid )
            $uri .= '&next_openid=' . $next_openid;
        $response = Http ::get( $uri ) -> getBody();
        
        return $this -> get( $response );
    }
}