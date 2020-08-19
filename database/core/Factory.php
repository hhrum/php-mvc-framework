<?php

namespace database\core;

use database\PDOSingleton;

/**
 * Абстрактный класс фабрики, имеющий 4 
 * абстрактных метода, реализующих CRUD,
 * а также единый конструктор.
 */
abstract class Factory {

    protected $db;

    public function __construct()
    {
        $db = PDOSingleton::getInstance();
    }

    abstract public function create();
    abstract public function read();
    abstract public function update();
    abstract public function delete();

}