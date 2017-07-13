<?php
/**
 * User: johnxu <fsyzxz@163.com> 549716096
 * HomePage: http://www.johnxu.net
 * Date: 2017/7/12
 */
namespace johnxu\wechat\customservice;

use johnxu\wechat\Http;

/**
 * 客服人员管理
 * Class CustomManage
 * @package johnxu\wechat\customservice
 */
trait CustomManage
{
    /**
     * 添加客服
     * @param $post
     * @return array|mixed
     */
    public function addCustomer( $post )
    {
        $uri    = $this -> api_uri . '/customservice/kfaccount/add?access_token=' . $this -> getAccessToken();
        $response = Http ::post( $uri, $post );
        
        return $this -> get( $response ) -> getBody();
    }
    
    /**
     * 修改客服帐号
     * @param $post
     * @return array|mixed
     */
    public function updateCustomer( $post )
    {
        $uri    = $this -> api_uri . '/customservice/kfaccount/update?access_token=' . $this -> getAccessToken();
        $response = Http ::post( $uri, $post );
        
        return $this -> get( $response ) -> getBody();
    }
    
    /**
     * 删除客服帐号
     * @param string $kf_account 客服帐号
     * @return array|mixed
     */
    public function delCustomer( $kf_account )
    {
        $uri    = $this -> api_uri . '/customservice/kfaccount/del?access_token=' . $this -> getAccessToken() . '&kf_account=' . $kf_account;
        $response = Http ::get( $uri ) -> getBody();
        
        return $this -> get( $response );
    }
    
    /**
     * 设置客服帐号的头像
     * @param       $kf_account
     * @param array $file 上传文件，格式array('mediaId', '文件路径')
     * @return array|mixed
     */
    public function uploadheadimg( $kf_account, $file )
    {
        $uri    = $this -> api_uri . '/customservice/kfaccount/uploadheadimg?access_token=' . $this -> getAccessToken() . '&kf_account=' . $kf_account;
        $response = Http ::upload( $uri, $file ) -> getBody();
        
        return $this -> get( $response );
    }
    
    /**
     * 获取所有客服账号
     * @return array|mixed
     */
    public function getkflist()
    {
        $uri    = $this -> api_uri . '/cgi-bin/customservice/getkflist?access_token=' . $this -> getAccessToken();
        $response = Http ::get( $uri ) -> getBody();
        
        return $this -> get( $response );
    }
}