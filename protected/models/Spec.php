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
}