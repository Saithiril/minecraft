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

    public function relations() {
        return array(
            "className" => array(self::HAS_ONE, 'CharacterClass', '', array('class', 'id')),
            "_race" => array(self::HAS_ONE, 'Race', '', array('class', 'id')),
        );
    }

    public function find_by_name($name) {
        return $this->find('name=:name', array("name"=>$name));
    }

    public function find_guild_members($guild_id, $start=0, $count=10) {
        return $this->_find_all('guild_id=:id', array('id' => $guild_id), $start, $count);
    }

    public function rules() {
        return array(
            'update' => array('is_active', 'wait_delete')
        );
    }
}