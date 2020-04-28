<?php


namespace common\services\queue;


use yii\base\Exception;
use yii\queue\ExecEvent;

class userBehaviorJob extends BaseJob
{

    public $id;
    public $action;

    const QUEUE_OBJECT_NAME = 'queue';
    const QUEUE_NAME = 'queue-test';

    /**
     * @inheritDoc
     */
    public function execute($queue)
    {
        var_dump($this->id, $this->action);
        \Yii::info("exec {$this->id} , {$this->action} info");
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
}