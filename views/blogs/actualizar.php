<main class="contenedor seccion blog">
    <h1>Actualizar blog</h1>

    <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>
    
    <form class="formulario formulario-ancho"  method="POST" enctype="multipart/form-data">
        <?php include __DIR__ . '/formulario.php'; ?>
        <div class="botones">
            <a href="/admin" class="boton btn-salmon">Volver</a>
            <input type="submit" value="Guardar cambios" class="boton boton-salmon">
        </div>
    </form>
</main>