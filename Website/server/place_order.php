<?php

session_start();

include('connection.php');


//Si el usuario no esta logueado
if(!isset($_SESSION['logged_in'])){
    header('location: ../checkout.php?message=Por favor logueate/Regístrese para realizar un pedido');
    exit;

//Si el usuario esta logueado
}else{


        if(isset($_POST['place_order'])){

            //1. Obtener información del usuario y almacenarla en la base de datos
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $city = $_POST['city'];
            $address = $_POST['address'];
            $order_cost = $_SESSION['total'];
            $order_status = "No Pagado";
            $user_id = $_SESSION['user_id'];
            $order_date = date('Y-m-d H:i:s');

            $stmt = $conn->prepare("INSERT INTO orders (order_cost,order_status,user_id,user_phone,user_city,user_address,order_date)
                            VALUES (?,?,?,?,?,?,?); ");
            
            $stmt->bind_param('isiisss',$order_cost,$order_status,$user_id,$phone,$city,$address,$order_date);

            $stmt_status = $stmt->execute();

            if(!$stmt_status){
                header('location: index.php');
                exit;
            }

            // 2. emitir un nuevo pedido y almacenar la información del pedido en la base de datos
            $order_id = $stmt->insert_id;



            //3. Obtener productos del carrito (de la session)
            foreach($_SESSION['cart'] as $key=>$value){

                $product = $_SESSION['cart'][$key];
                $product_id = $product['product_id'];
                $product_name = $product['product_name'];
                $product_image = $product['product_image'];
                $product_price = $product['product_price'];
                $product_quantity = $product['product_quantity'];

                // 4. Almacene cada uno de los elementos en order_items en la base de datos 
                $stmt1 = $conn->prepare("INSERT INTO order_items (order_id,product_id,product_name,product_image,product_price,product_quantity,user_id,order_date)
                            VALUES (?,?,?,?,?,?,?,?)");
                $stmt1->bind_param('iissiiis',$order_id,$product_id,$product_name,$product_image,$product_price,$product_quantity,$user_id,$order_date );
                
                $stmt1->execute();


            }

            


            //5. Remover todo del carrito --> Retraso hasta que se realice el pago
            //unset ($_SESSION('cart'));

            $_SESSION['order_id'] = $order_id;

            //6. Informar al usuario si todo está bien o si hay un problema
            header('location: ../payment.php?order_status="pedido realizado exitosamente');

        }


}



?>