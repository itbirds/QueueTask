<?php

namespace QueueTask\Queue;

use QueueTask\Config\Config;
use QueueTask\Connection\Connection;
use QueueTask\Connection\ConnectAdapter;

class MySqlQueue extends Queue
{

    /**
     * 连接对象
     * @var Connection
     */
    protected static $connection;

    /**
     * 单例对象
     * @var MySqlQueue
     */
    private static $instance;

    protected function __construct(Connection $connection)
    {
        parent::__construct($connection);
    }

    public function __destruct()
    {
        self::$instance = null;
    }

    public static function getInstance()
    {
        if( self::$instance == null ) {
            self::$instance = new MySqlQueue(ConnectAdapter::getConnection(Config::STORAGE_MYSQL));
        }
        return self::$instance;
    }



} 