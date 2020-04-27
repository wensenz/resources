<?php


namespace common\services\queue;


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