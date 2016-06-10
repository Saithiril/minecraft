<?php
include_once "Controller.php";
include_once "CharacterClass.php";
include_once "Character.php";
include_once "Race.php";
include_once "Spec.php";

class CharacterController extends Controller
{
	public function indexAction() {
		$name = $_GET['name'];
		$character = Character::model()->find_by_name($name);

		$this->render("index", ['character' => $character]);
	}

	public function updateAction() {
		$name = $_GET['name'];
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, "https://eu.api.battle.net/wow/character/Голдринн/$name?fields=talents&locale=ru_RU&apikey=f2ppxyc6frxaqhw7eg298hh5gb6za92j");
		curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
		$data = curl_exec($curl);
		curl_close($curl);
		$character_data = json_decode($data);

		$character = Character::model()->find_by_name($name);
		if(!$character || (isset($character_data->status) && $character_data->status == 'nok')) {
			$this->redirect("/");
		}

		if($character->level >= 10) {
			$specs = array();

			foreach ($character_data->talents as $talent) {
				if (isset($talent->spec)) {
					$spec = Spec::model()->find_by_name($talent->spec->name);
					if (!$spec) {
						$spec = Spec::model();
						$spec->name = $talent->spec->name;
						$spec->role = $talent->spec->role;
						$spec->backgroundImage = $talent->spec->backgroundImage;
						$spec->icon = $talent->spec->icon;
						$spec->description = $talent->spec->description;
						$spec->spec_order = $talent->spec->order;
						$id = $spec->save();
						$spec->id = $id;
					}
					$specs[] = clone($spec);
				}
			}

			$character->calcClass = $character_data->calcClass;
			$character->faction = $character_data->faction;
			$character->totalHonorableKills = $character_data->totalHonorableKills;
			$character->lastModified = $character_data->lastModified;
			$character->specs = $specs;

			$character->save();
		}
		$this->redirect("/character?name=$name");
	}
}