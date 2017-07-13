<?php
/**
 * User: johnxu <fsyzxz@163.com> 549716096
 * HomePage: http://www.johnxu.net
 * Date: 2017/7/12
 */
namespace johnxu\wechat\button;

use johnxu\wechat\Http;

/**
 * 个性化菜单管理
 * trait Special
 * @package johnxu\wechat\button
 */
trait Special
{
    /**
     * 创建个性化菜单
     * @param $button
     * @return mixed
     */
    public function createSpecialButton( $button )
    {
        $uri      = $this->api_uri . '/cgi-bin/menu/addconditional?access_token=' . $this->getAccessToken();
        $response = Http::post( $uri, $button )->getBody();

        return $this->get( $response );
    }

    /**
     * 删除个性化菜单
     * @return mixed
     */
    public function delSpecialButton()
    {
        $uri      = $this->api_uri . '/cgi-bin/menu/delconditional?access_token=' . $this->getAccessToken();
        $response = Http::post( $uri )->getBody();

        return $this->get( $response );
    }

    /**
     * 测试个性化菜单匹配结果
     * @param $user_id
     * @return mixed
     */
    public function trySpecialButton( $user_id )
    {
        $uri      = $this->api_uri . '/cgi-bin/menu/trymatch?access_token=' . $this->getAccessToken();
        $response = Http::post( $uri, array('user_id' => $user_id) )->getBody();

        return $this->get( $response );
    }
}