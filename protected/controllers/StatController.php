<?php
include_once "Controller.php";
include_once "CharacterClass.php";
include_once "Character.php";
include_once "Race.php";
include_once "Spec.php";
include_once "Guild.php";

class StatController extends Controller
{
	public function indexAction() {
		$guildname = 'ЕКАТЕРИНБУРГ';

		$guild = Guild::model()->find('name=:name', array(':name'=>$guildname));

		if(!$guild) {
			$this->redirect('/');
		}
		$class_stat = Character::model()->get_class_stat($guild->id);

		$this->render("index", ['class_stat' => $class_stat]);
	}
}