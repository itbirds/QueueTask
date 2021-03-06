<?php

namespace QueueTask\Queue;

use QueueTask\Connection\Connection;
use QueueTask\Job\Job;
use QueueTask\Job\GeneralJob;
use QueueTask\Handler\JobHandler;

/**
 * 队列实体
 * Class Queue
 */
abstract class Queue implements QueueInterface
{

    /**
     * 连接对象
     * @var Connection
     */
    protected static $connection;

    protected function __construct(Connection $connection)
    {
        self::$connection = $connection;
    }

    /**
     * 弹出队列(弹出后队列中就没有这个任务了)
     * @param String $queueName 队列名称
     * @return Job
     */
    public function pop($queueName)
    {
        return self::$connection->pop($queueName);
    }

    /**
     * 入队列
     * @param Job $job
     * @return boolean
     */
    protected function push(Job $job)
    {
        return self::$connection->push($job);
    }

    /**
     * 延迟入队列
     * @param $delay
     * @param Job $job
     * @return boolean
     */
    protected function laterPush($delay , Job $job)
    {
        return self::$connection->laterOn($delay,$job);
    }

    /**
     * 入队列  (对外)
     * @param JobHandler $handler 回调类
     * @param String $func 方法名
     * @param array $param 参数
     * @param String $queueName 队列名
     * @return boolean
     */
    public function pushOn(JobHandler $handler, $func, array $param, $queueName)
    {
        $job = new GeneralJob(self::$connection->getType(),$queueName,$handler,$func,$param);
        return $this->push($job);
    }

    /**
     * 延迟入队列 (对外)
     * @param Int $delay 延迟时间/秒
     * @param JobHandler $handler 回调类
     * @param String $func 方法名
     * @param array $param 参数
     * @param String $queueName 队列名
     * @return boolean
     */
    public function laterOn($delay, JobHandler $handler, $func, array $param, $queueName)
    {
        $job = new GeneralJob(self::$connection->getType(),$queueName,$handler,$func,$param);
        return $this->laterPush($delay,$job);
    }


    /**
     * 关闭数据库连接
     */
    public function close()
    {
        self::$connection->close();
    }


}