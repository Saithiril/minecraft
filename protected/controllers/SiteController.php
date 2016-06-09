<?php
include_once "Controller.php";
include_once "Guild.php";
include_once "Character.php";
include_once "CharacterClass.php";
include_once "Race.php";

class SiteController extends Controller
{
	public function indexAction() {
		$sort = isset($_GET['sort']) ? $_GET['sort'] : null;
		$dir = isset($_GET['dir']) ? $_GET['dir'] : null;
		$rules = Character::model()->rules();
		$orders = isset($rules['order']) ? Character::model()->rules()['order'] : array();

		$guildname = 'ЕКАТЕРИНБУРГ';

		$guild = Guild::model()->find('name=:name', array(':name'=>$guildname));

		$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
		$perpage = 100;
		$start = ($page-1) * $perpage;

		$characters = Character::model()
			->order(($sort && $orders && in_array($sort, $orders)) ? $sort : Character::model()
			->getPK(), ($dir && $dir=='d') ? 'DESC' : 'ASC')
			->find_guild_members($guild->id, $start, $perpage);

		$count_all = Character::model()->get_last_query_count();

		$data = array(
			"characters" => $characters,
			'guild' => $guild,
			'page' => $page,
			'pagecount' => ceil($count_all / $perpage),
			'count_all' => $count_all,
			'sort' => $sort ? array('field' => $sort, 'dir' => (!$dir || $dir=='d') ? 'a' : 'd') : array(),
		);

		$this->render("index", $data);
	}

	public function refreshAction() {
		$guildname = 'ЕКАТЕРИНБУРГ';

		$guild = Guild::model()->find('name=:name', array(':name'=>$guildname));

		if(!$guild) {
			$curl = curl_init();
			curl_setopt($curl, CURLOPT_URL, "https://eu.api.battle.net/wow/guild/Голдринн/$guildname?fields=achievements%2Cchallenge&locale=ru_RU&apikey=f2ppxyc6frxaqhw7eg298hh5gb6za92j");
			curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
			$data = curl_exec($curl);
			curl_close($curl);
			$guild_info = json_decode($data);
			if(isset($guild_info->name)) {
				$guild = Guild::model();
				$guild->name = $guild_info->name;
				$guild->realm = $guild_info->realm;
				$guild->battlegroup = $guild_info->battlegroup;
				$guild->level = $guild_info->level;
				$guild->side = $guild_info->side;
				$guild->achievementPoints = $guild_info->achievementPoints;
				$guild->lastModified = $guild_info->lastModified;
				$guild->save();
			} else {
				$this->redirect('/');
			}
		}

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