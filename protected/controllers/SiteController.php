<?php
include "Controller.php";
include "Guild.php";
include "Character.php";

class SiteController extends Controller
{
	public function indexAction() {
		$guildname = 'ЕКАТЕРИНБУРГ';

		$guild = Guild::model()->find('name=:name', array(':name'=>$guildname));

		$characters = Character::model()->find_guild_members($guild->id);

		$data = array("characters" => $characters, 'guild' => $guild);

		$this->render("index", $data);
	}

	public function refreshAction() {
		$guildname = 'ЕКАТЕРИНБУРГ';

		$guild = Guild::model()->find('name=:name', array(':name'=>$guildname));

		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, "https://eu.api.battle.net/wow/guild/Голдринн/$guildname?fields=members&locale=ru_RU&apikey=f2ppxyc6frxaqhw7eg298hh5gb6za92j");
		curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
		$data = curl_exec($curl);
		curl_close($curl);
		$guild_info = json_decode($data);

		foreach($guild_info->members as $member) {
			if(!Character::model()->find_by_name($member->character->name)) {
				$character = Character::model();
				$character->guild_id = $guild->id;
				$character->name = $member->character->name;
				$character->realm = $member->character->realm;
				$character->battlegroup = $member->character->battlegroup;
				$character->class = $member->character->class;
				$character->race = $member->character->race;
				$character->gender = $member->character->gender;
				$character->level = $member->character->level;
				$character->achievementPoints = $member->character->achievementPoints;
				$character->thumbnail = $member->character->thumbnail;
				$character->gender = $member->character->gender;
				$character->rank = $member->rank;
				$character->save();
			}
		}
		$this->redirect('/');
	}
}