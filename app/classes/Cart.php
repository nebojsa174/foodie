<?php

class Cart {

    protected $conn;

    public function __construct($conn) {

        $this->conn = $conn;
    }

    public function addToCart($food_id, $session_id, $quantity, $total_cost) {

        $sql = "INSERT INTO cart(food_id, session_id, quantity, total_cost) VALUES (?,?,?,?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("isdd", $food_id, $session_id, $quantity, $total_cost);
        $stmt->execute();
    }

    public function getCartItems($currentSession) {

        $sql = "SELECT f.food_id, f.name, f.price, f.image, c.quantity, c.total_cost
                FROM food f
                INNER JOIN cart c
                ON c.food_id = f.food_id
                WHERE c.session_id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $currentSession);
        $stmt->execute();

        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getTotal($currentSession) {
        
        $sql = "SELECT SUM(total_cost) AS total FROM cart WHERE session_id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $currentSession);
        $stmt->execute();

        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        return $row['total'];
    }

    public function removeFromCart($food_id, $session_id) {

        $sql = "DELETE FROM cart WHERE food_id=? AND session_id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("is", $food_id, $session_id);
        $stmt->execute();
    }

    public function getNumberOfItems($current_session) {
        
        $sql = "SELECT * FROM cart WHERE session_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $current_session);
        $stmt->execute();

        $result = $stmt->get_result();

        return $result->num_rows;
    }

    public function destroyCart($session_id) {

        $sql = "DELETE FROM cart WHERE session_id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $session_id);
        $stmt->execute();
    }
}