<?php

namespace App\Core;

use App\Core\Config;
use App\Controller\AuthController;
use App\Controller\ErrorController;
use App\Core\URL;

class Router
{

    function __construct()
    {
        $uriData = URL::getInstance()->decodeUri($_SERVER['REQUEST_URI']);
        

        // print_r($uriData);
        if (!empty($uriData)) {
            $_GET = array_merge($_GET, $uriData['vars']);
            $urlArray = explode('/', $uriData['handler']);
            $_GET['t'] = $urlArray[0];
            $_GET['a'] = $urlArray[1];
        } 

        $this->controllerName = ($_GET["t"] ?? Config::DEFAULT_CONTROLLER);
        $this->actionName = 'action' . ($_GET["a"] ?? Config::DEFAULT_ACTION);
        
       
        // $view = 'siteView';

    }

    public function run()
    {
        // echo AuthController::CheckRights("FeedBackAdmin")*1;

        if (AuthController::CheckRights($this->controllerName)) {

            $className = "App\\Controller\\{$this->controllerName}Controller";

            if (class_exists($className)) {
                $MVC = new $className();

                if (method_exists($MVC, $this->actionName)) {
                    $MVC->{$this->actionName}();
                } else {
                    // echo "нет такого метода: $this->actionName";
                    (new ErrorController)->notFound("нет такого метода: $this->actionName");
                }
            } else {
                // echo "нет такого класса: $this->controllerName";
                (new ErrorController)->notFound("нет такого класса: $this->controllerName");

            }
        }else{
            // echo "У Вас недостаточно прав";
            (new ErrorController)->forbidden("У Вас недостаточно прав");

        }
    }
}
