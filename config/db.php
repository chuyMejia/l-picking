<?php

class Database {
    private static $serverName = "192.168.1.36";
    private static $database = "Consultas_AX";
    private static $username = "fox";
    private static $password = "Tr@v3rS";
    private static $connection;

    public static function conectar() {
        if (!isset(self::$connection)) {
            $connectionOptions = array(
                "Database" => self::$database,
                "Uid" => self::$username,
                "PWD" => self::$password
            );

            self::$connection = sqlsrv_connect(self::$serverName, $connectionOptions);

            if (!self::$connection) {
                die(print_r(sqlsrv_errors(), true));
            }
        }

        return self::$connection;
    }

    public static function cerrarConexion() {
        if (isset(self::$connection)) {
            sqlsrv_close(self::$connection);
            self::$connection = null;
        }
    }
}

?>
