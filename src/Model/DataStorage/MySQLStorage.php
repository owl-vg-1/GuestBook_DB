<?php

namespace App\Model\DataStorage;

use mysqli;

class MysqlStorage implements StorageInterface
{

    private $db_entity;

    function __construct()
    {

        $this->db_entity = new DB_entity(new mysqli('localhost', 'root', '', 'feedback_db'), 'feedback');
        // $this->edit(4, [123, 456]);
    }

    public function get()
    { 
        $res = [];
        foreach ($this->db_entity->query() as $value) {
            $res[$value['id']] = json_decode($value['data']);
        }
        return $res;

    }

    public function del(int $id)
    {
        $this->db_entity->delete($id);
    }

    public function edit(int $id, array $array)
    {
        $this->db_entity->edit($id, ['data' => json_encode($array)]);
    }

    public function add(array $array)
    {
        $this->db_entity->add(['data' => json_encode($array)]);
    }
}