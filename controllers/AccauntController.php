<?php
include_once ROOT . '/models/Accaunt.php';

class AccauntController {

    public function actionLogin() {
        $error = array();

        if ( Session::get( 'User' ) ) {
            header( "Location: /post" );
        }

        $error = Accaunt::login();
        require_once( ROOT . '/views/accaunt/login.php' );
        return true;
    }

    public function actionRegister() {
        $error = array();

        if ( Session::get( 'User' ) ) {
            header( "Location: /post" );
        }

        $error = Accaunt::register();
        require_once( ROOT . '/views/accaunt/register.php' );
        return true;

    }

    public function actionLogout() {
        if ( Session::get( 'User' ) ) {
            Accaunt::logout();
        } else {
            header( "Location: /post" );
        }
        return true;
    }

}