<main class="contenedor seccion propiedad">
    <h1>Actualizar propiedad</h1>

    <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    
    <form class="formulario formulario-ancho"  method="POST" enctype="multipart/form-data">
        <?php include __DIR__ . '/formulario.php'; ?>

        <div class="botones">
            <a href="/admin" class="boton btn-salmon">Volver</a>
            <input type="submit" value="Actualizar propiedad" class="boton boton-salmon">
        </div>
    </form>
</main>