<main class="contenedor seccion vendedor">
    <h1>Crear vendedor</h1>

    <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    
    
    <form class="formulario formulario-ancho"  method="POST" action="/vendedores/crear">
        <?php include __DIR__ . '/formulario.php'; ?>

        <div class="botones">
            <a href="/admin" class="boton btn-salmon">Volver</a>
            <input type="submit" value="Crear vendedor" class="boton boton-salmon-block">
        </div>
    </form>
</main>