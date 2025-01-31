<main class="contenedor seccion contacto formulario-ancho">
    <h1>Contacto</h1>

    <?php if($mensaje) { ?>
            <p class="alerta exito"> <?php echo $mensaje;?></p>
    <?php } ?>
    <picture>
        <source srcset="build/img/destacada3.webp" type="img/webp">
        <source srcset="build/img/destacada3.jpg" type="img/jpg">
        <img class="img-contacto" loading="lazy" src="build/img/destacada3.jpg" alt="Imagen de contacto">
    </picture>

    <h2>Llene el formulario de contacto</h2>

    <form class="formulario" action="/contacto" method="POST">
        <fieldset>
            <legend>Información personal</legend>

            <label for="nombre">Nombre</label>
            <input type="text" placeholder="Nombre" id="nombre" name="contacto[nombre]" required>

            <label for="mensaje">Mensaje</label>
            <textarea id="mensaje" name="contacto[mensaje]" required></textarea>

        </fieldset>

        <fieldset>
            <legend>Informacion sobre la propiedad</legend>

            <label for="opciones">Vende o compra</label>
            <select id="opciones" name="contacto[tipo]" required>
                <option value="" disabled selected>-- Seleccione --</option>
                <option value="Compra">Compra</option>
                <option value="Vende">Vende</option>
            </select>

            <label for="presupuesto">Precio o presupuesto</label>
            <input type="number" placeholder="Precio o presupuesto" id="presupuesto" name="contacto[precio]" required>
        </fieldset>

        <fieldset>
            <legend>Contacto</legend>

            <label>¿Cómo desea ser contactado?</label>

            <div class="forma-contacto">
                <label for="contactar-telefono">Teléfono</label>
                <input type="radio" value="telefono" id="contactar-telefono" name="contacto[contacto]" required>

                <label for="contactar-email">E-mail</label>
                <input type="radio" value="email" id="contactar-email" name="contacto[contacto]" required>
            </div>

            <div id="contacto"></div>

        </fieldset>

        <div class="contenedor-boton">
            <input type="submit" value="Enviar" class="boton-salmon-block">
        </div>
    </form>
</main>