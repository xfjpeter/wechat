<?php
/**
 * User: johnxu <fsyzxz@163.com>
 * HomePage: http://www.johnxu.net
 * Date: 2017/7/12
 */

namespace johnxu\wechat\user;

use johnxu\wechat\Http;

/**
 * 用户拉黑操作
 * Class Black
 * @package johnxu\wechat\user
 */
trait Black
{
    /**
     * 获取公众号的黑名单列表
     * @param string $begin_openid
     * @return mixed
     */
    public function getBlackList( $begin_openid = '' )
    {
        $uri      = $this -> api_uri . '/cgi-bin/tags/members/getblacklist?access_token=' . $this -> getAccessToken();
        $response = Http ::post( $uri, array( 'begin_openid' => $begin_openid ) ) -> getBody();
        
        return $this -> get( $response );
    }
    
    /**
     * 拉黑用户
     * @param array $opened_list
     * @return mixed
     */
    public function batchBlackList( array $opened_list )
    {
        $uri      = $this -> api_uri . '/cgi-bin/tags/members/batchblacklist?access_token=' . $this -> getAccessToken();
        $response = Http ::post( $uri, array( 'opened_list' => $opened_list ) ) -> getBody();
        
        return $this -> get( $response );
    }
    
    /**
     * 取消拉黑用户
     * @param array $opened_list
     * @return mixed
     */
    public function batchUnBlackList( array $opened_list )
    {
        $uri      = $this -> api_uri . '/cgi-bin/tags/members/batchunblacklist?access_token=' . $this -> getAccessToken();
        $response = Http ::post( $uri, array( 'opened_list' => $opened_list ) ) -> getBody();
        
        return $this -> get( $response );
    }
}