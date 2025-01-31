<main class="contenedor seccion blog">
    <h1>Crear blog</h1>

    <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    
    <form class="formulario formulario-ancho"  method="POST" enctype="multipart/form-data">
        <?php include __DIR__ . '/formulario.php'; ?>

        <div class="botones">
            <a href="/blogs" class="boton btn-salmon">Volver</a>
            <input type="submit" value="Crear blog" class="boton boton-salmon">
        </div>
    </form>
</main>