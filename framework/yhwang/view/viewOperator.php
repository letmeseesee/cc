<?php
/**
 * Created by PhpStorm.
 * User: yhwang
 * Date: 15/10/18
 * Time: 下午9:07
 */

namespace framework\yhwang\view;


class viewOperator implements \framework\yhwang\view\baseView\baseView
{
    private $view;
    public function __construct(){
        //根据配置文件生成相应的view,因为现在就是orangealView所以直接生成
        $this->view = new \framework\yhwang\view\baseView\orangealView();
    }
    public function assign($viewvalue,$value){
        $this->view->assign($viewvalue,$value);
    }
    public function display($path){
        $this->view->display($path);
    }
    public function register($function){
        $this->view->register($function);
    }
}