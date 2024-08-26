<?php

class User {

    protected $conn;

    public function __construct($conn) {

        $this->conn = $conn;
    }

    public function login($username, $password) {

        $sql = "SELECT * FROM admins WHERE username=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();

        $result = $stmt->get_result();
        
        if($result->num_rows == 1) {

            $user = $result->fetch_assoc();

            if(password_verify($password, $user['password'])) {
                
                $_SESSION['username'] = $user['username'];
                return true;
            }
        }
        return false;
    }

    public function getAdmin() {

        $sql = "SELECT * FROM admins WHERE  username=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $_SESSION['username']);
        $stmt->execute();

        return $stmt->get_result();

    }

    public function getAdminById($id) {

        $sql = "SELECT * FROM admins WHERE admin_id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAdminByUsername($username) {

        $sql = "SELECT * FROM admins WHERE username=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $username);
        $stmt->execute();

        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function updateAdmin($username, $email, $name, $phone, $password, $image, $id) {

        $sql = "UPDATE admins
                SET username=?, email=?, name=?, phone=?, password=?, image=?
                WHERE admin_id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssssssi", $username, $email, $name, $phone, $password, $image, $id);
        $stmt->execute();
    }

    public function isLogged() {
        if(isset($_SESSION['username'])) {
            return true;
        }
        return false;
    }

    public function logout() {
        unset($_SESSION['username']);
    }

    public function addSubscriber($email, $date) {

        $sql = "INSERT INTO subscribers (email, date) VALUES (?,?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $email, $date);
        $stmt->execute();
    }

    public function getSubscribers() {

        $sql = "SELECT * FROM subscribers";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->get_result();
        
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function deleteSubscriber($id) {

        $sql = "DELETE FROM subscribers WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }

    public function adminHeader($username) {

        $sql = "SELECT * FROM admins WHERE username=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $username);
        $stmt->execute();

        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }
}