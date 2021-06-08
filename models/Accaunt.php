<?php

class Accaunt {

    public static function login() {
        $db = Db::getCannection();

        if ( isset( $_POST['email'] ) && isset( $_POST['password'] ) ) {
            $email = filter_var( trim( $_POST['email'] ), FILTER_VALIDATE_EMAIL );
            $password = filter_var( trim( $_POST['password'] ), FILTER_SANITIZE_STRING );
            $error = array(
                'msg' => "",
                'email' => $email,
            );

            $sql = "SELECT * FROM Users WHERE email_users = :email";
            $query = $db->prepare( $sql );
            $query->execute( ['email' => $email] );
            $row = $query->fetch();

            if ( !$row ) {
                $error['msg'] = "Email указан неверно";
                return $error;
            }

            if ( password_verify( $password, $row['password_users'] ) ) {
                Session::set( 'User', $email );
                header( "Location: /post" );
            } else {
                $error['msg'] = "Пароль указан неверно";
                return $error;
            }
        }
    }

    public static function register() {
        $db = Db::getCannection();

        if ( isset( $_POST['email'] ) && isset( $_POST['user_name'] ) && isset( $_POST['password'] ) && isset( $_POST['confirm_password'] ) ) {
            $email = filter_var( trim( $_POST['email'] ), FILTER_VALIDATE_EMAIL );
            $user_name = filter_var( trim( $_POST['user_name'] ), FILTER_SANITIZE_STRING );
            $password = filter_var( trim( $_POST['password'] ), FILTER_SANITIZE_STRING );
            $confim_password = filter_var( trim( $_POST['confirm_password'] ), FILTER_SANITIZE_STRING );

            $error = array(
                'msg' => "",
                'email' => $email,
                'name' => $user_name,
            );

            if ( $_POST["check"] != "on" ) {
                $error['msg'] = "Вы не приняли пользовательское соглашение";
                return $error;

            }

            if ( $email == false ) {
                $error['msg'] = "Некорректно указан Email";
                return $error;
            }

            if ( !preg_match( "/^[а-яё]+$/iu", $user_name ) ) {
                $error['msg'] = "Некорректно указано имя";
                return $error;
            }

            if ( mb_strlen( $user_name ) < 3 ) {
                $error['msg'] = "Слишком которотое имя";
                return $error;
            }

            if ( mb_strlen( $password ) < 6 ) {
                $error['msg'] = "Пароль слишком короткий";
                return $error;
            }

            if ( preg_match( "/^[\b]+$/iu", $password ) ) {
                $error['msg'] = "Пароль не должен состоять только из цифр";
                return $error;
            }

            if ( $password != $confim_password ) {
                $error['msg'] = "Пароли не совпадают";
                return $error;
            }

            $sql = "SELECT * FROM Users WHERE email_users = :email";
            $query = $db->prepare( $sql );
            $query->execute( ['email' => $email] );

            if ( $query->fetch() ) {
                $error['msg'] = "Пользователь уже зарегестрирован";
                return $error;
            }

            $password = password_hash( $password, PASSWORD_BCRYPT );

            $sql = "INSERT INTO Users (name_users, password_users, email_users) VALUES (:user_name, :password, :email)";
            $query = $db->prepare( $sql );
            $query->execute( ['user_name' => $user_name, 'password' => $password, 'email' => $email] );

            Session::set( 'User', $email );
            header( "Location: /post" );
        }
    }

    public static function logout() {
        Session::destroy();
        header( "Location: /post" );
    }
}