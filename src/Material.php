<?php
/**
 * User: johnxu <fsyzxz@163.com>
 * HomePage: http://www.johnxu.net
 * Date: 2017/7/12
 */

namespace johnxu\wechat;


use johnxu\wechat\material\Matter;
use johnxu\wechat\material\Media;
use johnxu\wechat\material\News;

/**
 * 素材管理
 * Class Material
 * @package johnxu\wechat
 */
class Material extends Base
{
    use Media, Matter, News;
    
    /**
     * 获取素材总数
     * @return array
     */
    public function total()
    {
        $uri      = $this -> api_uri . '/cgi-bin/material/get_materialcount?access_token=' . $this -> getAccessToken();
        $response = Http ::get( $uri ) -> getBody();
        
        return $this -> get( $response );
    }
    
    /**
     * 获取素材列表
     * @param $params
     * @return array
     */
    public function lists( $params )
    {
        $uri      = $this -> api_uri . '/cgi-bin/material/batchget_material?access_token=' . $this -> getAccessToken();
        $response = Http ::post( $uri, $params ) -> getBody();
        
        return $this -> get( $response );
    }
}