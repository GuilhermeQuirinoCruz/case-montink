<?php

function getPdo()
{
    try {
        $dbHost = "127.0.0.1";
        $dbName = "erp";
        $dbUser = "root";
        $dbPassword = "password";

        $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPassword);

        return $pdo;
    } catch (PDOException $e) {
        return null;
    }
}
