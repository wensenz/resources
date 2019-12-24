<?php
/**
 * Created by PhpStorm.
 * User: zhongzhengwen
 * Date: 2019/12/24
 * Time: 11:00 AM
 */

namespace console\controllers;


use common\plugin\pdf\parser;
use yii\console\Controller;

class TestController extends Controller
{

    public function actionTest()
    {
        $pdfParser = parser::getInstance();
        $pdf = $pdfParser->parseFile("/Users/zhongzhengwen/www/resources/uploadfile/file/test.pdf");
        $pages = $pdf->getPages();
        $pdfText = $pdf->getText();
        foreach ($pages as $page){
            echo $page->getText();
        }
    }
}