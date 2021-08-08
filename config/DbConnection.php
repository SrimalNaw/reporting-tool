<?php
require_once('DbConfig.php');
require_once(DOC_ROOT.'app/controllers/BaseController.php');

/*
* Database Connection
*/
class DbConnection extends BaseController
{
    private static $hostName = DB_HOST;
    private static $userName = DB_USER;
    private static $password = DB_PWD;
    private static $database = DB_NAME;
    private static $mysqli;


    public static function connect()
    {
        try {
            self::$mysqli = new mysqli(self::$hostName, self::$userName, self::$password, self::$database);

            if (self::$mysqli->connect_errno) {
                echo "Failed to connect to Database: " . self::$mysqli->connect_error;
                exit();
            } else {
                return self::$mysqli;
            }
        } catch (mysqli_sql_exception $e) {
            throw $e;
         }
    }


    public function closeConnection()
    {
        self::$mysqli->close();

    }

    public function getConnection()
    {
        return self::$mysqli;
    }


}
