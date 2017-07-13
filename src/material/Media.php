<?php
/**
 * User: johnxu <fsyzxz@163.com>
 * HomePage: http://www.johnxu.net
 * Date: 2017/7/12
 */
namespace johnxu\wechat\material;

use johnxu\wechat\Http;

/**
 * 临时素材管理
 * Trait Media
 * @package johnxu\wechat\material
 */
trait Media
{
    /**
     * 上传临时素材
     * @param string $type 媒体文件类型，分别有图片（image）、语音（voice）、视频（video）和缩略图（thumb）
     * @param string $file
     * @return mixed
     */
    public function addMedia( $type, $file )
    {
        $uri      = $this -> api_uri . '/cgi-bin/media/upload?access_token=' . $this -> getAccessToken() . '&type=' . $type;
        $data     = array( 'media', $file );
        $response = Http ::upload( $uri, $data ) -> getBody();
        
        return $this -> get( $response );
    }
    
    /**
     * 获取临时素材
     * @param string $media_id
     * @return mixed
     */
    public function getMedia( $media_id )
    {
        $uri      = $this -> api_uri . "/cgi-bin/media/get?access_token={$this->access_token}&media_id={$media_id}";
        $response = Http ::get( $uri ) -> getBody();
        
        return $this -> get( $response );
    }
}