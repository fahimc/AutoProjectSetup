<?php

Class Deploy {
	const JS_LOCATION = "deploy/js/";
	private $htmlList = array();

	public function init() {
		$this -> makeFolder(Deploy::JS_LOCATION);

		$this -> getAllHTMLFiles();
		$this -> getAllScripts();

	}

	private function getAllHTMLFiles() {
		foreach (glob("*.html") as $filename) {
			array_push($this -> htmlList, $filename);
		}
	}

	private function getAllScripts() {
		for ($a = 0; $a < count($this -> htmlList); $a++) {
			$link = $this -> htmlList[$a];
			$content = file_get_contents($link);
			$content = $this -> getScriptSrc($content);
			$this -> makeFile("deploy/" . $this -> htmlList[$a], $content);
		}
	}

	private function getScriptSrc($html) {
		//$matches = preg_match_all('<script(.*?)>(.*?)</script>', '', $html);
		$pattern = '/src=(["\'])(.*?)\1/';
		preg_match_all($pattern, $html, $matches);
		var_dump($matches);
		for ($a = 0; $a < count($matches[0]); $a++) {
			$name = preg_replace("/src=([\"'])/", "", $matches[0][$a]);
			$name = preg_replace("/([\"'])/", "", $name);

			if ($name) {
				echo $name . "\n";
				echo Deploy::JS_LOCATION . "\n";

				$data = file_get_contents($name);
				$filename = explode("/", $name);
				$html = str_replace($name, "js/" . $filename[count($filename) - 1], $html);
				$this -> putJS(Deploy::JS_LOCATION . $filename[count($filename) - 1], $data);
			}

		}
		return $html;
	}

	private function putJS($url, $data) {
		$this -> makeFile($url, $data);
	}

	private function makeFolder($path) {
		if (!file_exists($path)) {
			mkdir($path, 0777, true);
		}
		$this -> displayMessage("Created folder called " . $path, "folder");
	}

	private function displayMessage($str, $className) {
		echo "<p class='" . ($className ? $className : "") . "'>" . $str . "</p>";
	}

	private function makeFile($url, $data) {
		//if (!file_exists($url))
		file_put_contents($url, $data);
		$this -> displayMessage("Created file called " . $url, "file");
	}

}

$deploy = new Deploy();
$deploy -> init();
?>