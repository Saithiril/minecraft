<?php
include_once("ARModel.php");

class User extends ARModel
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return "users";
    }

    public function relations() {
        return array(
            "permissions" => array(self::MANY_MANY, 'Permission', 'user_permissions', array('user_id', 'permission_id'))
        );
    }
}