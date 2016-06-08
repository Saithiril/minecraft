<?php
include "Controller.php";
include "CharacterClass.php";
include "Character.php";

class ResurcesController extends Controller
{
	public function indexAction() {
		$classes = CharacterClass::model()->find_all();

		if(!$classes) {
			$curl = curl_init();
			curl_setopt($curl, CURLOPT_URL, "https://eu.api.battle.net/wow/data/character/classes?locale=ru_RU&apikey=f2ppxyc6frxaqhw7eg298hh5gb6za92j");
			curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
			$data = curl_exec($curl);
			curl_close($curl);
			$classes_data = json_decode($data);

			foreach($classes_data->classes as $class) {
				$wow_class = CharacterClass::model();
				$wow_class->id = $class->id;
				$wow_class->mask = $class->mask;
				$wow_class->powerType = $class->powerType;
				$wow_class->name = $class->name;
				$wow_class->save();
			}
		}

//		print_r($classes_data);

		$data = [];
		$this->render("index", $data);
	}

	public function activeAction() {
		$is_active = !!$_GET['is_active'];
		$name = $_GET['name'];
		$character = Character::model()->find_by_name($name);
		if($character) {
			$character->is_active = $is_active ? 1 : 0;
			$character->update();
			echo "OK";
		} else {
			echo "NOT FOUND";
		}
	}

	public function deleteAction() {
		$wait_delete = !!$_GET['wait_delete'];
		$name = $_GET['name'];
		$character = Character::model()->find_by_name($name);
		if($character) {
			$character->wait_delete = $wait_delete ? 1 : 0;
			$character->update();
			echo "OK";
		} else {
			echo "NOT FOUND";
		}
	}
}