<?php
namespace Controller;

include "Traits/ResponseFormatter.php";
include "Controllers/Controller.php";

use Traits\ResponseFormatter;

class ProductController extends Controller {
    use ResponseFormatter;

    // Constructor untuk inisialisasi controllerName dan controllerMethod
    public function __construct() {
        $this->controllerName = "Get All Product";
        $this->controllerMethod = "GET";
    }

    // Method untuk mendapatkan semua produk
    public function getAllProduct() {
        // Array Dummy Data
        $dummyData = [
            "Air Mineral",
            "Kebab",
            "Spaghetti",
            "Jus Jambu"
        ];

        // Response yang menggabungkan atribut controller dan data produk
        $response = [
            "controller_attribute" => $this->getControllerAttribute(),
            "product" => $dummyData
        ];

        // Mengembalikan response JSON
        return $this->responseFormatter(200, "Success", $response);
    }
}

