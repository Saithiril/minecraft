<?php
include_once("ARModel.php");
include_once ("Spec.php");

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
            "_race" => array(self::HAS_ONE, 'Race', '', array('race', 'id')),
            "specs" => array(self::MANY_MANY, 'Spec', 'characters_specs', array('character_id', 'spec_id'))
        );
    }

    public function find_by_name($name) {
        return $this->find('name=:name', array("name"=>$name));
    }

    public function find_guild_members($guild_id, $start=0, $count=10) {
        return $this->_find_all('guild_id=:id', array('id' => $guild_id), $start, $count);
    }

    public function get_class_stat($guild_id, $hlevel=true) {
        $query = $hlevel ? "AND ch.level=100" : '';
        $result = $this->getDbConnection()->prepare("SELECT count(ch.id) as count, cl.name from characters as ch JOIN classes as cl ON ch.class=cl.id WHERE ch.guild_id=:guild_id $query AND is_active=1 AND wait_delete=0 GROUP BY ch.class");
        $result->execute( array(
            'guild_id' => $guild_id,
        ));
        return $result->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE);
    }

    public function rules() {
        return array(
            'update' => array('is_active', 'wait_delete', 'calcClass', 'faction', 'totalHonorableKills', 'guild_id', 'lastModified'),
            'order' => array('name', 'class', 'level', 'race', 'achievementPoints', 'rank', 'is_active', 'wait_delete'),
        );
    }
}