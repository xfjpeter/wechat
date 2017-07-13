<?php
/**
 * User: johnxu <fsyzxz@163.com> 549716096
 * HomePage: http://www.johnxu.net
 * Date: 2017/7/12
 */
namespace johnxu\wechat;

use johnxu\wechat\button\Event;
use johnxu\wechat\button\Special;

/**
 * 自定义菜单管理
 * Class Button
 * @package johnxu\wechat
 */
class Button extends Base
{
    use Event, Special;

    /**
     * 创建普通菜单
     * @param mixed $button
     * @return array
     */
    public function create( $button )
    {
        $uri      = $this->api_uri . '/cgi-bin/menu/create?access_token=' . $this->getAccessToken();
        $response = Http::post( $uri, $button )->getBody();

        return $this->get( $response );
    }

    /**
     * 查询微信服务器上的菜单
     * @return array
     */
    public function query()
    {
        $uri      = $this->api_uri . '/cgi-bin/menu/get?access_token=' . $this->getAccessToken();
        $response = Http::get( $uri )->getBody();

        return $this->get( $response );
    }

    /**
     * 删除微信服务器上面的菜单
     * @return array
     */
    public function flush()
    {
        $uri      = $this->api_uri . '/cgi-bin/menu/delete?access_token=' . $this->getAccessToken();
        $response = Http::get( $uri )->getBody();

        return $this->get( $response );
    }

    /**
     * 获取自定义菜单配置项
     * @return array
     */
    public function getCurrentSelfMenuInfo()
    {
        $uri      = $this->api_uri . '/cgi-bin/get_current_selfmenu_info?access_token=' . $this->getAccessToken();
        $response = Http::get( $uri )->getBody();

        return $this->get( $response );
    }
}