<?php
/**
 * Created by PhpStorm.
 * User: yhwang
 * Date: 2015/10/27
 * Time: 16:52
 */

namespace framework\yhwang\model;

/**sql的操作函数,1.0版本暂时只支持select的函数,其他的操作和复杂的sql操作都通过query函数来实现
 * 同时进行主从分离,sqlect和其他的操作通过不同的数据库来实现
 */
class sqlOperator implements baseModel\basesql{
    private $select = array();
    private $table;
    private $join = array();
    private $where;
    private $db;
    public function __construct(){
        $this->db = new baseModel\db();
    }
    //将select拆分
    public function select($select){
        if(is_array($select)){
            foreach($select as $key => $value){
                if(is_numeric($key)){
                    $this->select[] = $value;
                }else{
                    $this->select[$key] = $value;
                }
            }
        }elseif(is_string($select)){
            $selectArray = explode(",",$select);
            foreach($selectArray as $value){
                if(stristr($value,"as")){
                    $one_select = explode($value," ");
                    if(count($one_select) == 3) {
                        $this->select[$one_select[2]] = $one_select[0];
                    }else{
                        echo "你的sql语句有错误</br>";
                        exit;
                    }
                }else{
                    $this->select[] = trim($value," ");
                }
            }
        }else{
            echo "你的sql语句有错误</br>";
            exit;
        }
        $this->select = $select;
    }
    //将from拆分
    public function table($table){
        if(is_string($table)){
            $fromArray = explode($table,",");
            foreach ($fromArray as $value) {
                $value = trim($value," ");
                if(stristr($value," ")){
                    $one_from = explode($value," ");
                    if(count($one_from)  == 2){
                        $this->table[$one_from[0]] = $one_from[1];
                    }else{
                        echo "你的sql语句有错误</br>";
                        exit;
                    }
                }else{
                    $this->table[] = $value;
                }
            }
        }elseif(is_array($table)){
            foreach($table as $value){
                if(count($value) == 2){
                    $this->table[$value[0]] = $value[1];
                }else{
                    echo "你的sql语句有错误</br>";
                    exit;
                }
            }
        }else{
            echo "你的sql语句有错误</br>";
            exit;
        }
        $this->table = $this;
    }
    //join的结构
    //array('table'=>array('type','条件1','=<>......','条件2'))
    public function join($joinTable){
        if(is_string($joinTable)){
            //暂不支持,主要情况太多,到2.0时在支持
        }elseif(is_array($joinTable)){
            foreach($joinTable as $key => $vaule){
                if(is_string($key) && count($vaule) == 4){
                    $this->join[] = $joinTable;
                }else{
                    exit("sql错误");
                }
            }
        }else{
            exit("sql错误");
        }
        $this->join = $joinTable;
    }
    //保存where条件
    public function where($where){
        if(is_string($where)){
            $where_Array = explode($where,"AND");
            foreach($where_Array as $one_where){
                if(strstr($one_where,"=")){
                    //拼接时需要将两边的空格移除
                    $value = explode($one_where,"=");
                    $this->where[$value[0]] = $value[1];
                }else{
                    echo "你的sql语句有错误</br>";
                    exit;
                }
            }
        }elseif(is_array($where)){
            foreach($where as $value){
                if(count($value) == 2){
                    $this->where[$value[0]] = $value[1];
                }else{
                    echo "你的sql语句有错误</br>";
                    exit;
                }
            }
        }else{
            echo "你的sql语句有错误</br>";
            exit;
        }
        $this->where = $where;
    }
    //取得一个结果,或者一行结果,如果有参数就返回结果里面第一行中德结果
    public function getOne($coloum){
        if($coloum){
            return $this->db->result['data'][0][$coloum];
        }else{
            return $this->db->result['data'][0];
        }
    }
    //取得所有结果,如果coloum存在取得相应的列
    public function getAll($coloum){
        $resylt = array();
        if($coloum){
            foreach($this->db->result['data'] as $key => $value){
                foreach($coloum as $val){
                    $result[$key][$val] = $value[$val];
                }
            }
        }else{
            $resylt = $this->db->result['data'];
        }
    }
    //拼接sql,暂时不做
    public function ceeateSql(){

        return true;
    }
    //运行sql
    public function query($sql){
        if(!$sql){
            $sql = $this->ceeateSql();
        }
        $this->db->query($sql);
    }
}