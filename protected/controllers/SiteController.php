<?php
include "Controller.php";

class SiteController extends Controller
{
	public function indexAction() {
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, "https://eu.api.battle.net/wow/guild/Голдринн/ЕКАТЕРИНБУРГ?fields=members&locale=ru_RU&apikey=f2ppxyc6frxaqhw7eg298hh5gb6za92j");
		curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
		$data = curl_exec($curl);
		curl_close($curl);
		$guild_info = json_decode($data);

		$data = array("guild_info" => $guild_info);
		$this->render("index", $data);
	}
}