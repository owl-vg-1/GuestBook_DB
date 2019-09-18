<?php

namespace App\Controller;

session_start();

use App\Model\DataStorage\Factory;
use App\Model\DataStorage\DB_entity;
use App\Core\Config;
use mysqli;


class RegistrationController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->view->setViewPath(__DIR__ . '/../../templates/Registration/');
        $this->view->setLayoutsPath(__DIR__.'/../../templates/_layouts/emptyLayout.php');
        $this->db_entity = new DB_entity(new mysqli('localhost', 'root', '', 'feedback_db'), 'users');
    }

    public function actionShowForm()
    {

        $this->render("Form", [
            'formPath' => '?t=' . $this->classNameNP() . '&a=Registration'
        ]);
    }

    public function actionRegistration()
    {
        $this->db_entity->add($_POST);
        $this->redirect('/thanks');
    }


}
