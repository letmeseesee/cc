<?php
/**
 * Created by PhpStorm.
 * User: yhwang
 * Date: 15/10/18
 * Time: 下午9:03
 */

namespace framework\yhwang\view\baseView;


class orangealView implements baseView
{
    protected $param;
    /*
     *
     * 传递参数
     * **/
    public function assign($viewvalue,$value){
        //因为是原生所以并不做处理
        $this->param[$viewvalue] = $value;
    }
    /*
     * 渲染页面
     * **/
    public function display($path){
        //因为是原生所以并不做处理,直接加载页面
            //var_dump(ROOT_PATH."web/view/".$path.'.html');
        foreach($this->param as $key => $value){
            $$key = $value;
        }
        ob_start();
        require_once(ROOT_PATH."web/view/".$path.'.html');
        $html = ob_get_contents();
        ob_clean();
        echo $html;
    }
    /*
     * 注册函数
     * **/
    public function register($function){
        //因为是原生所以并不做处理
    }
}