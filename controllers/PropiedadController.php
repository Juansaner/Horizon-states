<?php

namespace Controllers;
use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Model\Blog;
use Intervention\Image\ImageManagerStatic as Image;

class PropiedadController {
    public static function index(Router $router) {

        //Trae todos los registros
        $propiedades = Propiedad::all();
        $vendedores = Vendedor::all();
        $blogs = Blog::all();

        //Muestra mensaje condicional
        $resultado = $_GET['resultado'] ?? null;
        
        //Vista
        $router->render("propiedades/admin", [
            'propiedades' => $propiedades,
            'resultado' => $resultado,
            'vendedores' => $vendedores,
            'blogs' => $blogs
        ]);
    }

    public static function crear(Router $router) {
        
        $propiedad = new Propiedad;

        //Consulta para obtener todos los vendedores
        $vendedores = Vendedor::all();

        //Arreglo con mensaje de errores
        $errores = Propiedad::getErrores();

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
             /** CREA UNA NUEVA INSTANCIA */
            $propiedad = new Propiedad($_POST['propiedad']);

            /**SUBIDA DE ARCHIVOS **/
   
            //Generar nombre imagen
            $nombreImagen = md5(uniqid(rand(), true)). ".jpg";

            //Setear la imagen
            //Realiza un resize a la imagen con intervention
            if($_FILES['propiedad']['tmp_name']['imagen']) {
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
                $propiedad->setImagen($nombreImagen);
            }
   
            //Validar
            $errores = $propiedad->validar();

            //Revisar que el array de errores esté vacío
            if(empty($errores)) {
      
                //Crear la carpeta para subir imagenes
                if(!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES);
                }
       
                //Guarda la imagen en el servidor
                $image->save(CARPETA_IMAGENES . $nombreImagen);

                //Guarda en la base de datos
                $propiedad->guardar(); 
            }
        }

        $router->render("propiedades/crear", [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores
            ]);
    }

    public static function actualizar(Router $router) {
        
        $id = validarORedireccionar('/admin');

        $propiedad = Propiedad::find($id);

        $vendedores = Vendedor::all();

        $errores = Propiedad::getErrores();

        //Método POST para actualizar
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            //Asignar los atributos
            $args = $_POST['propiedad'];
            
            //Sincroniza con active record
            $propiedad->sincronizar($args);
            
            //Validación
            $errores = $propiedad->validar();
        
            //Generar nombre imagen
            $nombreImagen = md5(uniqid(rand(), true)). ".jpg";
            //Subida de archivos
            if($_FILES['propiedad']['tmp_name']['imagen']) {
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
                $propiedad->setImagen($nombreImagen);
            }
        
            //Revisar que el array de errores esté vacío
            if (empty($errores)) {
                if($_FILES['propiedad']['tmp_name']['imagen']) {
                //Almacenar la imagen
                $image->save(CARPETA_IMAGENES . $nombreImagen);
                }
                
                //Almacena la propiedad
                $propiedad->guardar();
            }
        }

        $router->render('propiedades/actualizar', [
            'propiedad' => $propiedad,
            'errores' => $errores,
            'vendedores' => $vendedores
        ]);
    }

    public static function eliminar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            //Validar id
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);
            
            if($id) {
                $tipo = $_POST['tipo'];
                if(validarTipoContenido($tipo)){
                    $propiedad = Propiedad::find($id);
                    $propiedad->eliminar();
                }
            }
        }
    
    }
}

    