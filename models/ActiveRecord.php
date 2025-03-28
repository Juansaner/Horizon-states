<?php

namespace Model;

class ActiveRecord  {
    //Base de datos
    protected static $db;
    protected static $columnasDB = [];
    protected static $tabla = '';

    //Errores
    protected static $errores = [];

    //Definir la conexión a la BD
    public static function setDB($database) {
        self::$db = $database;
    }

    public function guardar() {
        if(!is_null($this->id)) {
            //Actualizar
            $this->actualizar();
        } else {
            //Creando un nuevo registro
            $this->crear();
        }
    }

    public function crear() {

        //Sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        //Insertar en la base de datos
        $query = "INSERT INTO " . static::$tabla . " ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES (' "; 
        $query .= join("', '", array_values($atributos));
        $query .= " ') ";
        
        $resultado = self::$db->query($query);
        
        //Mensaje de éxito
        if ($resultado) {
            //Redireccionar al usuario
            header("Location: /admin");
        }
    }

    public function actualizar() {
        //Sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        $valores = [];
        foreach($atributos as $key => $value) {
            $valores[] = "{$key}='{$value}'";
        }

        //Actualizar la base de datos
        $query = "UPDATE " . static::$tabla ." SET ";
        $query .= join(', ', $valores);
        $query .= "WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= "LIMIT 1 ";

        $resultado = self::$db->query($query);

        if ($resultado) {
            //Redireccionar al usuario
            header('Location: /admin');
        }
    }

    //Eliminar un registro
    public function eliminar() {
        $query = "DELETE FROM " . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
        $resultado = self::$db->query($query);

        if ($resultado) {
            $this->borrarImagen();
            header('location: /admin?resultado=3');
        }
    }

    //Funcion para iterar sobre columnasDB, identificar y unir los atributos de la DB
    public function atributos(){
        $atributos = [];
        foreach(static::$columnasDB as $columna) {
            if($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    public function sanitizarAtributos() {
        $atributos = $this->atributos();
        $sanitizado = [];
        foreach($atributos as $key => $value) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        
        return $sanitizado;
    }

    public function setImagen($imagen) {
        //Elimina la imagen previa
        if(!is_null($this->id)) {
            $this->borrarImagen();
        }
        //Asignar al atributo de imagen el nombre de la imagen
        if($imagen) {
            $this->imagen = $imagen;
        }
    }

    //Elimina el archivo
    public function borrarImagen() {
            $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
            if($existeArchivo) {
                unlink(CARPETA_IMAGENES . $this->imagen);
            }
    }

    //Validación
    public static function getErrores() {
        return self::$errores;
    }

    public function validar() {
        if(!$this->titulo) {
            self::$errores[] = "Debes añadir un titulo";
        }
    
        if(!$this->precio) {
            self::$errores[] = "El precio es obligatorio";
        }
        
        if(strlen($this->descripcion) < 50) {
            self::$errores[] = "La descripción es obligatoria y debe tener al menos 50 caracteres";
        }
        
        if(!$this->habitaciones) {
            self::$errores[] = "El número de habitaciones es obligatorio";
        }
    
        if(!$this->wc) {
            self::$errores[] = "El número de baños es obligatorio";
        }
    
        if(!$this->estacionamiento) {
            self::$errores[] = "El número de lugares de estacionamiento es obligatorio";
        }
    
        if(!$this->vendedores_id) {
            self::$errores[] = "Elige un vendedor";
        }
    
        if(!$this->imagen) {
            self::$errores[] = "La imagen es obligatoria";
        }
    
        return self::$errores;
    }

    //Lista todas las propiedades
    public static function all() {
        $query = "SELECT * FROM " . static::$tabla;
        
        //Pasa la consulta al método 
       $resultado = self::consultarSQL($query);

       return $resultado;
    }

    //Obtiene determinado numero de registros
    public static function get($cantidad) {
        $query = "SELECT * FROM " . static::$tabla . " LIMIT " . $cantidad;
        
        //Pasa la consulta al método 
       $resultado = self::consultarSQL($query);

       return $resultado;
    }

    //Busca un registro por su ID
    public static function find($id) {
        $query = "SELECT * FROM " . static::$tabla . " WHERE id = $id";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado);
    }

    public static function consultarSQL($query) {
        // Consultar la base de datos
        $resultado = self::$db->query($query);

        // Iterar los resultados
        $array = [];
        while($registro = $resultado->fetch_assoc() ) {
            $array[] = static::crearObjeto($registro);
        }
        // Liberar la memoria 
        $resultado->free();
        // Retornar los resultados
        return $array;
    }

    //Método para convertir los array en objetos
    protected static function crearObjeto($registro) {
        $objeto = new static;
        
        foreach($registro as $key => $value ) {
            if(property_exists( $objeto, $key )) {
                $objeto -> $key=$value;
            }
        }

        return $objeto;
    }

    //Sincroniza el objeto en memoria con los cambios realizados por el usuario
    public function sincronizar( $args = []) {
        foreach($args as $key => $value) {
            if(property_exists( $this, $key ) && !is_null($value)) {
                $this->$key = $value;
            }
        }
        return $this;
    }
}