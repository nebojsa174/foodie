<?php

class Order extends Cart {

    protected $conn;

    public function __construct($conn) {

        $this->conn = $conn;
    }
    
    public function create($current_session, $firstname, $lastname, $phone, $email, $delivery_address, $total, $message, $status, $payment_method) {

        $sql = "INSERT INTO orders (session_id, firstname, lastname, phone, email, delivery_address, total, message, status, payment_method) VALUES (?,?,?,?,?,?,?,?,?,?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssssssdsss", $current_session, $firstname, $lastname, $phone, $email, $delivery_address, $total, $message, $status, $payment_method);
        $stmt->execute();

        $order_id = $this->conn->insert_id;

        $cart_items = $this->getCartItems($current_session);

        $sql2 = "INSERT INTO order_items (order_id, food_id, name, quantity) VALUES (?,?,?,?)";
        $stmt2 = $this->conn->prepare($sql2);

        foreach($cart_items as $item) {

            $stmt2->bind_param("iisi", $order_id, $item['food_id'], $item['name'], $item['quantity']);
            $stmt2->execute();
        }

        $this->destroyCart($current_session);
    }

    public function getNumberOfOrders() {
        
        $sql = "SELECT * FROM orders";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->get_result();
        return $result->num_rows;
    }

    public function getNumberOfDeliveredOrders() {
        
        $sql = "SELECT * FROM orders WHERE status='delivered'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->get_result();
        return $result->num_rows;
    }

    public function getNumberOfOrderedOrders() {
        
        $sql = "SELECT * FROM orders WHERE status='ordered'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->get_result();
        return $result->num_rows;
    }

    public function getAllOrders() {

        $sql = "SELECT * FROM orders";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getOrderDetails($order_id) {

        $sql = "SELECT 
                    O.order_id,
                    O.firstname,
                    O.lastname,
                    O.phone,
                    O.email,
                    O.delivery_address,
                    O.message,
                    CAST(O.total AS CHAR) AS total,
                    O.status,
                    O.payment_method,
                    OI.order_items_id,
                    OI.food_id,
                    OI.name AS order_item_name,
                    OI.quantity,
                    F.name AS food_name,
                    F.description,
                    F.category,
                    F.temperature,
                    F.price,
                    (OI.quantity*F.price) AS item_total_price,
                    F.image,
                    O.updated_by,
                    O.updated_date
                FROM 
                    ORDERS O
                JOIN 
                    ORDER_ITEMS OI ON O.order_id = OI.order_id
                JOIN 
                    FOOD F ON OI.food_id = F.food_id
                WHERE 
                    O.order_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $order_id);
        $stmt->execute();

        $result = $stmt->get_result();

        $orderDetails = $result->fetch_all(MYSQLI_ASSOC);

        return $orderDetails;
    }

    public function getOrderStatus($order_id) {

        $sql = "SELECT status FROM orders WHERE order_id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $order_id);
        $stmt->execute();

        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function updateOrder($status, $updated, $dateTime, $order_id) {

        $sql = "UPDATE orders 
                SET status=?, updated_by=?, updated_date=?
                WHERE order_id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssi", $status, $updated, $dateTime, $order_id);
        $stmt->execute();
    }

    public function sumDelivered() {

        $sql = "SELECT SUM(total) as total_delivered FROM orders WHERE status='delivered'";
        $result = $this->conn->query($sql);

        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['total_delivered'];
        } else {
            return 0;
        }
    }
}