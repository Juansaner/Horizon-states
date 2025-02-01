<?php

namespace MVC;

class Router {
    //Almacenan las rutas para cada método
    public $rutasGET = [];
    public $rutasPOST = [];
    
    //Registra la ruta para el método get
    public function get($url, $fn) {
        $this->rutasGET[$url] = $fn;
    }

    //Registra la ruta para el método post
    public function post($url, $fn) {
        $this->rutasPOST[$url] = $fn;
    }

    //Comprueba el tipo de REQUEST_METHOD
    public function comprobarRutas() {

        session_start();
        $auth = $_SESSION['login'] ?? NULL;

        //Arreglo de rutas protegidas
        $rutas_protegidas = ['/admin', '/propiedades/crear', '/propiedades/actualizar', '/propiedades/eliminar', '/vendedores/crear', '/vendedores/actualizar', '/vendedores/eliminar'];

        //Obtiene URL que el usuario solicita
        $urlActual = strtok($_SERVER['REQUEST_URI'], '?') ?? '/';

        //Obtiene el método HTTP de la solicitud
        $metodo = $_SERVER['REQUEST_METHOD'];

        //Busca en el array correspondiente la función asociada a la URL
        if($metodo === 'GET') {
            $fn = $this->rutasGET[$urlActual] ?? Null;
        } else {
            $fn = $this->rutasPOST[$urlActual] ?? Null;
        }

        if(in_array($urlActual, $rutas_protegidas)&& !$auth) {
            header('Location: /');
        }

        // Se ejecuta si encuentra una función y pasa el objeto router como argumento
        if($fn) {
            call_user_func($fn, $this);
        }
    }

    //Muestra la vista
    public function render($view, $datos = []) {

        foreach($datos as $key => $value) {
            $$key = $value;
        }
        
        ob_start(); //Almacenamiento en memoria durante un momento
        include __DIR__ . "/views/$view.php";

        $contenido = ob_get_clean(); //Limpia el buffer

        include __DIR__ . "/views/layout.php";
    }
}