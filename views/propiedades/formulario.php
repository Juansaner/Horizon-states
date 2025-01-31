<fieldset>
    <label for="titulo">Título</label>
    <input type="text" id="titulo" name="propiedad[titulo]" placeholder="Título propiedad"
        value="<?php echo sanitizar($propiedad->titulo); ?>">

    <label for="precio">Precio</label>
    <input type="number" id="precio" name="propiedad[precio]" placeholder="Precio propiedad"
        value="<?php echo sanitizar($propiedad->precio); ?>">

    <label for="imagen">Imagen</label>
    <input type="file" id="imagen" accept="image/jpeg, image/png" name="propiedad[imagen]">

    <?php if($propiedad->imagen): ?>
    <img src="/imagenes/<?php echo $propiedad->imagen ?>" class="imagen-small">
    <?php endif; ?>
    <label for="descripcion">Descripción</label>
    <textarea id="descripcion"
        name="propiedad[descripcion]"><?php echo sanitizar($propiedad->descripcion); ?></textarea>
</fieldset>

<fieldset>
    <div class="campo-grid">
        <div class="campo">
            <label for="habitaciones">Habitaciones</label>
            <input type="number" id="habitaciones" name="propiedad[habitaciones]" placeholder="Ej: 3" min="1" max="9" value="<?php echo sanitizar($propiedad->habitaciones); ?>">
        </div>

        <div class="campo">
            <label for="wc">Baños</label>
            <input type="number" id="wc" name="propiedad[wc]" placeholder="Ej: 3" min="1" max="9" value="<?php echo sanitizar($propiedad->wc); ?>">
        </div>

        <div class="campo">
            <label for="estacionamiento">Estacionamiento</label>
            <input type="number" id="estacionamiento" name="propiedad[estacionamiento]" placeholder="Ej: 3" min="1" max="9" value="<?php echo sanitizar($propiedad->estacionamiento); ?>">
        </div>
    </div> <!-- .campo-grid -->
</fieldset>

<fieldset>
    <label for="vendedor">Vendedor</label>
    <select name="propiedad[vendedores_id]" id="vededor">
        <option selected value="">-- Seleccione --</option>
        <?php foreach($vendedores as $vendedor ) { ?>
        <option <?php echo $propiedad->vendedores_id === $vendedor->id ? 'selected' : ''; ?>
            value="<?php echo sanitizar($vendedor->id); ?>">
            <?php echo sanitizar($vendedor->nombre). " " . sanitizar($vendedor->apellido); ?></option>
        <?php } ?>
    </select>
</fieldset>