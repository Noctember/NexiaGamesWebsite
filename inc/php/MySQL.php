<?php

require_once 'config.php';

class Database {


public static function connectPDO() {
try {
$db = new PDO('mysql:dbname=' . Config::$config['sql']['database'] . ';host=localhost', 'root', 'Sweet');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
$db->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES utf8');
return $db;
} catch (PDOException $e) {
echo 'Erreur: ' . $e->getMessage();
}
}

public static function prepare($req, $params) {
$request = self::connectPDO()->prepare($req);
$request->execute($params);
return $request;
}

public static function query($req) {
$request = self::connectPDO()->query($req);
return $request;
}

public static function fetch($data) {
return $data->fetch();
}

public static function fetchAll($data) {
return $data->fetchAll();
}

public static function rowCount($data) {
return $data->rowCount();
}

}