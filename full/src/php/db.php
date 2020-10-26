<?php 

class Database {

    public $pdo;

    private static $db_host = "localhost";
    private static $db_name = "tech";
    private static $db_user = "root";
    private static $db_pass = "root";

    private function __construct($db_host = self::db_host, $db_name = self::db_name, $db_user = self::db_user, $db_pass = self::db_pass) {
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

class User {

    private $db;
    private $id;
    private $username;
    private $user_id;

    private $is_authorized = false;

    private function __construct($username = null, $db) {
        $this->db = $db;
        $this->username = $username;
    }

    public function create($username, $password) {
        $user_exists = $this->getSalt($username);

        if ($user_exists) {
            throw new \Exception("User exists: " . $username, 1);
        }

        $query = "insert into users (username, password, salt) values (:username, :password, :salt)";
    }
}

$user = new User(
    new Database("localhost", "tech", "root", "root")
);

?>