<?php
/**
 * Created by PhpStorm.
 * User: JFNgozo
 * Date: 3/5/2019
 * Time: 1:13 PM
 */

class DSN
{
    private static $_instance = null;
    private $_pdo,
        $_connection;

    public $pdo;


    private function __construct()
    {
        try {
            $this->_pdo = new PDO("mysql:host=localhost;dbname=eli",
                "root", "");


        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    // Magic method clone is empty to prevent duplication of connection

    public static function getInstance()
    {
        if (!isset(self::$_instance)) {
            self::$_instance = new DSN();
        }
        return self::$_instance;
    }

    public function getConnection()
    {
        return $this->_connection;
    }

    public function CRUD($sql)
    {
        return $this->_pdo->query($sql);
    }
}