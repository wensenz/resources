<?php


namespace common\services\queue;


use common\services\exception\TemporaryException;

class userBehaviorJob extends BaseJob
{
    /** @var 队列内容 */
    public $id;
    public $action;

    const QUEUE_OBJECT_NAME = 'queue';
    const QUEUE_NAME = 'queue-test';
    const RUNNING_TIME = 10;

    /**
     * @inheritDoc
     */
    public function execute($queue)
    {
        var_dump($this->id, $this->action);
        \Yii::info("exec {$this->id} , {$this->action} info");
        throw new TemporaryException('抛出异常用于重试'); // 此处可以创建独立的异常类来处理
        return false;
    }

    public function setQueueName()
    {
        $this->queueName = self::QUEUE_NAME;
    }

    public function setQueueObjName()
    {
        $this->queueObjectName = self::QUEUE_OBJECT_NAME;
    }

    public function setRunningTime(){
        $this->runningTime = self::RUNNING_TIME;
    }
}