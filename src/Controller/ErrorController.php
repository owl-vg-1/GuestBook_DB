<?php

namespace App\Controller;

use App\Core\Config;


class ErrorController extends Controller {

    protected $fileStorage;

    public function __construct()
    {
        parent::__construct();
        $this->view->setViewPath(__DIR__.'/../../templates/Error/');
        $this->view->setLayoutsPath(__DIR__.'/../../templates/_layouts/emptyLayout.php');

    }

    public function notFound ($text) {

        header("HTTP/1.0 404 Not Found");
        $this->render("error", [
            'text' => $text
        ]);

    }

    public function forbidden ($text) {

        header('HTTP/1.1 403 Forbidden');
        $this->render("error", [
            'text' => $text
        ]);


    }

}
