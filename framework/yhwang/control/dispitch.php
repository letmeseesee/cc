<?php

/**
 * Created by PhpStorm.
 * User: yhwang
 * Date: 15/10/18
 * Time: 下午2:16
 */
namespace framework\yhwang\control;
class dispitch
{
    public  $control;
    private $controller;
    private $action;
    private $param;
    /*
     * 由于写这个的时候,没有设置虚拟主机,所以才参数中会多一个cc,后期上传时要移除
     * 两种情况,一是带网站的,一是不带参数的
     * **/
    public function setMVC(){
        $request = $_SERVER['REQUEST_URI'];
        $request_array = explode('/',$request);
        //根据当前去除cc
//        array_shift($request_array);
//        array_shift($request_array);
        //取得当前的action和control
        $this->action = array_pop($request_array);
        $this->controller = array_pop($request_array);
        foreach($_POST as $key =>$value){
            $this->param[$key] = $value;
        }
        foreach($_GET as $key => $value){
            $this->param[$key] = $value;
        }
        $this->createControl();
    }
    public function getParam(){
        return $this->param;
    }
    public function getControl(){
        return $this->controller;
    }
    /*
     * 生成控制器的实例
     * 判断控制器和方法是否存在
     * 负责调用控制器的init方法
     * 具体调用类的方法交个其他部分来实现
     * **/
    public function createControl(){
        if($this->action && $this->controller){
            //正常的control/action的情况
        }else{//只写了控制器,没有写方法的情况
            $this->controller = $this->action;
            $this->action = "index";
        }
        //echo APP_PATH.$this->controller.".php";
        if(file_exists(APP_PATH.$this->controller.".php")){
            $control = new \web\control\test();
            if(method_exists($control,$this->action)){
                $action = $this->action;
                $control->init($this->param);
                $control->$action();
            }else{
                echo "没有这个action";
                exit;
            }
        }else{
            echo "没有这个控制器";
            exit;
        }
        $this->control = $control;
    }
}