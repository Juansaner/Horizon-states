<main class="contenedor seccion login">
    <h1>Iniciar sesión</h1>

    <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>    

    <fieldset>
        <form class="formulario formulario-ancho" method="POST" action="/login">
            
                <label for="email">Correo electrónico</label>
                <input type="email" name="email" placeholder="Ingresa tu correo electrónico" id="email" >
    
                <label for="password">Contraseña</label>
                <input type="password" name="password" placeholder="Ingresa tu contraseña" id="password" >
    
            <input type="submit" value="Iniciar sesión" class="boton inicio-sesion boton-salmon">
        </form>
    </fieldset>
</main>
