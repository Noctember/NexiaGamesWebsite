<?php
	session_start();
	// TEMP: Auto loggin
//	$_SESSION = array('id' => 1, 'rank' => 1, 'username' => 'Feedthecookie');

	require_once 'inc/php/MySQL.php';
	if ($_GET != null && !empty($_GET)) {
		if ($_GET['slug'] != null && !empty($_GET)) {
			extract($_GET);
			$fullSlug = explode('/', $slug);
			$page = $fullSlug[0];
			$param = array();
			for ($i=0; $i < count($fullSlug); $i++) { 
				if ($i != 0) {
					array_push($param, $fullSlug[$i]);
				}
			}
			if (Config::getLastChar($page) == "/") {
				$page = Config::removeLastChar($page);
			}
			$pageDB = Database::fetch(Database::prepare('SELECT * FROM dispatcher WHERE slug = ?', array($page)));
			if ($pageDB != false) {
				$css = Config::getUrl() . "inc/css/main.css";
				showPage($pageDB->name, array('css' => $css, 'page' => $pageDB, 'params' => $param));
			} else {
				showPage('404', array());
			}
		}
	} else {
		header('Location: ' + Config::getUrl());
	}

	function showPage($link, $params) {
		if (@file_exists('inc/php/controllers/' . $link . '.php')) require_once 'inc/php/controllers/' . $link . '.php';
		else showPage('404_2', array());
	}

	function isLogged() {
		return !empty($_SESSION);
	}

	function hasPerm($ranks) {
		foreach ($ranks as $value) {
			if($_SESSION['rank'] == $value) return true;
		}
		return false;
	}

?>