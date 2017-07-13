<?php
/**
 * User: johnxu <fsyzxz@163.com>
 * HomePage: http://www.johnxu.net
 * Date: 2017/7/12
 */
namespace johnxu\wechat\material;

use johnxu\wechat\Http;

/**
 * 图文素材管理
 * Class News
 * @package johnxu\wechat\material
 */
trait News
{
    /**
     * 上传图文消息内的图片获取URL
     * @param $file
     * @return mixed
     */
    public function addNewsImage( $file )
    {
        $uri      = $this -> api_uri . "/cgi-bin/media/uploadimg?access_token=" . $this -> getAccessToken();
        $data     = array( 'media', $file );
        $response = Http ::upload( $uri, $data ) -> getBody();
        
        return $this -> get( $response );
    }
    
    /**
     * 新增永久图文素材
     * @param $articles
     * @return mixed
     */
    public function addNews( $articles )
    {
        $uri      = $this -> api_uri . "/cgi-bin/material/add_news?access_token={$this->access_token}";
        $response = Http ::post( $uri, $articles ) -> getBody();
        
        return $this -> get( $response );
    }
    
    /**
     * 修改永久图文素材
     * @param $article
     * @return mixed
     */
    public function editNews( $article )
    {
        $uri      = $this -> apiUrl . "/cgi-bin/material/update_news?access_token={$this->access_token}";
        $response = Http ::post( $uri, $article ) -> getBody();
        
        return $this -> get( $response );
    }
}