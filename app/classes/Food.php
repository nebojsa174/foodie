<?php

class Food {
    
    protected $conn;

    public function __construct($conn) {

        $this->conn = $conn;
    }

    public function getAllFood() {

        $sql = "SELECT * From food WHERE deleted='0' ORDER BY RAND()";
        $stmt = $this->conn->query($sql);

        return $stmt->fetch_all(MYSQLI_ASSOC);
    }

    public function getFoodCategory($category) {

        $sql = "SELECT * FROM food WHERE category=? AND deleted='0'";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $category);
        $stmt->execute();

        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getFoodByNameUrl($name_url) {
        $sql = "SELECT * FROM food WHERE name_url=? AND deleted='0'";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $name_url);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    

    public function getFoodId($food_id) {
        
        $sql = "SELECT * FROM food WHERE food_id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $food_id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function add($name, $name_url, $description, $category, $temperature, $price, $image) {

        $sql = "INSERT INTO food (name, name_url, description ,category, temperature, price, image) VALUES (?,?,?,?,?,?,?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssssds", $name, $name_url, $description, $category, $temperature, $price, $image);
        $stmt->execute();
    }

    public function read($food_id) {

        $sql = "SELECT * FROM food WHERE food_id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $food_id);
        $stmt->execute();

        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }
    

    public function update($name, $description, $price, $image, $category, $food_id) {

        $sql = "UPDATE food 
                SET name=?, description=?, price=?, image=?, category=?
                WHERE food_id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ssdssi', $name, $description, $price, $image, $category, $food_id);
        $stmt->execute();
    }

    public function delete($food_id) {

        $sql = "UPDATE food
                SET deleted='1'
                WHERE food_id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $food_id);
        $stmt->execute();
    }

    public function getReview() {

        $sql = "SELECT * FROM reviews";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getMostPopular() {

        $sql = "SELECT * FROM food WHERE deleted='0' ORDER BY RAND() LIMIT 0,4";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function createUrl($string) {

        $string = strtolower($string);
        $string = preg_replace('/[^a-z0-9]+/', '-', $string);
        $string = trim($string, '-');

        return $string;
    }
}