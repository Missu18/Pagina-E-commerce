<?php

session_start();
include('server/connection.php');

// Obtener el ID del usuario desde la sesión
$user_id = $_SESSION['user_id'];

// Consultar los puntos del usuario
$query = "SELECT points FROM user_points WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    $user_points = $row['points'];
} else {
    $user_points = 0; // Si no hay puntos registrados, mostrar 0
}


if(!isset($_SESSION['logged_in'])){
    header('location: login.php');
    exit;
}


if(isset($_GET['logout'])){
    if(isset($_SESSION['logged_in'])){
        unset($_SESSION['logged_in']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        header('location: login.php');
        exit;
    }
}

if(isset($_POST['change_password'])){
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $user_email = $_SESSION['user_email'];

    // Si tus contraseñas no son similares
    if ($password !== $confirmPassword) {
        header('location: account.php?error=las contraseñas no coinciden');
    } 
    // Si tu contraseña tiene menos de 6 caracteres
    else if (strlen($password) < 6) {
        header('location: account.php?error=La contraseña debe tener al menos 6 caracteres');
    //no errores
    }else{


        $stmt = $conn->prepare("UPDATE users SET user_password=? WHERE user_email=?");
        $stmt->bind_param('ss',md5($password),$user_email);

        if($stmt->execute()){
            header('location: account.php?message=La contraseña se ha actualizado con éxito');
        }else{
            header('location: account.php?error=No se pudo actualizar la contraseña');
        }
    } 
}


//Recibir pedidos
if(isset($_SESSION['logged_in'])){

    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("SELECT * FROM orders WHERE user_id=? ");

    $stmt->bind_param('i',$user_id);

    $stmt->execute();

    $orders = $stmt->get_result();//[]
}



?>


<?php

include('layouts/header.php');


?>


    <!--Account-->
    <section class="my-5 py-5">
        <div class="row container mx-auto">
            <?php if(isset($_GET['payment_message'])){ ?>
                <p class="mt-5 text-center" style="color: green"><?php echo $_GET['payment_message']; ?></p>

                <?php } ?>
            <div class="text-center mt-3 pt-5 col-lg-6 col-md-12 col-sm-12">
            <p class="text-center" style="color:green"><?php if(isset($_GET['register_success'])){echo $_GET['register_success']; }?></p>
            <p class="text-center" style="color:green"><?php if(isset($_GET['login_success'])){echo $_GET['login_success']; }?></p>
                <h3 class="font-weight-bold">Información de la cuenta</h3>
                <hr class="mx-auto">
                <div class="account-info">
                    <p>Nombre <span><?php if(isset($_SESSION['user_name'])){echo $_SESSION['user_name'];} ?></span></p>
                    <p>Email <span><?php if(isset($_SESSION['user_email'])){echo $_SESSION['user_email'];} ?></span></p>
                    <p><a href="#orders" id="orders-btn">Tus ordenes</a></p>
                    <p><a href="account.php?logout=1" id="logout-btn">Logout</a></p>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12">
                <form id="account-form" method="POST" action="account.php">
                    <p class="text-center" style="color:red"><?php if(isset($_GET['error'])){echo $_GET['error']; }?></p>
                    <p class="text-center" style="color:green"><?php if(isset($_GET['message'])){echo $_GET['message']; }?></p>
                    <h3>Cambiar Contraseña</h3>
                    <hr class="mx-auto">
                    <div class="form-group">
                        <label>Contraseña</label>
                        <input type="password" class="form-control" id="account-password" name="password" placeholder="Password" required/>
                    </div>
                    <div class="form-group">
                        <label>Confirmar Contraseña</label>
                        <input type="password" class="form-control" id="account-password-confirm" name="confirmPassword" placeholder="Password" required/>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Change Password" name="change_password"class="btn" id="change-pass-btn">
                    </div>
                </form>
            </div>
            <div class="user-points">
                <h3>Tus Puntos</h3>
                <p>Tienes <strong><?php echo $user_points; ?></strong> puntos acumulados.</p>
            </div>
        </div>
    </section>

    <!--Orders-->
    <section id="orders" class="orders container my-5 py-3">
        <div class="container mt-2">
            <h2 class="font-weight-bolde text-center">Tu Carrito</h2>
            <hr class="mx-auto">
        </div>

        <table class="mt-5 pt-5">
            <tr>
                <th>Id del pedido</th>
                <th>Costo del pedido</th>
                <th>Estado del pedido</th>
                <th>Fecha del pedido</th>
                <th>Detalles del pedido</th>
            </tr>

            <?php while($row = $orders->fetch_assoc() ){ ?>
                <tr>
                    <td>
                        <!-- div class="product-info">
                            <img src="assets/imgs/nike.jpg"/>
                            <div>
                                <p class="mt-3"><?php echo $row['order_id']; ?></p>
                            </div>
                        </div> -->
                        <span><?php echo $row['order_id']; ?></span>
                    </td>

                    <td>
                        <span><?php echo $row['order_cost']; ?></span>
                    </td>

                    <td>
                        <span><?php echo $row['order_status']; ?></span>
                    </td>

                    <td>
                        <span><?php echo $row['order_date']; ?></span>
                    </td>

                    <td>
                        <form method="POST" action="order_details.php">
                            <input type="hidden" value="<?php echo $row['order_status']; ?>" name="order_status"/>
                            <input type="hidden" value="<?php echo $row['order_id']; ?>" name="order_id"/>
                            <input class="btn order-details-btn" name="order_details_btn" type="submit" value="detalles"/>
                        </form>
                    </td>


                </tr>
            <?php } ?>  
            
            

        </table>
    </section>


<?php

include('layouts/footer.php');


?>