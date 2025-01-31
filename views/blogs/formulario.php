<fieldset>
    
    <label for="titulo">Titulo</label>

    <input type="text" id="titulo" name="blog[titulo]" placeholder="Titulo blog"
        value="<?php echo sanitizar( $blog->titulo ); ?>">



    <label for="autor">Autor</label>

    <input type="text" id="autor" name="blog[autor]" placeholder="Autor blog" value="<?php echo sanitizar($blog->autor); ?>">



    <label for="imagen">Imagen</label>

    <input type="file" id="imagen" accept="image/jpeg, image/png" name="blog[imagen]">



    <?php if($blog->imagen) { ?>

    <img src="/imagenes/<?php echo $blog->imagen ?>" class="imagen-small">

    <?php } ?>



    <label for="descripcion">Descripción</label>

    <textarea id="descripcion" name="blog[descripcion]"><?php echo sanitizar($blog->descripcion); ?></textarea>



</fieldset>