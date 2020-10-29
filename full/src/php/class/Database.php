<?php 

/**
 * Database
 */
class Database {

    public $pdo;

    private static $db_host = "localhost";
    private static $db_name = "tech";
    private static $db_user = "root";
    private static $db_pass = "root";

    public function __construct($db_host = self::db_host, $db_name = self::db_name, $db_user = self::db_user, $db_pass = self::db_pass) {
        try {
            $this->pdo = new \PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
        } catch (\PDOException $e) {
            echo "Database error: " . $e->getmessage();
            die();
        }

        $this->pdo->query('set name utf8');
        return $this;
    }

}

?>