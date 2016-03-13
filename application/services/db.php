<?php

/* database handling class */
class Db {
    protected static $_dbh;

    /* constructor */
    private function __construct() {
        try {
            self::$_dbh = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=UTF8', DB_USER, DB_PASS);
        } catch ( PDOException $e ) {
            die;
        }
    }

    /* initializes a dababase object if one does not exist */
    public static function init() {
        if ( !self::$_dbh) {
            new Db();
        }
    }

    /* gets a database handler or create a new one if one does not exist */
    public static function getDbh() {
        self::init();

        return self::$_dbh;
    }

    /* magic clone */
    public function __clone() {}
}

Db::init();