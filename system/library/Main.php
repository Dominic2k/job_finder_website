<?php

class Main {

    public $url;

    public $controllerName = 'homepage';

    public $methodName = 'index';
    public $controllerPath = 'app/controllers/';
    public $controller;

    public function __construct() {
        $this->getUrl();
        $this->loadController();
        $this->callMethod();    
    }

    public function getUrl() {
        $this->url = isset($_GET['url']) ? $_GET['url'] : null;
    
        if ($this->url != null) {
            $this->url = rtrim($this->url, '/');
            $this->url = explode('/', filter_var($this->url, FILTER_SANITIZE_URL));
        } else {
            $this->url = []; // Sửa thành $this->url để tránh lỗi
        }
    }

    public function loadController() {
        if (!isset($this->url[0])) {
            include $this->controllerPath . $this->controllerName . ".php";
            $this->controller = new $this->controllerName;
        } else {
            $this->controllerName = $this->url[0];
            $fileName = $this->controllerPath . $this->controllerName . ".php";
            if (file_exists($fileName)) {
                include $fileName;
                if (class_exists($this->controllerName)) {
                    $this->controller = new $this->controllerName();
                } else {
                    // Gán giá trị mặc định nếu class không tồn tại
                    $this->controller = null;
                }
            } else {
                // Gán giá trị mặc định nếu file không tồn tại
                $this->controller = null;
            }
        }
    }
    

    // public function callMethod() {
    //     if ($this->controller === null) {
    //         header("Location: " . BASE_URL . "index/notfound");
    //         return;
    //     }
    
    //     if (isset($this->url[2])) {
    //         $this->methodName = $this->url[1];
    //         if (method_exists($this->controller, $this->methodName)) {
    //             $this->controller->{$this->methodName}($this->url[2]);
    //         } else {
    //             header("Location: " . BASE_URL . "index/notfound");
    //         }
    //     } else {
    //         if (isset($this->url[1])) {
    //             $this->methodName = $this->url[1];
    //             if (method_exists($this->controller, $this->methodName)) {
    //                 $this->controller->{$this->methodName}();
    //             } else {
    //                 header("Location: " . BASE_URL . "index/notfound");
    //             }
    //         } else {
    //             if (method_exists($this->controller, $this->methodName)) {
    //                 $this->controller->{$this->methodName}();
    //             } else {
    //                 header("Location: " . BASE_URL . "index/notfound");
    //             }
    //         }
    //     }
    // }
    // public function callMethod() {
    //     if ($this->controller === null) {
    //         header("Location: " . BASE_URL . "index/notfound");
    //         return;
    //     }
    //     $methodName = $this->url[1] ?? $this->methodName;
    //     $parameter = $this->url[2] ?? null;
    
    //     if (method_exists($this->controller, $methodName)) {
    //         if ($parameter) {
    //             $this->controller->{$methodName}($parameter);
    //         } else {
    //             $this->controller->{$methodName}();
    //         }
    //     } else {
    //             header("Location: " . BASE_URL . "index/notfound");
    //     }
    // }

    public function callMethod() {
        // Nếu controller là null, chuyển hướng đến trang lỗi, nhưng tránh khi đang ở trang lỗi
        if ($this->controller === null && $this->url[0] !== 'homepage/notfound') {
            header("Location: " . BASE_URL . "homepage/notfound");
            return;
        }
    
        $methodName = $this->url[1] ?? $this->methodName;
        $parameter = $this->url[2] ?? null;
    
        if (method_exists($this->controller, $methodName)) {
            if ($parameter) {
                $this->controller->{$methodName}($parameter);
            } else {
                $this->controller->{$methodName}();
            }
        } else {
            // Nếu phương thức không tồn tại, chuyển hướng đến trang lỗi
            if ($this->url[0] !== 'homepage/notfound') {
                header("Location: " . BASE_URL . "homepage/notfound");
            }
        }
    }
    
}