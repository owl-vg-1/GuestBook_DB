<?php

namespace App\Controller;

// use \App\Core\Config;
use App\Model\DataStorage\Factory;
use App\Core\Config;


class FeedBackController extends Controller {

    protected $fileStorage;

    public function __construct()
    {
        parent::__construct();
        $this->view->setViewPath(__DIR__.'/../../templates/FeedBack/');
        $this->view->setLayoutsPath(__DIR__.'/../../templates/_layouts/emptyLayout.php');
        $this->fileStorage = Factory::newFileStorage(Config::FILE_NAME);
        // echo get_class($this->fileStorage);
    }

    public function actionShowForm () {

        // (new Factory())->new_item('data.json');

        $this->render("Form", [
            'formPath' => '?t='.$this->classNameNP().'&a=AddFeedBack'
        ]);
    }

    public function actionAddFeedBack() 
    {
        // print_r ($_POST);
        $this->fileStorage->add($_POST);
        $this->redirect('/thanks');
    }

    public function actionThanks() {
        $this->render("thanks", []);
    }

}

?>