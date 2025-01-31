<?php

namespace Model;

class Blog extends ActiveRecord {
    protected static $tabla = 'blogs';
    protected static $columnasDB = ['id', 'titulo', 'descripcion', 'imagen', 'fecha', 'autor'];

    public $id;
    public $titulo;
    public $descripcion;
    public $imagen;
    public $fecha;
    public $autor;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->titulo = $args['titulo'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->fecha = date('Y/m/d');
        $this->autor = $args['autor'] ?? '';
    }

    public function validar() {
        if(!$this->titulo) {
            self::$errores[] = "Debes añadir un título";
        }

        if(!$this->descripcion) {
            self::$errores[] = "Debes añadir una descripción";
        }

        if(!$this->imagen) {
            self::$errores[] = "Debes añadir una imagen";
        }

        if(!$this->autor) {
            self::$errores[] = "Debes añadir un autor";
        }

        return self::$errores;
    }
    
}