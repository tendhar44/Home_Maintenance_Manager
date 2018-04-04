<?php
/**
 * Name:
 * Date:
 */

class DatabaseConnection
{

    public function __construct()
    {

    }

    public function db_connect()
    {

        // static so it won't connect more than one time
        static $connection;
        // connect to the database, if there is not connected
        if (!isset($connection)) {
            // use config.ini file to get connection information
            $config = parse_ini_file('../app/config/config.ini');
            $connection = mysqli_connect($config["host"], $config['user'], $config['pass'], $config['name']);
        }

        // show error if it wasn't able to connect
        if ($connection === false) {
            return mysqli_connect_error();
        }
        return $connection;
    }
}