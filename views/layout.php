<?php 
    if(!isset($_SESSION)) {
        session_start();
    }

    $auth = $_SESSION['login'] ?? false;

    if(!isset($inicio)) {
        $inicio = false;
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Horizon States</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../build/css/app.css">
</head>

<body>

   <div class="layout"> 
        <header class="header <?php echo $inicio ? 'inicio' : ''; ?>">
            <div class="contenedor contenido-header">
                <div class="barra">
                    <a href="/">
                        <img class="logo" src="../build/img/logo.png" alt="Logotipo de bienes raíces">
                    </a>
    
                    <button class="menu-mobile" aria-label="Abrir menú de navegación" aria-expanded="false" aria-controls="navegacion"><!-- icono menú hamburguesa -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="white" class="bi bi-list"
                            viewBox="0 0 16 16" aria-hidden="true">
                            <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
                        </svg>
                    </button><!-- icono menú hamburguesa -->
    
                    <nav class="navegacion" aria-hidden="true">
                        <div class="container-closeBtn">
                            <p class="label-menu" aria-hidden="true">Menú</p>
                            <button class="close-menu" role="button" aria-label="Cerrar menú">
                                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor"
                                    class="bi bi-x" viewBox="0 0 16 16" aria-hidden="true">
                                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
                                </svg>
                            </button>
                        </div>
                        <!--- .container-closeBtn --->
    
                        <div class="navegacion-menu">
                            <div class="navegacion-enlaces">
                                <a class="enlace" href="/nosotros">Nosotros</a>
                                <a class="enlace" href="/propiedades">Anuncios</a>
                                <a class="enlace" href="/blogs">Blog</a>
                                <a class="enlace" href="/contacto">Contacto</a>
                                <?php if (!$auth): ?>
                                <a href="/login" class="login boton-salmon">Ingresar</a>
                                <?php endif; ?>
                                <?php if ($auth): ?>
                                <a class="enlace" href="/admin">Administrar</a>
                                <a class="login boton-salmon" href="/logout">Salir</a>
                                <?php endif; ?>
                            </div>
                            <div class="navegacion-dark-mode">
                                <svg class="dark-mode-boton" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-circle-half" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 0 8 1zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16"/>
                                </svg>
                                <p id="dark-mode-texto" aria-hidden="true"></p>
                            </div>
                        </div>
                        <!--- .navegacion-menu --->
                    </nav>
                    <!--- .navegacion --->
                </div>
                <!--- .barra -->
    
                <?php if ($inicio) { ?>
                <div class="texto-header">
                    <h2>¡Compra la casa de tus sueños desde la comodidad de tu hogar!</h2>
                    <h4>Tu futuro hogar comienza aquí. Descubre las mejores opciones inmobiliarias.</h4>
                    <a href="/propiedades" class="boton-header boton-salmon">Ver propiedades</a>
                </div>
                <?php } ?>
            </div>
            <!--- .contenedor contenido-header -->
        </header>
    
        <?php echo $contenido; ?>
    
        <footer class="footer seccion">
            <div class="contenedor contenedor-footer">
                <nav class="navegacion">
                    <a href="/nosotros">Nosotros</a>
                    <a href="/propiedades">Anuncios</a>
                    <a href="/blogs">Blog</a>
                    <a href="/contacto">Contacto</a>
                </nav>
            </div>
    
            <p class="copyright">Todos los derechos reservados <?php echo date('Y'); ?> &copy;</p>
        </footer>
    </div> 

    <script src="../build/js/bundle.min.js"></script>
</body>

</html>