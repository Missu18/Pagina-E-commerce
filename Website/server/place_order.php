<?php
session_start();
include('connection.php');

if (!isset($_SESSION['logged_in'])) {
    header('location: ../checkout.php?message=Por favor logueate/Regístrese para realizar un pedido');
    exit;
} else {
    if (isset($_POST['place_order'])) {
        // Obtener datos del pedido
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $city = $_POST['city'];
        $address = $_POST['address'];
        $order_cost = $_SESSION['total'];
        $order_status = "No Pagado";
        $user_id = $_SESSION['user_id'];
        $order_date = date('Y-m-d H:i:s');

        // Insertar pedido
        $stmt = $conn->prepare("INSERT INTO orders (order_cost,order_status,user_id,user_phone,user_city,user_address,order_date)
                                VALUES (?,?,?,?,?,?,?);");
        if (!$stmt) {
            die("Error al preparar consulta de orders: " . $conn->error);
        }
        $stmt->bind_param('isiisss', $order_cost, $order_status, $user_id, $phone, $city, $address, $order_date);
        if (!$stmt->execute()) {
            die("Error al ejecutar consulta de orders: " . $stmt->error);
        }
        $order_id = $stmt->insert_id;

        // Insertar productos del carrito
        foreach ($_SESSION['cart'] as $product) {
            $product_id = $product['product_id'];
            $product_name = $product['product_name'];
            $product_image = $product['product_image'];
            $product_price = $product['product_price'];
            $product_quantity = $product['product_quantity'];

            $stmt1 = $conn->prepare("INSERT INTO order_items (order_id, product_id, product_name, product_image, product_price, product_quantity, user_id, order_date)
                                     VALUES (?,?,?,?,?,?,?,?)");
            if (!$stmt1) {
                die("Error al preparar consulta de order_items: " . $conn->error);
            }
            $stmt1->bind_param('iissiiis', $order_id, $product_id, $product_name, $product_image, $product_price, $product_quantity, $user_id, $order_date);
            if (!$stmt1->execute()) {
                die("Error al ejecutar consulta de order_items: " . $stmt1->error);
            }
        }

        // Asignar puntos al usuario
        $points_per_dollar = 10;
        $points_earned = $order_cost * $points_per_dollar;

        $points_query = "INSERT INTO user_points (user_id, points) VALUES (?, ?)
                         ON DUPLICATE KEY UPDATE points = points + VALUES(points)";
        $points_stmt = $conn->prepare($points_query);
        if (!$points_stmt) {
            die("Error al preparar consulta de user_points: " . $conn->error);
        }
        $points_stmt->bind_param('ii', $user_id, $points_earned);
        if (!$points_stmt->execute()) {
            die("Error al ejecutar consulta de user_points: " . $points_stmt->error);
        }

        // Guardar ID del pedido y redirigir al usuario
        $_SESSION['order_id'] = $order_id;
        header('location: ../payment.php?order_status=Pedido realizado exitosamente');
    }
}
?>
