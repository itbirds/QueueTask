<?php

namespace QueueTask\Config;


/**
 * 配置文件类
 * Class Config
 * @package QueueTask\Config
 */
class Config
{

    /****************************** 队列存储方式 ********************************/
    /*********** mysql *************/
    const STORAGE_MYSQL = 'mysql';

    /*********** redis *************/
    const STORAGE_REDIS = 'redis';

    /*********** file *************/
    const STORAGE_FILE  = 'file';

    /************* 当前存储方式 **************/
    public static function getStorageType()
    {
        return self::STORAGE_MYSQL;
    }



    /****************************** MySql配置 ********************************/
    public static function getMySqlConfig()
    {
        return [
            'DB_HOST'       => '127.0.0.1',     //数据库地址
            'DB_PORT'       => '3306',          //数据库端口
            'DB_DATABASE'   => 'test',          //数据库名称
            'DB_CHARSET'    => 'utf8',          //数据库字符集
            'DB_USERNAME'   => 'root',          //用户名
            'DB_PASSWORD'   => 'root',          //密码
        ];
    }


    /****************************** Redis配置 ********************************/
    public static function getRedisConfig()
    {
        return [
            'DB_HOST'       => '127.0.0.1',     //数据库地址
            'DB_PORT'       => '6379',          //数据库端口
            'DB_DATABASE'   => '0',             //数据库名称
            'DB_PASSWORD'   => null,            //密码        无密码时，设置为null
        ];
    }


} 