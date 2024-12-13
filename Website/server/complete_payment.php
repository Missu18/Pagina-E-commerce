<?php

session_start();

include('connection.php');


if(isset($_GET['transaction_id']) && isset($_GET['order_id'])){

            $order_id = $_GET['order_id'];
            $order_status = "paid";
            $transaction_id = $_GET['transaction_id'];    
            $user_id = $_SESSION['user_id'];
            $paymeny_date = date('Y-m-d H:i:s');


            //cambio order_status a pagado
            $stmt = $conn->prepare("UPDATE orders SET order_status=? WHERE order_id=?");
            $stmt->bind_param('si',$order_status,$order_id);

            $stmt->execute();


            //Pago de la información de la tienda
            $stmt1 = $conn->prepare("INSERT INTO payments (order_id,user_id,transaction_id)
                            VALUES (?,?,?); ");
            
            $stmt1->bind_param('iii',$order_id,$user_id,$transaction_id);

            $stmt1->execute();


            //Ir a cuenta de usuario
            header("location: ../account.php?payment_message=Pago Exitoso, gracias por elegir nuestra tienda");

} else{
    header("location: index.php");
    exit;
}



?>