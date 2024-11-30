<?php

session_start();

if(isset($_POST['add_to_cart'])){

    //if el usuario tiene ya agregado un producto al carro
    if(isset($_SESSION['cart'])){

        $products_array_ids = array_column($_SESSION['cart'], "product_id"); // [2,3,4,10,25]
        //if el producto se ha añadido al carito o no
        if( !in_array($_POST['product_id'], $products_array_ids) ){

            $product_id = $_POST['product_id'];

            $product_array = array(
                             'product_id' => $_POST['product_id'],
                             'product_name' => $_POST['product_name'],
                             'product_price' => $_POST['product_price'],
                             'product_image' => $_POST['product_image'],
                             'product_quantity' => $_POST['product_quantity']
            );

            $_SESSION['cart'][$product_id] = $product_array;
        //[ 2=>[], 3=>[], 5=>[] ]

        //el producto se ha añadido
        }else{

            echo '<script>alert("El producto ya estaba en el carrito")</script>';

        }


        //if este es el  primer producto
    }else{

        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_image = $_POST['product_image'];
        $product_quantity = $_POST['product_quantity'];

        $product_array = array(
                         'product_id' => $product_id,
                         'product_name' => $product_name,
                         'product_price' => $product_price,
                         'product_image' => $product_image,
                         'product_quantity' => $product_quantity
        );

        $_SESSION['cart'][$product_id] = $product_array;
        //[ 2=>[], 3=>[], 5=>[] ]

    }


//remover el producto del carro
}else if(isset($_POST['remove_product'])){

    $product_id = $_POST['product_id'];
    unset($_SESSION['cart'][$product_id]);


}else if(isset($_POST['edit_quantity'])){

    $product_id = $_POST['product_id'];
    $product_quantity = $_POST['product_quantity'];

    $product_array = $_SESSION['cart'][$product_id];

    $product_array['product_quantity'] = $product_quantity;

    $_SESSION['cart'][$product_id] = $product_array;

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

    <!--Cart-->
    <section class="cart container my-5 py-5">
        <div class="container mt-5">
            <h2 class="font-weight-bolde">Tu Carrito</h2>
            <hr>
        </div>

        <table class="mt-5 pt-5">
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
            </tr>

            <?php foreach($_SESSION['cart'] as $key => $value){ ?>

            <tr>
                <td>
                    <div class="product-info">
                        <img src="assets/imgs/<?php echo $value['product_image']; ?>" />
                        <div>
                            <p><?php echo $value['product_name']; ?></p>
                            <small><span>$</span><?php echo $value['product_price']; ?></small>
                            <br>
                            <form method="POST" action="cart.php">
                                <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>">
                                <input type="submit" name="remove_product" class="remove-btn" value="remove"/>
                            </form>
                        </div>
                    </div>
                </td>

                <td>
                    <input type="number" value="<?php echo $value['product_quantity']; ?>"/>
                    <form method="POST" action="cart.php">
                        <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>"/>
                        <input type="number" name="product_quantity" value="<?php echo $value['product_quantity']; ?>"/>
                        <input type="submit" class="edit_btn" value="edit" name="edit_quantity">
                    </form>
                </td>

                <td>
                    <span>$</span>
                    <span class="product-price">60.000</span>
                </td>
            </tr>

            <?php } ?>

        </table>

        <div class="cart-total">
            <table>
                <tr>
                    <td>Subtotal</td>
                    <td>$60.000</td>
                </tr>
                <tr>
                    <td>Total</td>
                    <td>$60.000</td>
                </tr>
            </table>
        </div>

        <div class="checkout-container">
            <button class="btn checkout-btn">Checkout</button>
        </div>

    </section>


    <!--Footer-->
    <footer class="mt-5 py-5">
        <div class="row container mx-auto pt-5">
            <div class="footer-one col-lg-3 col-md-6 col-sm-12">
                <img class="logo" src="assets/imgs/logo.jpg" />
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
                    <img src="assets/imgs/billie.jpg" class="img-fluid w-25 h-100 m-2" />
                    <img src="assets/imgs/dualipa.jpg" class="img-fluid w-25 h-100 m-2" />
                    <img src="assets/imgs/billie.jpg" class="img-fluid w-25 h-100 m-2" />
                    <img src="assets/imgs/dualipa.jpg" class="img-fluid w-25 h-100 m-2" />
                    <img src="assets/imgs/billie.jpg" class="img-fluid w-25 h-100 m-2" />
                </div>
            </div>
        </div>

        <div class="copyright  mt-5">
            <div class="row container mx-auto">
                <div class="col-lg-3 col-md-5 col-sm-12 mb-4">
                    <img src="assets/imgs/payment.png" />
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