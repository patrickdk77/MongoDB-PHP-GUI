<?php

namespace Controllers;

use Capsule\Response;

class LoginController extends Controller {

    public static function ensureUserIsLogged() {

        if ( !isset($_SESSION['mpg']['user_is_logged']) ) {

            Controller::redirectTo('/login#');

        }

    }

    public function processFormData() : array {

        $errors = [];

        $_SESSION['mpg'] = [];

        if ( isset($_POST['user']) && !empty($_POST['user']) ) {
            $_SESSION['mpg']['mongodb_user'] = $_POST['user'];
        }

        if ( isset($_POST['password']) && !empty($_POST['password']) ) {
            $_SESSION['mpg']['mongodb_password'] = $_POST['password'];
        }

        if ( isset($_POST['host']) && !empty($_POST['host']) ) {
            $_SESSION['mpg']['mongodb_host'] = $_POST['host'];
        } else {
            $errors[] = 'Host';
        }

        if ( isset($_POST['port']) && !empty($_POST['port']) ) {
            $_SESSION['mpg']['mongodb_port'] = $_POST['port'];
        } else {
            $errors[] = 'Port';
        }
        
        if ( isset($_POST['database']) && !empty($_POST['database']) ) {
            $_SESSION['mpg']['mongodb_database'] = $_POST['database'];
        }

        if ( isset($_POST['authsource']) && !empty($_POST['authsource']) ) {
            $_SESSION['mpg']['mongodb_authsource'] = $_POST['authsource'];
        }

        if ( isset($_POST['ssl']) && !empty($_POST['ssl']) ) {
            $_SESSION['mpg']['mongodb_ssl'] = $_POST['ssl'];
        }

        if ( isset($_POST['uri']) && !empty($_POST['uri']) ) {
            $_SESSION['mpg']['mongodb_uri'] = $_POST['uri'];
            $url=parse_url($_POST['uri']);

            if(isset($url['user']))
                $_SESSION['mpg']['mongodb_user']=$url['user'];
            if(isset($url['pass']))
                $_SESSION['mpg']['mongodb_password']=$url['pass'];
            if(isset($url['host']))
                $_SESSION['mpg']['mongodb_host']=$url['host'];
            if(isset($url['port']))
                $_SESSION['mpg']['mongodb_port']=$url['port'];
            if(isset($url['path']))
                $_SESSION['mpg']['mongodb_database']=ltrim($url['path'],'/');

            return [];
        }

        return $errors;

    }

    public function renderViewAction() : Response {

        if ( isset($_POST['login']) ) {

            $errors = $this->processFormData();
            
            if ( count($errors) >= 1 ) {

                return new Response(200, $this->renderView('login', [
                    'errors' => $errors
                ]));
                
            } else {

                $_SESSION['mpg']['user_is_logged'] = true;
                Controller::redirectTo('/index');

            }

        } else {
            return new Response(200, $this->renderView('login'));
        }

    }

    public function logoutAction() {

        $_SESSION['mpg'] = [];

        Controller::redirectTo('/login');

    }

}
