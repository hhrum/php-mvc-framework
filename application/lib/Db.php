<?php

namespace application\lib;

use application\config\database as database;

class Db {

    /* --------------- Singleton Realization --------------- */

    private static $instances = [];

    protected function __clone() {}

    public function __wakeup() {
        throw new \Exception("Cannot unserialize a singleton.");
    }

    public static function getInstance(): Db
    {
        $cls = static::class;
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static;
        }

        return self::$instances[$cls];
    }

    /* --------------- Logic --------------- */

    protected function __construct() {
        $db_data = require "application/config/db.php";
        \R::setup("mysql:host={$db_data['host']};dbname={$db_data['dbname']}", $db_data['user'], $db_data['password']);
        
        if(!\R::testConnection()) die('No DB connection!');
    }

    // Выборка из таблицы
    public function select($table, $reverse = 0) {
        if ($reverse)
            return \R::findAll($table, 'ORDER BY id DESC');
        else
            return \R::findAll($table);
    }

    // Выборка из таблицы по определенному фильтру
    public function selectSort($table, $filter, $limit = 0) {
        if ($limit == 0)
            return \R::findAll($table, "ORDER BY $filter DESC");
        else
            return \R::findAll($table, "ORDER BY $filter DESC LIMIT ?", [$limit]);
    }
    
    // Поиск конкретной строки
    public function findOne($table, $value, $key = "id") {
        return \R::findOne($table, "$key = ?", [$value]);
    }

    // Вставка строки в таблицу
    public function insert($table, $rows) {
        $row = \R::dispense($table);

        foreach ($rows as $key => $value) {
            $row[$key] = $value;
        }

        return \R::store($row);
    }

    public function update($table, $id, $rows) {
        $post = \R::load($table, $id);

        foreach ($rows as $key => $value) {
            $post[$key] = $value;
        }

        \R::store($post);
    }

    public function delete($table, $id) {
        $post = \R::load($table, $id);
        \R::trash($post);
    }

}