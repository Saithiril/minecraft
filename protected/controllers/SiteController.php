<?php
include "Controller.php";

class SiteController extends Controller
{
	public function indexAction() {
		$data = array("test" => "GO!");
		$this->render("index", $data);
	}
}