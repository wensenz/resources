<?php


namespace common\services\queue;

use yii\queue\redis\Queue;

class runJob extends BaseJob
{
    public $id;
    public $name;

    const QUEUE_OBJECT_NAME = 'queue2';
    const QUEUE_NAME = 'queue-worker';

    public function __construct($config = [])
    {
        parent::__construct($config);
    }

    /**
     * @inheritDoc
     */
    public function execute($queue)
    {
        echo $this->id, ' - ', $this->name , "\n";
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