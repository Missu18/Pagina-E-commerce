<?php

session_start();

include('connection.php');

if (isset($_GET['transaction_id']) && isset($_GET['order_id'])) {

    $order_id = $_GET['order_id'];
    $order_status = "paid";
    $transaction_id = $_GET['transaction_id'];
    $user_id = $_SESSION['user_id'];
    $payment_date = date('Y-m-d H:i:s');

    // Cambiar el estado del pedido a pagado
    $stmt = $conn->prepare("UPDATE orders SET order_status=? WHERE order_id=?");
    $stmt->bind_param('si', $order_status, $order_id);
    $stmt->execute();

    // Registrar información del pago
    $stmt1 = $conn->prepare("INSERT INTO payments (order_id, user_id, transaction_id)
                             VALUES (?, ?, ?)");
    $stmt1->bind_param('iii', $order_id, $user_id, $transaction_id);
    $stmt1->execute();

    // Asignar puntos al usuario
    $points_per_dollar = 10; // Configuración: 10 puntos por cada unidad monetaria
    $query = "SELECT order_cost FROM orders WHERE order_id = ?";
    $stmt2 = $conn->prepare($query);
    $stmt2->bind_param('i', $order_id);
    $stmt2->execute();
    $result = $stmt2->get_result();
    
    if ($row = $result->fetch_assoc()) {
        $order_cost = $row['order_cost'];
        $points_earned = $order_cost * $points_per_dollar;

        // Actualizar los puntos del usuario
        $points_query = "INSERT INTO user_points (user_id, points)
                         VALUES (?, ?)
                         ON DUPLICATE KEY UPDATE points = points + VALUES(points)";
        $points_stmt = $conn->prepare($points_query);
        $points_stmt->bind_param('ii', $user_id, $points_earned);
        $points_stmt->execute();
    }

    // Redirigir a la cuenta del usuario con un mensaje
    header("location: ../account.php?payment_message=Pago completado con éxito. Has ganado $points_earned puntos.");
    exit;
}
?>
