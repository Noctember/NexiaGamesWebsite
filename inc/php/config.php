<?php

class Config {

    public static $config = array(
        'ndd' => 'http://localhost',
        'base' => '/PNS/',
        'sql' => array(
            'host' => 'localhost',
            'user' => 'root',
            'password' => 'Sweet',
            'port' => 3306,
            'database' => 'NexiaGames'
        )
    );
    public static function getUrl() {
        return self::$config['ndd'] . self::$config['base'];
    }

    public static function getCharAtPos($string, $pos=0) {
        return $string[$pos];
    }

    public static function getLastChar($string) {
        return self::getCharAtPos($string, strlen($string) - 1);
    }

    public static function removeLastChar($string) {
        return substr($string, 0, strlen($string) - 1);
    }

}

?>