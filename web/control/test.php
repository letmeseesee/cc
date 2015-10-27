<?php

/**
 * Created by PhpStorm.
 * User: yhwang
 * Date: 15/10/18
 * Time: 下午2:56
 */
namespace web\control;
class test extends \framework\yhwang\control\baseControl
{
    public function init($param){
        parent::init($param);
    }
    public function index(){
        $test = "test";
        $this->view->assign('index',$test);
        $this->view->display('test');
    }
}