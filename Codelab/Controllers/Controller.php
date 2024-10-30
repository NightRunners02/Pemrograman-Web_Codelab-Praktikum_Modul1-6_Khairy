<?php
namespace Controller;

class Controller {
    // Deklarasi atribut dengan visibility
    public $controllerName;
    public $controllerMethod;

    // Method untuk mengambil semua atribut
    public function getControllerAttribute() {
        return [
            "ControllerName" => $this->controllerName,
            "Method" => $this->controllerMethod
        ];
    }
}
