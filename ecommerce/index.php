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
                        <a href="cart.php"><i class="fas fa-shopping-bag"></i></a>
                        <a href="account.html"><i class="fas fa-user"></i></a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>


    <!--Home-->
    <section id="home">
        <div class="container">
            <h5>Nuevo item</h5>
            <H1><span>Airpods Pro 2</span> Precio Calidad</H1>
            <p>XXXXXX</p>
            <button>Comprar Ahora</button>
        </div>
    </section>

    <!--Brand-->
    <section id="brand" class="container">
        <div class="row">
            <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assets/imgs/apple_logo.jpg">
            <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assets/imgs/jordan_logo.jpg">
            <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assets/imgs/adidas_logo.jpg">
            <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assets/imgs/puma_logo.jpg">
        </div>
    </section>

    <!--New-->
    <section id="new" class="w-100">
        <div class="row p-0 m-0">
            <!--One-->
            <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
                <img class="img-fluid" src="assets/imgs/back.jpg">
                <div class="details">
                    <h2>Nuevos Audifonos</h2>
                    <button class="text-uppercase">Comprar Ahora</button>
                </div>
            </div>
            <!--New-->
            <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
                <img class="img-fluid" src="assets/imgs/back.jpg">
                <div class="details">
                    <h2>Nuevos Audifonos</h2>
                    <button class="text-uppercase">Comprar Ahora</button>
                </div>
            </div>
            <!--New-->
            <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
                <img class="img-fluid" src="assets/imgs/back.jpg">
                <div class="details">
                    <h2>Nuevos Audifonos</h2>
                    <button class="text-uppercase">Comprar Ahora</button>
                </div>
            </div>


        </div>
    </section>

    <!--Featured-->
    <section id="featured" class="my-5 pb-5">
        <div class="container text-center mt-5 py-5">
            <h3>Nuestros Productos</h3>
            <hr class="mx-auto">
            <p>Aqui puedes ver nuestros productos</p>
        </div>
        <div class="row mx-auto container-fluid">

        <?php include('server/get_featured_products.php'); ?>

        <?php while($row= $featured_products->fetch_assoc()){ ?>
            <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                <img class="img-fluid mb-3" src="assets/imgs/<?php echo $row['product_image']; ?>"/>
                <div class="star">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <h5 class="p-name"><?php echo $row['product_name']; ?></h5>
                <h4 class="p-price">$ <?php echo $row['product_price']; ?></h4>
                <a href="<?php echo "single_product.php?product_id=", $row['product_id'];?>"><button class="buy-btn">Comprar Ahora</button></a>
            </div>

            <?php } ?>
        </div>
    </section>

    <!--Banner-->
    <section id="banner" class="my-5 py-5">
        <div class="container">
            <h4>ZZZZZZZ</h4>
            <h1>ZZZZZZZZ</h1>
            <button class="text-uppercase">Comprar Ahora</button>
        </div>
    </section>

    <!--Zapatillas-->
    <section id="featured" class="my-5">
        <div class="container text-center mt-5 py-5">
            <h3>Zapatillas 1:1 de alta calidad</h3>
            <hr class="mx-auto">
            <p>Aqui puedes ver nuestros productos</p>
        </div>
        <div class="row mx-auto container-fluid">

        <?php include('server/get_shoes.php'); ?>

        <?php while($row= $shoes_products->fetch_assoc()){ ?>
            <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                <img class="img-fluid mb-3" src="assets/imgs/<?php echo $row['product_image']; ?>"/>
                <div class="star">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <h5 class="p-name"><?php echo $row['product_name']; ?></h5>
                <h4 class="p-price">$ <?php echo $row['product_price']; ?></h4>
                <a href="single_product.php"><button class="buy-btn">Comprar Ahora</button></a>
            </div>

            <?php } ?>
            </div>
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