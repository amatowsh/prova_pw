<?php
session_start();

require_once '../config/config.php';

// Autoloader
spl_autoload_register(function ($class_name) {
    $file = '../app/models/' . $class_name . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

spl_autoload_register(function ($class_name) {
    $file = '../app/controllers/' . $class_name . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

spl_autoload_register(function ($class_name) {
    $file = '../app/core/' . $class_name . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});


// Roteamento
$controller_name = isset($_GET['controller']) ? ucfirst($_GET['controller']) . 'Controller' : 'ProdutoController';
$action_name = isset($_GET['action']) ? $_GET['action'] : 'listar';

if (class_exists($controller_name)) {
    $controller = new $controller_name();
    if (method_exists($controller, $action_name)) {
        $controller->$action_name();
    } else {
        echo "Ação não encontrada.";
    }
} else {
    echo "Controlador não encontrado.";
}

