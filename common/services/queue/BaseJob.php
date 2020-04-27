<?php


namespace common\services\queue;


use yii\base\BaseObject;
use yii\queue\JobInterface;

class BaseJob  extends BaseObject implements JobInterface
{
    // 重试次数
    public $retryTime = 3;

    // 重试间隔
    public $retryInterval = 1200;


    /**
     * @inheritDoc
     */
    public function execute($queue)
    {
        // TODO: Implement execute() method.
    }

    public function getTtr()
    {
        return $this->retryInterval;
    }

    public function canRetry($attempt, $error)
    {
        return ($attempt < $this->retryTime) && ($error instanceof TemporaryException);
    }
}