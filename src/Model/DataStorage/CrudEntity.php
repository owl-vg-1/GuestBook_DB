<?php

namespace App\Model\DataStorage;

abstract class CrudEntity implements StorageInterface
{

    protected $file_name;

    // public function checkFileExists($file_content = '') 
    // {
    //     if (!file_exists($this->file_name)) {
    //         file_put_contents($this->file_name, $file_content);
    //     }
    // }

    public function get() 
    {
        if (!file_exists($this->file_name)) {
            $this->write_file([]);
        }
    }

    function __construct($file_name)
    {

        $this->file_name = $file_name;

    }

    public function del(int $id)
    {

        /** 
         * @var array $new_array
        */
        $new_array = $this->get();
        unset($new_array[$id]);
        $this->write_file($new_array);

    }

    public function edit(int $id, array $array)
    {
        /** 
         * @var array $new_array
        */
        $new_array = $this->get();
        $new_array[$id] = $array;
        $this->write_file($new_array);

    }

    public function add(array $data_array)
    {
        /** 
         * @var array $new_array
        */

        $new_array = $this->get();
        // print_r($new_array);
        $new_array[] = $data_array;
        $this->write_file($new_array);

    }

    abstract public function write_file(array $data_array);

}