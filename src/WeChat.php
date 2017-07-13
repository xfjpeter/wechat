<?php
/**
 * User: johnxu <fsyzxz@163.com> 549716096
 * HomePage: http://www.johnxu.net
 * Date: 2017/7/12
 */
namespace johnxu\wechat;
class WeChat
{
    //连接
    protected static $link;

    /**
     * @param $method
     * @param $params
     * @return \Org\Wechat\Base
     */
    public function __call( $method, $params )
    {
        if ( is_null( self::$link ) ) {
            self::$link = new Base();
        }
        if ( method_exists( self::$link, $method ) ) {
            return call_user_func_array( [ self::$link, $method ], $params );
        }
    }

    /**
     * @param $name
     * @param $arguments
     * @return \Org\Wechat\Base
     */
    public static function __callStatic( $name, $arguments )
    {
        static $link;
        if ( is_null( $link ) ) {
            $link = new static();
        }

        return call_user_func_array( [ $link, $name ], $arguments );
    }
}