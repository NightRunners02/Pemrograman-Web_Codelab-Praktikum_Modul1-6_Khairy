<?php 

namespace app\Controller;

include "app/Traits/ApiResponseFormatter.php";
include "app/Models/Product.php";

use app\Models\Product;
use app\Traits\ApiResponseFormatter;

class ProductController 
{
    use ApiResponseFormatter;

    // Mendapatkan semua produk
    public function index() 
    {
        // Definisi objek model Product yang sudah dibuat
        $productModel = new Product();
        $response = $productModel->findAll();

        // Return $response dengan melakukan formatting terlebih dahulu menggunakan trait
        return $this->apiResponse(200, "success", $response);
    }

    // Mendapatkan produk berdasarkan ID
    public function getById($id) 
    {
        $productModel = new Product();
        $response = $productModel->findById($id);

        return $this->apiResponse(200, "success", $response);
    }

    // Menambahkan produk baru
    public function insert() 
    {
        // Tangkap input JSON
        $jsonInput = file_get_contents('php://input');
        $inputData = json_decode($jsonInput, true);

        // Validasi input valid atau tidak
        if (json_last_error()) {
            return $this->apiResponse(400, "Error: invalid input", null);
        }

        $productModel = new Product();
        $response = $productModel->create([
            "product_name" => $inputData['product_name']
        ]);

        return $this->apiResponse(200, "success", $response);
    }

    // Memperbarui produk berdasarkan ID
    public function update($id) 
    {
        $jsonInput = file_get_contents('php://input');
        $inputData = json_decode($jsonInput, true);

        if (json_last_error()) {
            return $this->apiResponse(400, "Error: invalid input", null);
        }

        $productModel = new Product();
        $response = $productModel->update([
            "product_name" => $inputData['product_name']
        ], $id);

        return $this->apiResponse(200, "success", $response);
    }

    // Menghapus produk berdasarkan ID
    public function delete($id) 
    {
        $productModel = new Product();
        $response = $productModel->delete($id);

        return $this->apiResponse(200, "success", $response);
    }
}
