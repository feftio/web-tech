<?php 

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

class User {

    private $db;
    private $id;

    private $username;
    private $user_id;

    private $user = null;

    private $is_authorized = false;

    public function __construct($db) {
        $this->db = $db;
        $this->username = null;
    }

    public function __destruct() {
        $this->db = null;
    }

    public function create($email, $username, $password) {
        $user_exists = $this->getSalt($username);

        if ($user_exists) {
            throw new \Exception("User exists: " . $username, 1);
        }

        $query = "insert into users (email, username, password, salt) values (:email, :username, :password, :salt)";

        $hashes = $this->passwordHash($password);
        $sth = $this->db->pdo->prepare($query);

        try {
            $this->db->pdo->beginTransaction();
            $result = $sth->execute([
                ":email" => $email,
                ":username" => $username,
                ":password" => $hashes["hash"],
                ":salt" => $hashes["salt"]
            ]);
            $this->db->pdo->commit();
        } catch (\PDOException $e) {
            $this->db->pdo->rollback();
            echo "Database error: " . $e->getMessage();
            die();
        }

        if (!$result) {
            $info = $sth->errorInfo();
            printf("Database error %d %s", $info[1], $info[2]);
            die();
        }

        return $result;
    }

    public function authorize($username, $password, $remember = false) {
        $query = "select id, username from users where username = :username and password = :password limit 1";
        $sth = $this->db->pdo->prepare($query);

        $salt = $this->getSalt($username);
        if (!$salt) return false;
        $hashes = $this->passwordHash($password, $salt);

        $sth->execute([
            ":username" => $username,
            ":password" => $password
        ]);

        $this->user = $sth->fetch();

        if (!$this->user) {
            $this->is_authorized = false;
        } else {
            $this->is_authorized = true;
            $this->user_id = $this->user["id"];
            $this->saveSession($remember);
        }

        return $this->is_authorized;
    }

    public function saveSession($remember = false, $http_only = true, $days = 7) {
        $_SESSION["user_id"] = $this->user_id;

        if ($remember) {
            $sid = session_id();

            $expire = time() + $days * 24 * 3600;
            $domain = "";
            $secure = false;
            $path = "/";
            $cookie = setcookie("sid", $sid, $expire, $path, $domain, $secure, $http_only);
        }
    }

    public function getSalt($username) {
        $query = "select salt from users where username = :username limit 1";

        $sth = $this->db->pdo->prepare($query);
        $sth->execute([
            ":username" => $username
        ]);

        $row = $sth->fetch();

        if (!$row) return false;
        return $row["salt"];
    }

    public function passwordHash($password) {
        $salt || $salt = uniqid();

        $hash = md5(md5($password . md5(sha1($salt))));
        for ($i = 0; $i < $iterations; ++$i) $hash = md5(md5(sha1($hash)));

        return ['hash' => $hash, 'salt' => $salt];
    }

    public static function isAuthorized($username) {
        if (!empty($_SESSION["user_id"])) return (bool) $_SESSION["user_id"];
        return false;
    }

    public function logout() {
        if (!empty($_SESSION["user_id"])) unset($_SESSION["user_id"]);
    }


}

$user = new User(
    new Database("localhost", "tech", "root", "root")
);

?>