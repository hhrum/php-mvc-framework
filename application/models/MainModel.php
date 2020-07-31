<?php

namespace application\models;

use application\core\Model;

class MainModel extends Model {

    public function getAllSome() {
        return $this->db->selectSort("some", "id");
    }

}