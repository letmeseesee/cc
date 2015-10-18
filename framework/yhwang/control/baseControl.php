<?php
/**
 * Created by PhpStorm.
 * User: yhwang
 * Date: 15/10/18
 * Time: 下午2:58
 */

namespace framework\yhwang\control;

abstract class baseControl
{
    protected $view;
    protected $param;
    //处理一些公共的操作
    public function init($param){
        //初始化参数
        $this->param = $param;
        $this->view = new \framework\yhwang\view\viewOperator();
        //判断是否登录
        $this->judgeLogin();

    }
    public function judgeLogin(){
        //echo "基类中的登录判断";
        return true;
    }
}