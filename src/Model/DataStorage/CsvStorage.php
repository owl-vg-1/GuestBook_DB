<?php

namespace App\Model\DataStorage;

class CsvStorage extends CrudEntity
{

    function get()
    {

        parent::get();

        $array = file($this->file_name);
        $res = [];

        foreach ($array as $row) {
            $buf = explode(';', $row);
            $key=$buf[0]; 
            unset($buf[0]);
            $res[$key] = array_values($buf);
        }
// print_r($res);
        return $res;
    }

    function write_file(array $data_array)
    {

        $csv = '';
        
        if (!empty($data_array)) {

            foreach ($data_array as $key => $row) {

                $csv .= $key . ';' . implode(';', $row);
            }

            $csv .= "\n";

        }
        
        file_put_contents($this->file_name, $csv);
    }
}
