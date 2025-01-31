<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use Model\Blog;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController {
    public static function index( Router $router ) {
        
        $propiedades = Propiedad::get(3);
        $inicio = true;

        $router->render('paginas/index', [
            'propiedades' => $propiedades,
            'inicio' => $inicio
        ]);
    }

    public static function nosotros( Router $router) {
        
        $router->render('paginas/nosotros');
    }

    public static function propiedades( Router $router) {
       
        $propiedades = Propiedad::all();

        $router->render('paginas/propiedades', [
            'propiedades' => $propiedades
        ]);
    }

    public static function propiedad( Router $router ) {
        
        $id = validarORedireccionar('/propiedades');

        //Busca la propiedad por el id
        $propiedad = Propiedad::find($id);

        $router->render('paginas/propiedad', [
            'propiedad' => $propiedad
        ]);
    }

    public static function blogs( Router $router ) {
        $blogs = Blog::all();

        $router->render('paginas/blogs', [
            'blogs' => $blogs
        ]);
    }

    public static function entrada( Router $router ) {
        
        $id = validarORedireccionar('/blogs');

        $blog = Blog::find($id);
        
        $router->render('paginas/entrada', [
            'blog' => $blog
        ]);
    }

    public static function contacto( Router $router ) {
        
        $mensaje = null;

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            $respuestas = $_POST['contacto'];

            //Crear una nueva instancia de PHPMailer
            $mail = new PHPMailer();

            //Configurar SMTP
            $mail->isSMTP();
            $mail->Host = 'sandbox.smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Username = 'aa752136ef7fd4';
            $mail->Password = '56b97a59d72502';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 2525;

            //Configurar el contenido del mail
            $mail->setFrom('admin@bienesraices.com'); //Correo remitente
            $mail->addAddress('admin@bienesraices.com', 'BienesRaices');
            $mail->Subject = 'Tienes un nuevo mensaje';

            //Habilitar HTML
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';

            //Definir contenido
            $contenido = '<html>';
            $contenido .= '<p>Nombre: '. $respuestas['nombre'] .'</p>';

            // Enviar de fomra condicional algunos campos de teléfono o email
            if($respuestas['contacto'] === 'telefono') {
                $contenido .= '<p>Eligió se contactado por teléfono: '.  $respuestas['telefono'] . '</p>';
                $contenido .= '<p>Fecha: '. $respuestas['fecha'] .'</p>';
                $contenido .= '<p>Hora: '. $respuestas['hora'] .'</p>';
            } else {
                //Es email, entonces se agrega el campo de email
                $contenido .= '<p>Eligió ser contactado por E-Mail: '. $respuestas['correo'] .'</p>';
            }

            $contenido .= '<p>Asunto: ' . $respuestas['tipo'] . '</p>';

            if($respuestas['tipo'] === 'Compra') {
                $contenido .= '<p>Presupuesto: $' . $respuestas['precio'] . '</p>';
            } else {
                $contenido .= '<p>Precio: $' . $respuestas['precio'] . '</p>';
            }

            $contenido .= '<p>Mensaje: ' . $respuestas['mensaje'] . '</p>';
            $contenido .= '</html>';

            $mail->Body = $contenido;
            $mail->Altbody = 'Esto es texto alternativo sin HTML';

            if($mail->send()) {

                $mensaje = "Mensaje enviado correctamente";
            } else {
                $mensaje = "El mensaje no se pudo enviar";
            }
        }

        $router->render('paginas/contacto', [
            'mensaje' => $mensaje
        ]);
    }
}