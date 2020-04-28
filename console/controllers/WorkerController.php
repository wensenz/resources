<?php


namespace console\controllers;


use common\services\queue\runJob;
use yii\queue\redis\Command;

class WorkerController extends Command
{
    public function __construct($id, $module, $config = [])
    {
        $worker = new runJob();
        $this->queue = $worker->getQueue();
        parent::__construct($id, $module, $config);
    }
}