<?php
include "Controller.php";
include "CharacterClass.php";
include "Character.php";
include "Race.php";

class CharacterController extends Controller
{
	public function indexAction() {
		$name = $_GET['name'];
		$character = Character::model()->find_by_name($name);
//		if($character) {
//			$curl = curl_init();
//			curl_setopt($curl, CURLOPT_URL, "https://eu.api.battle.net/wow/character/Голдринн/{$character->name}?fields=talents&locale=ru_RU&apikey=f2ppxyc6frxaqhw7eg298hh5gb6za92j");
//			curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
//			$data = curl_exec($curl);
//			curl_close($curl);
//			$classes_data = json_decode($data);
//		}
//		return;

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
		var_dump($character_data);


		$character = Character::model()->find_by_name($name);
		if($character) {

		}
		$character->calcClass = $character_data->calcClass;
		$character->faction = $character_data->faction;
		$character->totalHonorableKills = $character_data->totalHonorableKills;

	}
}