<?php
/**
 * User: johnxu <fsyzxz@163.com> 549716096
 * HomePage: http://www.johnxu.net
 * Date: 2017/7/12
 */
namespace johnxu\wechat;
use johnxu\wechat\customservice\CustomManage;
use johnxu\wechat\customservice\CustomMessage;

/**
 * 客服接口
 * Class Customeservice
 * @package johnxu\wechat
 */
class Customservice extends Base
{
    use CustomManage, CustomMessage;
}