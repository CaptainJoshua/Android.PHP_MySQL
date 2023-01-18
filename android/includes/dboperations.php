<?php 
// 03 - PHP Performing Database Operations
// class name is DBOperation
    class DBOperation {
    private $con;

    // Class constructor
    function __construct()
    {
        require_once dirname(__FILE__) . '/dbconnect.php';
        $db = new DBConnect();
        $this->con = $db->connect();
    }

    // CRUD - Create
    public function createUser ($email, $username, $pass) {
        // modifying the createUser function, part of 09 - Unique Email and Password
        if ($this->isUserExist($username, $email)) {
            return 0;
        }
        else {
            $password = md5($pass);
            $stmt = $this->con->prepare("INSERT INTO `users` (`id`,`email`, `username`, `password`) VALUES (NULL, ?, ?, ?);");
            $stmt -> bind_param("sss", $email, $username, $password);
            if ($stmt->execute()) {
                return 1;
            }
            else {
                return 2;
            }
        }
    }
    
    // 09 - Unique Email and Password
    private function isUserExist($username, $email)
    {
        $stmt = $this->con->prepare("select id FROM users WHERE username = ? OR email = ?");
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $stmt->store_result();
        return $stmt->num_rows > 0;
    }

    // 10 - PHP Login
    public function userLogin($username, $pass)
    {
        $password = md5($pass);
        $stmt = $this->con->prepare("SELECT id FROM users WHERE username = ? AND password = ?");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $stmt->store_result();
        return $stmt->num_rows > 0;
    }

    public function getUserByUsername($username)
    {
        $stmt = $this->con->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
}