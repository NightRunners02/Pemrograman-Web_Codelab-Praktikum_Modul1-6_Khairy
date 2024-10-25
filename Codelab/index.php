<?php
include "Controllers/ProductController.php";

use Controller\ProductController;

// Membuat objek ProductController
$productController = new ProductController();

// Memanggil method getAllProduct dan mencetak hasilnya
echo $productController->getAllProduct();
