<?php
/**
 * Created by PhpStorm.
 * User: Abdullah Shublaq
 * Date: 09/05/2019
 * Time: 05:08 م
 */
//error_reporting(E_ERROR | E_PARSE);
class DBConnection
{
    private $servername = "localhost";
    private $username = "root";
    private $password = "root";
    private $dbname = "student_portal";
    private $connection;
    static $db_connection = null;

    private function __construct() {
            $this->connection = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
            if(mysqli_connect_error()){
                echo'<div class="col-12" style="text-align: center"><div class="alert alert-danger">error connection</div></div>';
                die();
            }
    }
    public static function get_instance () {
        if (is_null(self::$db_connection)) {
            self::$db_connection = new DBConnection();
        }
        return self::$db_connection;
    }
    public function get_connection () {
        return $this->connection;
    }
}