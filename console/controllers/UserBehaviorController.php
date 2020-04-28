<?php


namespace console\controllers;

use common\services\queue\userBehaviorJob;
use yii\queue\redis\Command;

class UserBehaviorController extends Command
{
    public function __construct($id, $module, $config = [])
    {
        $behavior = new userBehaviorJob();
        $this->queue = $behavior->getQueue();
        parent::__construct($id, $module, $config);
    }
}