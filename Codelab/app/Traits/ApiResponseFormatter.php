<?php 

namespace app\Traits;

// Untuk formatting response
trait ApiResponseFormatter 
{
    public function apiResponse($code = 200, $message = "success", $data = []) 
    {
        // Dari parameter akan diformat menjadi format dibawah ini
        return json_encode([
            "code" => $code,
            "message" => $message,
            "data" => $data
        ]);
    }
}
