<?php


namespace common\services\queue;


use yii\base\BaseObject;
use yii\console\Exception;
use yii\queue\JobInterface;
use yii\queue\redis\Queue;

abstract class BaseJob extends BaseObject implements JobInterface
{
    // 重试次数
    const RETRY_TIMES = 3;


    protected $queueName;
    protected $queueObjectName;
    protected $redisDatabase = 0;       // 可以做redis数据扩展

    public function __construct($config = [])
    {
        $this->init();
        parent::__construct($config);
    }

    public function init()
    {
        $this->setQueueObjName();
        $this->setQueueName();
        if (!$this->queueName || !$this->queueObjectName) {
            throw new Exception('must have queue-object && queue-name');
        }
        \Yii::$app->setComponents([$this->queueObjectName => [
            'class' => Queue::class,
            'as log' => \yii\queue\LogBehavior::class,
            'redis' => 'redis', // 连接组件或它的配置
            'ttr' => 300,                       // Max time for anything job handling
            'attempts' => self::RETRY_TIMES,    // Max number of attempts
            'channel' => $this->queueName,
        ]]);
    }

    /**
     * @inheritDoc
     * @param $queue
     */
    abstract public function execute($queue);

    abstract public function setQueueName();

    abstract public function setQueueObjName();

    public function push($delay = 0)
    {
        \Yii::$app->{$this->queueObjectName}->delay($delay)->push($this);
    }

    /**
     * 消费队列的时候会使用到这个类
     * @return Queue
     */
    public function getQueue()
    {
        return new Queue(['channel' => $this->queueName]);
    }
}