<?php
class Controller
{
	protected function render($view, $data=array()) {
		$template = "protected/views/" . mb_strtolower(substr(get_class($this), 0, strpos(get_class($this), "Controller"))) . "/$view.php";
		$layout = "protected/views/main/content.php";
		if(!is_file($template))
			return false;

		$output = $this->renderFile($template, $data);
		$content = $this->renderFile($layout, array('content' => $output));

		echo $content;
	}

	private function renderFile($template, $data=null) {

		extract($data);

		ob_start();
		ob_implicit_flush(false);
		include($template);
		return ob_get_clean();
	}

	public function redirect($link) {
		$config = $_SESSION['config'];
		if($config['host']) {
			header('Location: ' . "/{$_SESSION['config']['host']}$link");
		} else {
			header('Location: ' . $link);
		}
	}
}
