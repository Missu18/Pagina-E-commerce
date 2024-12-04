<?php

    session_start();

    if( !empty($_SESSION['cart']) && isset($_POST['checkout']) ){

        //Permitir la entrada del usuario


        //enviar al usuario a la pagina de inicio

    }else{

        header('location: index.php');
    }







?>




<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Paginá reqla</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
        integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>


    <!--Navbar-->>
    <nav class="navbar navbar-expand-lg navbar-light bg-white py-3 fixed-top">
        <div class="container">
            <img class="logo" src="assets/imgs/logo.jpg" />
            <h2 class="brand">LosDeLaPaja</h2>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse nav-buttons" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="shop.html">Tienda</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#">Blog</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="contact.html">Contactanos</a>
                    </li>

                    <li class="nav-item">
                        <a href="cart.html"><i class="fas fa-shopping-bag"></i></a>
                        <a href="account.html"><i class="fas fa-user"></i></a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>


    <!--Checkout-->
    <section class="my-5 py-5">
        <div class="container text-center mt-3 pt-5">
            <h2 class="form-weight-bold">Check Out</h2>
            <hr class="mx-auto">
        </div>
        <div class="mx-auto container">
            <form id="checkout-form" method="POST" action="server/place_order.php">
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
                    <input type="submit" class="btn" id="checkout-btn" name="place_order" value="Place Order"/>
                </div>
            </form>
        </div>
    </section>




    <!--Footer-->
    <footer class="mt-5 py-5">
        <div class="row container mx-auto pt-5">
            <div class="footer-one col-lg-3 col-md-6 col-sm-12">
                <img class="logo" src="assets/imgs/logo.jpg"/>
                <p class="pt-3">Traemos los mejores productos actualmente en el mercado a un precio accesible</p>
            </div>
            <div class="footer-one col-lg-3 col-md-6 col-sm-12">
                <h5 class="pb-2">featured</h5>
                <ul class="text-uppercase">
                    <li><a href="#">XD</a></li>
                    <li><a href="#">XD</a></li>
                    <li><a href="#">XD</a></li>
                    <li><a href="#">XD</a></li>
                    <li><a href="#">XD</a></li>
                    <li><a href="#">XD</a></li>
                </ul>
            </div>

            <div class="footer-one col-lg-3 col-md-6 col-sm-12">
                <h5 class="pb-2">Contactanos</h5>
                <div>
                    <h6 class="text-uppercase">Dirección</h6>
                    <p>123 Avenida siempre viva</p>
                </div>
                <div>
                    <h6 class="text-uppercase">Número telefonico</h6>
                    <p>+56 91023 3234</p>
                </div>
                <div>
                    <h6 class="text-uppercase">Correo</h6>
                    <p>info@admin.com</p>
                </div>
            </div>
            <div class="footer-one col-lg-3 col-md-6 col-sm-12">
                <h5 class="pb-2">Instagram</h5>
                <div class="row">
                    <img src="assets/imgs/billie.jpg" class="img-fluid w-25 h-100 m-2"/>
                    <img src="assets/imgs/dualipa.jpg" class="img-fluid w-25 h-100 m-2"/>
                    <img src="assets/imgs/billie.jpg" class="img-fluid w-25 h-100 m-2"/>
                    <img src="assets/imgs/dualipa.jpg" class="img-fluid w-25 h-100 m-2"/>
                    <img src="assets/imgs/billie.jpg" class="img-fluid w-25 h-100 m-2"/>
                </div>
            </div>
        </div>

        <div class="copyright  mt-5">
            <div class="row container mx-auto">
                <div class="col-lg-3 col-md-5 col-sm-12 mb-4">
                    <img src="assets/imgs/payment.png"/>
                </div>
                <div class="col-lg-3 col-md-5 col-sm-12 mb-4 text-nowrap mb-2">
                    <p>eCommerce @ 2025 All Right Reserved Jesús Olguín</p>
                </div>
                <div class="col-lg-3 col-md-5 col-sm-12 mb-4">
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>