<?php

namespace App\Model\DataStorage;

class JsonStorage extends CrudEntity
{

    function get()
    {

        parent::get();
        return json_decode(file_get_contents($this->file_name), true);

    }

    function write_file(array $data_array)
    {

        return file_put_contents($this->file_name, json_encode($data_array, JSON_FORCE_OBJECT));

    }

}

?>