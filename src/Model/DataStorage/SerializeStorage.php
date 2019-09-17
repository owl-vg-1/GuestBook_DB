<?php

namespace App\Model\DataStorage;

class SerializeStorage extends CrudEntity
{

    function get()
    {

        parent::get();
        return unserialize(file_get_contents($this->file_name));

    }

    function write_file(array $data_array)
    {

        return file_put_contents($this->file_name, serialize($data_array));

    }

}

?>