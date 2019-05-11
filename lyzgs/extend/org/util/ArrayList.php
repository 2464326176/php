<?php
/**
 * Created by PhpStorm.
 * User: 刘宇航
 * Qq:2464326176
 * Date: 2018/1/27 0027
 * Time: 16:20
 */
namespace org\util;


class ArrayList
{
    /* 成员变量 */
    var $url;
    var $title;

    /* 成员函数 */
    function setUrl($par){
        $this->url = $par;
    }

    function getUrl(){
        echo $this->url . PHP_EOL;
    }

    function setTitle($par){
        $this->title = $par;
    }

    function getTitle(){
        echo $this->title . PHP_EOL;
    }

}


?>