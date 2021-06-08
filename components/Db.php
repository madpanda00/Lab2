<?php

class Db {

    public static function getCannection() {
        $paramsPath = ROOT . '/config/db_params.php';
        $params = include( $paramsPath );

        $dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";
        $conn = new PDO( $dsn, $params['user'], $params['password'] );

        return $conn;
    }
}