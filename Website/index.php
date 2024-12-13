<?php

include('layouts/header.php');

?>


    <!--Home-->
    <section id="home">
        <div class="container">
            <h1><span>Ofrecemos productos de alta calidad</span></h1>
            <h2><span>A un menor precio</span></h2>
        </div>
    </section>

    <!--Brand-->
    <section id="brand" class="container">
        <div class="row d-flex justify-content-center">
            <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assets/imgs/apple_logo.png">
            <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assets/imgs/jordan_logo.png">
        </div>
    </section>

   <!--New
    <section id="new" class="w-100">
        <div class="row p-0 m-0">
            
            <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
                <img class="img-fluid" src="assets/imgs/back.jpg">
                <div class="details">
                    <h2>Nuevos Audifonos</h2>
                    <button class="text-uppercase">Comprar Ahora</button>
                </div>
            </div>
            
            <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
                <img class="img-fluid" src="assets/imgs/back.jpg">
                <div class="details">
                    <h2>Nuevos Audifonos</h2>
                    <button class="text-uppercase">Comprar Ahora</button>
                </div>
            </div>
            <
            <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
                <img class="img-fluid" src="assets/imgs/back.jpg">
                <div class="details">
                    <h2>Nuevos Audifonos</h2>
                    <button class="text-uppercase">Comprar Ahora</button>
                </div>
            </div>


        </div>
    </section-->

    <!--Airpods-->
    <section id="featured" class="my-5 pb-5">
        <div class="container text-center mt-5 py-5">
            <h3>Productos Apple</h3>
            <hr class="mx-auto">
            <p>Aqui puedes ver nuestros productos Apple</p>
        </div>
        <div class="row mx-auto container-fluid">

        <?php include('server/get_airpods.php'); ?>

        <?php while($row= $Airpods_products->fetch_assoc()){ ?>
            <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                <img class="img-fluid mb-3" src="assets/imgs/<?php echo $row['product_image']; ?>"/>

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
            <h1><span>Productos Nike</span></h1>
        </div>
    </section>

    <!--Zapatillas-->
    <section id="featured" class="my-5">
        <div class="container text-center mt-5 py-5">
            <h3>Productos Nike</h3>
            <hr class="mx-auto">
            <p>Aqui puedes ver nuestros productos Nike</p>
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
                <a href="<?php echo "single_product.php?product_id=", $row['product_id'];?>"><button class="buy-btn">Comprar Ahora</button></a>
            </div>

            <?php } ?>
            </div>
        </div>
    </section>



<?php

include('layouts/footer.php');


?>