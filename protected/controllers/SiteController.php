<?php
include "Controller.php";

class SiteController extends Controller
{
	public function indexAction() {
		$this->render("index");
	}
}