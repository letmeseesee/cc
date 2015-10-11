<?php

/**
 * Created by PhpStorm.
 * User: yhwang
 * Date: 15/10/11
 * Time: 下午3:35
 */
/*
 * 所有的路径都带有后面的'/'
 * **/
define("ROOT_PATH",$_SERVER['DOCUMENT_ROOT']."/cc/");//根目录的路径
define("CONTROL_PATH",ROOT_PATH."control/");
define("MODEL_PATH",ROOT_PATH."model/");
define("VIEW_PATH",ROOT_PATH."view/");
define("CORE_PATH",__DIR__.'/yhwang/');
define("CORE_FILE",".class.php");
define("VIEW_FILE",".tpl");





/*
 * 开始系统
 * */
require CORE_PATH."yhwang".CORE_FILE;

/*
 * 驱动系统
 * **/
framework\yhwang\yhwang::run();