<?php

namespace App\Controller;

session_start();

use App\Model\DataStorage\Factory;
use App\Core\Config;


class AuthController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->view->setViewPath(__DIR__ . '/../../templates/Auth/');
        $this->view->setLayoutsPath(__DIR__.'/../../templates/_layouts/emptyLayout.php');
    }

    public function actionLoginForm()
    {

        $this->render("Form", [
            'formPath' => '?t=' . $this->classNameNP() . '&a=CheckLogin'
        ]);
    }

    public function actionCheckLogin()
    {
        $users_array = json_decode(file_get_contents(Config::DATA_USERS), true);
        
        if (
            isset($_POST['login']) &&
            $_POST['password'] == $users_array[$_POST['login']]
        ) {
            $_SESSION['autorized_user'] = $_POST['login'];
            $this->redirect('/dashboard');
        } else {
            echo "Неверный логин или пароль!";
            exit();
        }
    }


    public function actionLogout()
    {
        unset($_SESSION['autorized_user']);
        $this->redirect('/feedback');
    }

    public static function CheckRights(string $controllerName)
    {
        $rights_array = json_decode(file_get_contents(Config::USERS_RIGHTS), true);

        if (isset($_SESSION['autorized_user'])) {
            return in_array(strtolower($controllerName), array_map('strtolower', $rights_array["admin"]));
        } else {
            return in_array(strtolower($controllerName), array_map('strtolower', $rights_array["default"]));
        }
    }
}
