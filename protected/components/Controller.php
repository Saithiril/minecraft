<?php
class Controller
{
	protected function render($view, $data=array()) {
//		$html = file_get_contents("protected/views/main/content.php");
		$file = file_get_contents("protected/views/" . mb_strtolower(substr(get_class($this), 0, strpos(get_class($this), "Controller"))) . "/$view.php");
		$content = $file;
		require("protected/views/main/content.php");
	}
}