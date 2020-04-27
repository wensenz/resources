<?php
/**
 * Created by PhpStorm.
 * User: zhongzhengwen
 * Date: 2019/12/24
 * Time: 11:00 AM
 */

namespace console\controllers;

use common\plugin\pdf\parser;
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

        \Yii::$app->queue->push(new userBehaviorJob([
            'id' => '83',
            'action' => 'reg',
        ]));

        // 延时加入队列
        \Yii::$app->queue->delay(10)->push(new userBehaviorJob([
            'id' => '21',
            'action' => 'sdgsdgsdf',
        ]));


    }

    public function actionRun()
    {
        echo 'hello run';
    }
}