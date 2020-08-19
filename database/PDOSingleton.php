<?php

namespace database;

/** 
 * Синглтон реализация доступа к базе данных
 */
class PDOSingleton
{

    private static $instances = [];

    protected function __clone()
    {
    }

    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize a singleton.");
    }

    /**
     * Метод, возвращающий наше единственное PDO
     */
    public static function getInstance(): \PDO
    {
        $cls = static::class;
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static;
        }

        return self::$instances[$cls];
    }

    /**
     * Создания объекта PDO
     */
    protected function instance()
    {
        try {
            $db_config = require "app/config/db.php";
            $dsn = $db_config['driver'] . ":host=" . $db_config['host'] . ";dbname=" . $db_config['dbname'];

            $db = new \PDO($dsn, $db_config['username'], $db_config['password']);

            return $db;
        } catch (\Throwable $th) {
            die("Shit");
        }
    }
}
