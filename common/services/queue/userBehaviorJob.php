<?php


namespace common\services\queue;


class userBehaviorJob extends BaseJob
{

    public $id;
    public $action;

    /**
     * @inheritDoc
     */
    public function execute($queue)
    {
        var_dump($this->id, $this->action);
        return false;
    }
}