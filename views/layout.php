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
    <link rel="icon" href="build/img/icono-logo.jpg" type="image/jpg">
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
                        <img src="/build/img/barras.svg" alt="Icono menu">
                    </button><!-- icono menú hamburguesa -->
    
                    <nav class="navegacion" aria-hidden="true">
                        <div class="container-closeBtn">
                            <p class="label-menu" aria-hidden="true">Menú</p>
                            <button class="close-menu" role="button" aria-label="Cerrar menú">
                                <img src="/build/img/cerrar-menu.svg" alt="icono cerrar menu">
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