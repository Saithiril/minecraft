<?php
include_once("ARModel.php");

class Character extends ARModel
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return "characters";
    }

    public function find_by_name($name) {
        return $this->find('name=:name', array("name"=>$name));
    }

    public function find_guild_members($guild_id) {
        return $this->_find_all('guild_id=:id', array('id' => $guild_id));
    }
}