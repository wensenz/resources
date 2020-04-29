<?php


namespace common\services\queue;


use yii\queue\cli\LoopInterface;
use yii\queue\redis\Queue;

class RewriteQueue extends Queue
{
    /**
     * 控制程序执行时长
     * @var int
     */
    public $runningTime  = 59;

    public function run($repeat, $timeout = 0)
    {
        return $this->runWorker(function (LoopInterface $loop) use ($repeat, $timeout) {
            $this->openWorker();
            $inTime = time();
            while ($loop->canContinue()) {
                if (($payload = $this->reserve($timeout)) !== null) {
                    list($id, $message, $ttr, $attempt) = $payload;
                    if ($this->handleMessage($id, $message, $ttr, $attempt)) {
                        $this->delete($id);
                    }
                } elseif (!$repeat) {
                    break;
                }
                if((time() - $inTime) >= $this->runningTime)
                {
                    break;
                }
            }
            $this->closeWorker();
        });
    }
}