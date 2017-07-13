<?php
/**
 * User: johnxu <fsyzxz@163.com>
 * HomePage: http://www.johnxu.net
 * Date: 2017/7/12
 */
namespace johnxu\wechat\material;

use johnxu\wechat\Http;

/**
 * 永久素材管理
 * Class Matter
 * @package johnxu\wechat\material
 */
trait Matter
{
    
    /**
     * 上传永久素材
     * @param string $type 媒体文件类型，分别有图片（image）、语音（voice）、视频（video）和缩略图（thumb）
     * @param string $file
     * @return mixed
     */
    public function addMaterial( $type, $file )
    {
        $uri      = $this -> api_uri . "/cgi-bin/material/add_material?access_token={$this->access_token}&type={$type}";
        $data     = array( 'media', $file );
        $response = Http ::upload( $uri, $data ) -> getBody();
        
        return $this -> get( $response );
    }
    
    /**
     * 上传永久视频
     * @param $file
     * @param $description
     */
    public function addVedioMaterial( $file, $description )
    {
        $uri = $this -> api_uri . "/cgi-bin/material/add_material?access_token={$this->access_token}&type=vedio";
        // TODO
    }
    
    /**
     * 获取永久素材
     * @param string $media_id
     * @return mixed
     */
    public function getMaterial( $media_id )
    {
        $uri      = $this -> api_uri . '/cgi-bin/material/get_material?access_token=' . $this -> getAccessToken();
        $data     = array( 'media_id' => $media_id );
        $response = Http ::post( $uri, $data ) -> getBody();
        
        return $this -> get( $response );
    }
    
    /**
     * 删除永久素材
     * @param string $media_id
     * @return mixed
     */
    public function delMaterial( $media_id )
    {
        $uri      = $this -> api_uri . '/cgi-bin/material/del_material?access_token=' . $this -> getAccessToken();
        $data     = array( 'media_id' => $media_id );
        $response = Http ::post( $uri, $data ) -> getBody();
        
        return $this -> get( $response );
    }
}