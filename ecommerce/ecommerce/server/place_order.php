<?php

session_start();

include('connection.php');


if(isset($_POST['place_order'])){

    //1. Obtener información del usuario y almacenarla en la base de datos
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $city = $_POST['city'];
    $address = $_POST['address'];
    $order_cost = $_SESSION['total'];
    $order_status = "on_hold";
    $user_id = 1;
    $order_date = date('Y-m-d H:i:s');

    $stmt = $conn->prepare("INSERT INTO orders (order_cost,order_status,user_id,user_phone,user_city,user_address,order_date)
                    VALUES (?,?,?,?,?,?,?); ");
    
    $stmt->bind_param('isiisss',$order_cost,$order_status,$user_id,$phone,$city,$address,$order_date);

    $stmt->execute();

   $order_id = $stmt->insert_id;
   
   echo $order_id;




    //2. Obtener productos del carrito (de la session)


    //3. Emitir una nueva orden y Almacenar información de pedidos en la base de datos

        
    //4. Almacene cada uno de los elementos en order_items en la base de datos


    //5. Remover todo del carrito


    //6. Informar al usuario si todo está bien o si hay un problema

}






?>