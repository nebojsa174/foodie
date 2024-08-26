<?php

class TableReservation {

    protected $conn;

    public function __construct($conn) {

        $this->conn = $conn;
    }

    public function create($name, $email, $phone, $people, $date, $time, $message, $status) {
        
        $sql = "INSERT INTO tablereservations (name, email, phone, people, date, time, message, status) VALUES(?,?,?,?,?,?,?,?)";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssissss", $name, $email, $phone, $people, $date, $time, $message, $status);
        $stmt->execute();
    }

    public function numberOfTableReservations() {

        $sql = "SELECT * FROM tablereservations WHERE status='reserved'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->get_result();

        return $result->num_rows;
    }

    public function getAll() {

        $sql = "SELECT * FROM tablereservations";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getDetails($id) {
        
        $sql = "SELECT * FROM tablereservations WHERE tablereservation_id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function updateReservation($status, $updated, $expenses, $id) {

        $sql = "UPDATE tablereservations
                SET status=?, updated_by=?, expenses=?
                WHERE tablereservation_id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssi", $status, $updated, $expenses, $id);
        $stmt->execute();
    }

    public function getReservationStatus($id) {

        $sql = "SELECT status FROM tablereservations WHERE tablereservation_id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function totalExpenses() {

        $sql = "SELECT SUM(expenses) as total_expenses FROM tablereservations WHERE status='closed'";
        $result = $this->conn->query($sql);

        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['total_expenses'];
        } else {
            return 0;
        }
    }
}