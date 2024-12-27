<?php

include('server/connection.php');


if(isset($_GET['product_id'])){

    $product_id = $_GET['product_id'];

    $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
    $stmt->bind_param("i",$product_id);
    $stmt->execute();


    $product = $stmt->get_result();//[]

//No se ha dado ningún ID de producto
}else{
    header('location: index.php');
}




?>


<?php

include('layouts/header.php');

?>

    <!--Single product-->
    <section class="single-product my-5 pt-5">
        <div class="row mt-5">
            
        <?php while($row = $product->fetch_assoc()){ ?>

            
            <div class="col-lg-5 col-md-6 col-sm-12">
                <img class="img-fluid w-100 pb-1" src="assets/imgs/<?php echo $row['product_image']; ?>" id="mainImg"/>
                <div class="small-img-group">
                    <div class="small-img-col">
                        <img src="assets/imgs/<?php echo $row['product_image']; ?>" width="100%" class="small-img">
                    </div>
                    <div class="small-img-col">
                        <img src="assets/imgs/<?php echo $row['product_image2']; ?>" width="100%" class="small-img">
                    </div>
                    <div class="small-img-col">
                        <img src="assets/imgs/<?php echo $row['product_image3']; ?>" width="100%" class="small-img">
                    </div>
                    <div class="small-img-col">
                        <img src="assets/imgs/<?php echo $row['product_image4']; ?>" width="100%" class="small-img">
                    </div>
                </div>
            </div>



            <div class="col-lg-6 col-md-12 col-12">
                <h6>Airpods</h6>
                <h3 class="py-4"><?php echo $row['product_name']; ?></h3>
                <h2>$<?php echo $row['product_price']; ?></h2>

                <form method="POST" action="cart.php">
                    <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>"/>
                    <input type="hidden" name="product_image" value="<?php echo $row['product_image']; ?>"/>
                    <input type="hidden" name="product_name" value="<?php echo $row['product_name']; ?>"/>
                    <input type="hidden" name="product_price" value="<?php echo $row['product_price']; ?>"/>
                
                        <input type="number" name="product_quantity" value="1">
                        <button class="buy-btn" type="submit" name="add_to_cart">Agregar al carrito</button>

                </form>

                <h4 class="mt-5 mb-5">Detalles del producto</h4>
                <span><?php echo $row['product_description']; ?></span>
            </div>

            <?php } ?>

        </div>
    </section>

    <!--Realated products-->
    <section id="realated-products" class="my-5 pb-5">
        <div class="container text-center mt-5 py-5">
            <h3>Productos relacionados</h3>
            <hr class="mx-auto">
        </div>
        <div class="row mx-auto container-fluid d-flex justify-content-center">
            <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                <img class="img-fluid mb-3" src="assets/imgs/airpods4.jpg"/>
                <h5 class="p-name">AirPods 4 con Cancelación Activa de Ruido</h5>
                <h4 class="p-price">$120.000</h4>
                <button class="buy-btn">Comprar Ahora</button>
            </div>
            <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                <img class="img-fluid mb-3" src="assets/imgs/airpodspro2.jpg"/>
                <h5 class="p-name">Airpods Pro 2</h5>
                <h4 class="p-price">$100.000</h4>
                <button class="buy-btn">Comprar Ahora</button>
            </div>
            <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                <img class="img-fluid mb-3" src="assets/imgs/airpodsmax.jpg"/>
                <h5 class="p-name">Airpods Max - Media Noche</h5>
                <h4 class="p-price">$300.000</h4>
                <button class="buy-btn">Comprar Ahora</button>
            </div>
        </div>
    </section>





    <script>

        var mainImg = document.getElementById("mainImg");
        var smallImg = document.getElementsByClassName("small-img");

        for(let i=0; i<4; i++){
            smallImg[i].onclick = function(){
            mainImg.src = smallImg[i].src;
        }    
        }



    </script>


<?php

include('layouts/footer.php');


?>