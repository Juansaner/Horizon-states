<?php

namespace Controllers;

use MVC\Router;
use Model\Blog;
use Intervention\Image\ImageManagerStatic as Image;

class BlogController {
    
    public static function crear(Router $router) {

        $blog = new Blog;

        //Arreglo con mensaje de errores
        $errores = Blog::getErrores();

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            /** CREA UNA NUEVA INSTANCIA */
            $blog = new Blog($_POST['blog']);

            /**SUBIDA DE ARCHIVOS **/
   
            //Generar nombre imagen
            $nombreImagen = md5(uniqid(rand(), true)). ".jpg";

            //Setear la imagen
            //Realiza un resize a la imagen con intervention
            if($_FILES['blog']['tmp_name']['imagen']) {
                $image = Image::make($_FILES['blog']['tmp_name']['imagen'])->fit(800, 600);
                $blog->setImagen($nombreImagen);
            }

            //Validar
            $errores = $blog->validar();

            //Revisar que el array de errores esté vacío
            if(empty($errores)) {
      
                //Crear la carpeta para subir imagenes
                if(!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES);
                }
       
                //Guarda la imagen en el servidor
                $image->save(CARPETA_IMAGENES . $nombreImagen);

                //Guarda en la base de datos
                $blog->guardar(); 
            }
        }

        $router->render('blogs/crear', [
            'blog' => $blog,
            'errores' => $errores
        ]);
    }

    public static function actualizar( Router $router ) {
        
        $id = validarORedireccionar('/blog');

        $blog = Blog::find($id);

        //Arreglo con mensaje de errores
        $errores = Blog::getErrores();

         //Método POST para actualizar
         if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            //Asignar los atributos
            $args = $_POST['blog'];
            
            //Sincroniza con active record
            $blog->sincronizar($args);
            
            //Validación
            $errores = $blog->validar();
        
            //Generar nombre imagen
            $nombreImagen = md5(uniqid(rand(), true)). ".jpg";
            //Subida de archivos
            if($_FILES['blog']['tmp_name']['imagen']) {
                $image = Image::make($_FILES['blog']['tmp_name']['imagen'])->fit(800, 600);
                $blog->setImagen($nombreImagen);
            }
        
            //Revisar que el array de errores esté vacío
            if (empty($errores)) {
                if($_FILES['blog']['tmp_name']['imagen']) {
                //Almacenar la imagen
                $image->save(CARPETA_IMAGENES . $nombreImagen);
                }
                
                //Almacena la propiedad
                $blog->guardar();
            }
        }

        $router->render('blogs/actualizar', [
            'blog' => $blog,
            'errores' => $errores
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
                    $blog = Propiedad::find($id);
                    $resultado = $blog->eliminar();

                    // Redireccionar
                    if($resultado) {
                        header('location: /admin?resultado=3');
                    }
                }
            }
        }
    }
}