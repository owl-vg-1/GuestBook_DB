<?php

namespace App\Model\DataStorage;

use App\Model\DataStorage\PhpStorage;
use App\Model\DataStorage\SerializeStorage;
use App\Model\DataStorage\JsonStorage;
use App\Model\DataStorage\DB_entity;

class Factory
{

   public static function newFileStorage($fileName) 
   {
    preg_match('/\.([^\.]*)$/iu', $fileName, $match);
    $type = $match[1];
    switch ($type) {
        case 'php':
            return new PhpStorage($fileName);
            break;

        case 'txt':
            return new SerializeStorage($fileName);
            break;

        case 'csv':
            return new CsvStorage($fileName);
            break;
        case 'json':
            return new JsonStorage($fileName);
            break;
        case 'msql':
            default:
            return new MySQLStorage();
            break;
    }
   }

}