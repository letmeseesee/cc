<?php
/**
 * Created by PhpStorm.
 * User: yhwang
 * Date: 2015/10/27
 * Time: 16:36
 */
namespace framework\yhwang\model\baseModel;
interface basesql {
    public function select($select);
    public function table($table);
    public function update($table);
    public function query($sql);
    public function join($joinTable);
    public function where($where);
    public function getOne();
    public function getAll();
    public function IfSuccess();
}