<?php

    session_start();

    if( !empty($_SESSION['cart']) ){

        //Permitir la entrada del usuario


        //enviar al usuario a la pagina de inicio

    }else{

        header('location: index.php');
    }







?>




<?php

include('layouts/header.php');


?>


    <!--Checkout-->
    <section class="my-5 py-5">
        <div class="container text-center mt-3 pt-5">
            <h2 class="form-weight-bold">Check Out</h2>
            <hr class="mx-auto">
        </div>
        <div class="mx-auto container">
            <form id="checkout-form" method="POST" action="server/place_order.php">
                <p class="text-center" style="color: red;">
                    <?php if(isset($_GET['message'])){ echo $_GET['message']; }?>
                    <?php if(isset($_GET['message'])) {?>

                        <a href="login.php" class="btn btn-primary">Login</a>

                       <?php } ?> 
                
                </p>
                <div class="form-group checkout-small-element">
                    <label>Name</label>
                    <input type="text" class="form-control" id="checkout-name" name="name" placeholder="Name" required/>
                </div>
                <div class="form-group checkout-small-element">
                    <label>Email</label>
                    <input type="text" class="form-control" id="checkout-email" name="email" placeholder="Email" required/>
                </div>
                <div class="form-group checkout-small-element">
                    <label>Celular</label>
                    <input type="tel" class="form-control" id="checkout-phone" name="phone" placeholder="Phone" required/>
                </div>
                <div class="form-group checkout-small-element">
                    <label>Ciudad</label>
                    <input type="text" class="form-control" id="checkout-city" name="city" placeholder="City" required/>
                </div>
                <div class="form-group checkout-large-element">
                    <label>Dirección</label>
                    <input type="text" class="form-control" id="checkout-address" name="address" placeholder="Address" required/>
                </div>
                <div class="form-group checkout-btn-container">
                    <p>Monto Total: $ <?php echo $_SESSION['total']; ?></p>
                    <input type="submit" class="btn" id="checkout-btn" name="place_order" value="Realizar pedido"/>
                </div>
            </form>
        </div>
    </section>




<?php

include('layouts/footer.php');

?>
