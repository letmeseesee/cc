<?php

/**
 * Created by PhpStorm.
 * User: yhwang
 * Date: 15/10/18
 * Time: 下午8:54
 */
namespace framework\yhwang\view\baseView;
interface baseView
{
    public function register($function);
    public function assign($viewvalue,$value);
    public function display($path);
}