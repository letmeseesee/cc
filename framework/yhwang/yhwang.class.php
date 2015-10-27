<?php
/**
 * Created by PhpStorm.
 * User: yhwang
 * Date: 15/10/11
 * Time: 下午3:46
 */

namespace framework\yhwang;


class yhwang
{
    /*
     * 驱动整个系统
     * 加载db函数
     * 分发路由加载控制器
     * 渲染html(暂时有原生,缓存等后面再写)
     * */
    public static function run(){
        spl_autoload_register('framework\yhwang\yhwang::autoload');//注册自动加载
        //路由分发
        $mvc = new \framework\yhwang\control\dispitch();
        $mvc->setMVC();
    }

    /*
     * 为了简便类的加载,每个文件的命名空间都是完全的相对于根目录来的
     * 这样的话就可以直接拼接目录,用完全路径的方式来加载了(也就是相对于cc的路径)
     * (目前先这样吧)
     * **/
    public static function autoload($class){
        //echo $class."</br>";
        //去除两边的'/'后在拼接,因为在不设置namespace时必须要写相对于根空间,但是其他设置的时候特意没写,干脆就这样办了
        $class_path = ltrim($class,'\\');
        $file = str_replace("\\","/",$class_path);
        //echo ROOT_PATH;
        $file = ROOT_PATH.$file;
        //echo $file."</br>";
        require_once($file.".php");
    }
}