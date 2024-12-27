<?php

include('connection.php');


$stmt = $conn->prepare("SELECT * FROM products WHERE product_category = 'Airpods' LIMIT 4");

$stmt->execute();


$Airpods_products = $stmt->get_result();//[]





?>