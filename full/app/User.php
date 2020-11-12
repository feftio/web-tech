<?php

namespace tech\app;

/**
 * Class User. The class for use authorize methods in web app.
 * 
 * @author Lik Eduard
 * @license MIT
 */
class User {
    
    /**
     * Database connection using PDO.
     *
     * @var Database
     */
    private $db;    
    /**
     * User identificator from table "users" autoincrement field.
     *
     * @var integer
     */
    private $id;
    
    /**
     * username
     *
     * @var mixed
     */
    private $username;    
    /**
     * user_id
     *
     * @var mixed
     */
    private $user_id;
    
    /**
     * user
     *
     * @var undefined
     */
    private $user = null;
    
    /**
     * is_authorized
     *
     * @var bool
     */
    private $is_authorized = false;
    
    /**
     * __construct
     *
     * @param  mixed $db
     * @return void
     */
    public function __construct($db) {
        $this->db = $db;
        $this->username = null;
    }
    
    /**
     * __destruct
     *
     * @return void
     */
    public function __destruct() {
        $this->db = null;
    }
    
    /**
     * @method create
     *
     * @param  string $email
     * @param  string $username
     * @param  string $password
     * 
     * @return $result
     */
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
    
    /**
     * User authorizing method.
     *
     * @param  string  $username
     * @param  string  $password
     * @param  bool  $remember
     * @return void
     */
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
    
    /**
     * logout
     *
     * @return void
     */
    public function logout() {
        if (!empty($_SESSION["user_id"])) unset($_SESSION["user_id"]);
    }
    
    /**
     * saveSession
     *
     * @param  bool $remember
     * @param  bool $http_only
     * @param  int $days
     * @return void
     */
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
     
    /**
     * Get salt from "users" table of database.
     * Used for better methods of protection user passwords.
     *
     * @param  string $username
     * @return string
     */
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
    
    /**
     * passwordHash
     *
     * @param  string $password
     * @return array
     */
    public function passwordHash($password) {
        $salt || $salt = uniqid();

        $hash = md5(md5($password . md5(sha1($salt))));
        for ($i = 0; $i < $iterations; ++$i) $hash = md5(md5(sha1($hash)));

        return ['hash' => $hash, 'salt' => $salt];
    }
    
    /**
     * isAuthorized
     *
     * @param  string $username
     * @return bool
     */
    public static function isAuthorized($username) {
        if (!empty($_SESSION["user_id"])) return (bool) $_SESSION["user_id"];
        return false;
    }

}

?>