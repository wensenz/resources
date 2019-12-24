<?php
/**
 * Created by PhpStorm.
 * User: zhongzhengwen
 * Date: 2019/12/24
 * Time: 10:40 AM
 */

namespace common\plugin\pdf;

class parser
{
    private static $parserObj;

    /**
     * @return \Smalot\PdfParser\Parser
     */
    public static function getInstance()
    {
        if (null === static::$parserObj) {
            self::$parserObj = new \Smalot\PdfParser\Parser();
        }
        return static::$parserObj;
    }

    private function __construct()
    {
    }

    private function __clone()
    {
    }
}