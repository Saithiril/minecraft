<?php
include_once("ARModel.php");

class Spec extends ARModel
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return "specs";
    }

    public function find_by_name($name) {
        return $this->find('name=:name', array("name"=>$name));
    }
}