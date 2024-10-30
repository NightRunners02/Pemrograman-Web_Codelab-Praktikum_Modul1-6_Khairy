<?php
namespace Traits;

trait ResponseFormatter {
    // Fungsi untuk mengembalikan respon dalam format JSON
    public function responseFormatter($code, $message, $data = null) {
        return json_encode([
            "code" => $code,
            "message" => $message,
            "data" => $data
        ]);
    }
}


