<?php
/**
 * Created by PhpStorm.
 * User: yhwang
 * Date: 2015/10/27
 * Time: 16:52
 */

namespace framework\yhwang\model;


class sqlOperator implements baseModel\basesql{
    private $select = array();
    private $table;
    private $join = array();
    private $update;
    private $where;
    private $db;
    public function __construct(){
        $this->db = new \framework\yhwang\model\baseModel\db();
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
    public function update($table){
        $this->table = $this;
    }
    public function query($sql){
        $this->db->query($sql);
    }
    public function join($joinTable){
        $this->join = $joinTable;
    }
    public function where($where){
        $this->where = $where;
    }
    public function getOne(){

    }
    public function getAll(){

    }
    public function IfSuccess(){

    }
}