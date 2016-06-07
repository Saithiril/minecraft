<?php
include "Controller.php";
include "CharacterClass.php";

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
}