<?php


namespace common\services\queue;


use common\services\exception\TemporaryException;
use yii\base\BaseObject;
use yii\console\Exception;
use yii\queue\redis\Queue;
use yii\queue\RetryableJobInterface;

abstract class BaseJob extends BaseObject implements RetryableJobInterface
{
    // 重试次数
    const RETRY_TIMES = 3;

    protected $queueName;               // 队列名称
    protected $queueObjectName;         // 队列对象名称
    protected $redisDatabase = 0;       // 可以做redis数据扩展 未实现
    protected $runningTime = 59;             // listen运行时间

    public function __construct($config = [])
    {
        $this->init();
        parent::__construct($config);
    }

    public function init()
    {
        $this->setQueueObjName();
        $this->setQueueName();
        $this->setRunningTime();
        if (!$this->queueName || !$this->queueObjectName) {
            throw new Exception('must have queue-object && queue-name');
        }
        \Yii::$app->setComponents([$this->queueObjectName => [
            'class' => RewriteQueue::class,
            'as log' => \yii\queue\LogBehavior::class,
            'redis' => 'redis', // 连接组件或它的配置
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

    abstract public function setRunningTime();

    public function push($delay = 0)
    {
        \Yii::$app->{$this->queueObjectName}->delay($delay)->push($this);
    }

    public function getTtr()
    {
        // 重试间隔
        return 300;
    }

    public function canRetry($attempt, $error)
    {
        return ($attempt < self::RETRY_TIMES) && ($error instanceof TemporaryException);
    }

    /**
     * 消费队列的时候会使用到这个类
     * @return Queue
     */
    public function getQueue()
    {
        return new RewriteQueue(['channel' => $this->queueName, 'runningTime' => $this->runningTime]);
    }

    /**
     * 用来调试的DEMO
     * @param $repeat
     * @param int $timeout
     */
    public function testRun($repeat, $timeout = 3)
    {
        $queue = new RewriteQueue(['channel' => $this->queueName]);
        $queue->run($repeat, $timeout);
    }


}