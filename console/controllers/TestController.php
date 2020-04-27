<?php
/**
 * Created by PhpStorm.
 * User: zhongzhengwen
 * Date: 2019/12/24
 * Time: 11:00 AM
 */

namespace console\controllers;

use common\plugin\pdf\parser;
use common\services\queue\runJob;
use common\services\queue\runJober;
use common\services\queue\userBehaviorJob;
use common\services\queue\workerJob;
use yii\console\Controller;

class TestController extends Controller
{

    public function actionTest()
    {
        echo 'hello console';
//        $pdfParser = parser::getInstance();
//        $pdf = $pdfParser->parseFile("/Users/zhongzhengwen/www/resources/uploadfile/file/test.pdf");
//        $pages = $pdf->getPages();
//        $pdfText = $pdf->getText();
//        foreach ($pages as $page){
//            echo $page->getText();
//        }

//        \Yii::$app->setComponents(['queue2' => [
//            'class' => \yii\queue\redis\Queue::class,
//            'as log' => \yii\queue\LogBehavior::class,
//            'redis' => 'redis', // 连接组件或它的配置
//            'channel' => 'queue-worker', // Queue channel key
//        ]]);

//        \Yii::$app->queue->push(new userBehaviorJob([
//            'id' => '83',
//            'action' => 'reg',
//        ]));

        $userWok = new userBehaviorJob([
            'id' => '23',
            'action' => 'reg',
        ]);
        $userWok->push();

        // 延时加入队列
        $worker = new runJob([
            'id' => '23',
            'name' => '侧翻cvcv3bfs',
        ]);
        $userWok->push(3);

    }

    public function actionRun()
    {
        $runJob = new runJob();
        $runJob->run();
    }

    public function actionListen()
    {
//        $runJob = new runJob();
//        $runJob->listen();

        $userJob = new userBehaviorJob();
        $userJob->listen();
    }

    public function actionInfo()
    {
        $runJob = new runJob();
        $runJob->info();
    }
}