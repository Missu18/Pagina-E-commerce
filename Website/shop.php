<?php

include('server/connection.php');


//Usar la sección de busqueda
if(isset($_POST['search'])){


    //1. Determinar el número de página
    if(isset($_GET['page_no']) && $_GET['page_no'] != ""){

        //Si el usuario ya ha ingresado a la página, el número de página es el que seleccionó
        $page_no = $_GET['page_no'];
    }else{
        //Si el usuario acaba de ingresar a la página, la página predeterminada es 1
        $page_no = 1;

    }

    $category = $_POST['category'];
    $price = $_POST['price'];

    //2. Número de productos devueltos
    $stmt1 = $conn->prepare("SELECT COUNT(*) As total_records FROM products WHERE product_category=? AND product_price<=?");
    $stmt1->bind_param('si',$category,$price);
    $stmt1->execute();
    $stmt1->bind_result($total_records);
    $stmt1->store_result();
    $stmt1->fetch();

    //3. Productos por página
    $total_records_per_page = 2;

    $offset = ($page_no-1) * $total_records_per_page;

    $previous_page = $page_no - 1;
    $next_page = $page_no + 1;

    $adjacents = "2";

    $total_no_of_pages = ceil($total_records/$total_records_per_page);

    //4. Obtener todos los productos

    $stmt2 = $conn->prepare("SELECT * FROM products WHERE product_category=? AND product_price<=? LIMIT $offset,$total_records_per_page");
    $stmt2->bind_param("si",$category,$price);
    $stmt2->execute();
    $products = $stmt2->get_result();//[]





//Devolver todo el producto
}else{

    //1. Determinar el número de página
    if(isset($_GET['page_no']) && $_GET['page_no'] != ""){

        //Si el usuario ya ha ingresado a la página, el número de página es el que seleccionó
        $page_no = $_GET['page_no'];
    }else{
        //Si el usuario acaba de ingresar a la página, la página predeterminada es 1
        $page_no = 1;

    }
    //2. Número de productos devueltos
    $stmt1 = $conn->prepare("SELECT COUNT(*) As total_records FROM products");
    $stmt1->execute();
    $stmt1->bind_result($total_records);
    $stmt1->store_result();
    $stmt1->fetch();

    //3. Productos por página
    $total_records_per_page = 8;

    $offset = ($page_no-1) * $total_records_per_page;

    $previous_page = $page_no - 1;
    $next_page = $page_no + 1;

    $adjacents = "2";

    $total_no_of_pages = ceil($total_records/$total_records_per_page);

    //4. Obtener todos los productos

    $stmt2 = $conn->prepare("SELECT * FROM products LIMIT $offset,$total_records_per_page");
    $stmt2->execute();
    $products = $stmt2->get_result();
}




?>


<?php

include('layouts/header.php');

?>

    <!--Featured-->
    <section id="search" class="my-5 py-5 ms-2">
        <div class="container mt-5 py-5">
            <p>Buscar productos</p>
            <hr>
        </div>

            <form action="shop.php" method="POST">
                <div class="row mx-auto container">
                    <div class="col-lg-12 col-md-12 col-sm-12">


                        <p>Categoria</p>
                        <div class="form-check">
                            <input class="form-check-input" value="zapatillas" type="radio" name="category" id="category_one" <?php if(isset($category) && $category=='shoes'){echo 'checked';}?>>
                            <label class="form-check-label" for="flexRadioDefault1">
                                Zapatillas
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" value="airpods" type="radio" name="category" id="category_two" <?php if(isset($category) && $category=='Airpods'){echo 'checked';}?>>
                            <label class="form-check-label" for="flexRadioDefault2">
                                Airpods
                            </label>
                        </div>


                    </div>
                </div>

                <div class="row mx-auto container mt-5">
                    <div class="col-lg-12 col-md-12 col-sm-12">

                        <p>Precio</p>
                        <input type="range" class="form-range w-50" name="price" value="<?php if(isset($price)) {echo $price;}else{ echo "100";} ?>" min="1" max="1000" id="customRange2">
                        <div class="w-50">
                            <span style="float: left;">75000</span>
                            <span style="float: right;">300000</span>
                        </div>
                    </div>
                </div>


                <div class="form-group my-3 mx-3">
                    <input type="submit" name="search" value="Search" class="btn btn-primary">
                </div>
            </form>

            
            
            
            
            
            
        
           
            
            

   
    </section>


    <!--Shop-->
    <section id="shop" class="my-5 py-5">
        <div class="container text-center mt-5 py-5">
            <h3>Nuestros Productos</h3>
            <hr class="mx-auto">
            <p>Aqui puedes ver nuestros productos</p>
        </div>
        <div class="row mx-auto container">

        <?php while($row = $products->fetch_assoc()) { ?>
            <div onclick="window.location.href='single_product.html';" class="product text-center col-lg-3 col-md-4 col-sm-12">
                <img class="img-fluid mb-3" src="assets/imgs/<?php echo $row['product_image']; ?>"/>
                
                <h5 class="p-name"><?php echo $row['product_name']; ?></h5>
                <h4 class="p-price">$<?php echo $row['product_price']; ?></h4>
                <a class="btn shop-buy-btn" href="<?php echo "single_product.php?product_id=".$row['product_id']; ?>">Comprar ahora</a>
            </div>

            <?php } ?>
            
            <nav class="Page navigation example">
                <ul class="pagination mt-5">

                    <li class="page-item <?php if($page_no<=1){echo 'disabled';}?>">
                        <a class="page-link" href="<?php if($page_no <= 1){echo '#';}else{ echo "?page_no=".($page_no-1);} ?>">Anterior</a>
                    </li>


                    <li class="page-item"><a class="page-link" href="?page_no=1">1</a></li>
                    <li class="page-item"><a class="page-link" href="?page_no=2">2</a></li>

                    <?php if( $page_no >= 3) {?>
                    <li class="page-item"><a class="page-link" href="#">...</a></li>
                    <li class="page-item"><a class="page-link" href="<?php echo "?page_no=".$page_no;?>"><?php echo $page_no;?></a></li>
                    <?php } ?>


                    <li class="page-item <?php if($page_no >= $total_no_of_pages){echo 'disabled';}?>">
                        <a class="page-link" href="<?php if($page_no >= $total_no_of_pages ){echo '#';} else{ echo "?page_no=".($page_no+1);}?>">Siguiente</a>
                    </li>
                </ul>
            </nav>

        </div>
    </section>


<?php

include('layouts/footer.php');

?>