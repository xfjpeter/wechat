<?php
/**
 * User: johnxu <fsyzxz@163.com> 549716096
 * HomePage: http://www.johnxu.net
 * Date: 2017/7/12
 */
namespace johnxu\wechat;
/**
 * 配置文件操作
 * Class Config
 * @package johnxu\wechat
 */
class Config
{
    private static $_config
        = array(
            'appid'          => '', // 设置微信appid
            'appsecret'      => '', // 设置微信密钥appsecret
            'token'          => '', // 设置微信校验token
            'encodingaeskey' => '', // 设置微信消息加密密钥
        );

    /**
     * 批量设置配置文件
     * @param array $config
     */
    public static function batch( array $config )
    {
        foreach ( $config as $key => $item ) {
            self::set( $key, $item );
        }
    }

    /**
     * 设置配置文件值
     * @param string $key
     * @param string $value
     */
    public static function set( $key, $value )
    {
        if ( array_key_exists( $key, self::$_config ) ) {
            self::$_config[ $key ] = $value;
        }
    }

    /**
     * 获取微信配置文件值
     * @param string $key
     * @return bool|mixed
     */
    public static function get( $key )
    {
        if ( array_key_exists( $key, self::$_config ) ) {
            return self::$_config[ $key ];
        }

        return false;
    }
}