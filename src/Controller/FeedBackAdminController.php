<?php

namespace App\Controller;

use App\Model\DataStorage\Factory;
use App\Core\Config;


class FeedBackAdminController extends Controller {

    protected $fileStorage;

    public function __construct()
    {
        parent::__construct();
        $this->view->setViewPath(__DIR__.'/../../templates/FeedBackAdmin/');
        $this->fileStorage = Factory::newFileStorage(Config::FILE_NAME);
    }

    public function actionShow () {
        // print_r($this->fileStorage->get());

        $this->render("show", [
            'data' => $this->fileStorage->get(),
            'delURL' => '/del'

        ]);
    }

    public function actionDelRow () {
        // $this->render("show", [
        //     'data' => $this->fileStorage->get(),
        //     'delData' => '?t='.$this->classNameNP().'&a=delRow'

        // ]);
            // echo $_GET['id'];
    $this->fileStorage->del($_GET['id']);
    $this->redirect('/dashboard');



    }

}

?>