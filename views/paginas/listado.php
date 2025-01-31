<div class="contenedor-anuncios">
    <?php foreach($propiedades as $propiedad) { ?>
    <div class="anuncio">

        <img class="img-anuncio" loading="lazy" src="/imagenes/<?php echo $propiedad->imagen; ?>" alt="anuncio">

        <div class="anuncio-wrapper">
            <div class="contenido-anuncio">
                <h3><?php echo $propiedad->titulo; ?></h3>
                <p class="descripcion-anuncio">
                    <?php echo strlen($propiedad->descripcion) > 70 ? substr($propiedad->descripcion, 0, 70) . '...' : $propiedad->descripcion; ?>
                </p>
                <p class="precio"><?php $propiedad->precio; ?></p>

                <ul class="iconos-caracteristicas">
                    <li>
                        <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                        <p><?php echo $propiedad->wc; ?></p>
                    </li>
                    <li>
                        <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg"
                            alt="icono estacionamiento">
                        <p><?php echo $propiedad->estacionamiento; ?></p>
                    </li>
                    <li>
                        <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono dormitorio">
                        <p><?php echo $propiedad->habitaciones; ?></p>
                    </li>
                </ul>
            </div><!--.contenido-anuncio-->
            <div class="boton-anuncio">
                <a href="/propiedad?id=<?php echo $propiedad->id; ?>" class="boton-salmon-block">
                    Ver propiedad
                </a>
            </div> <!-- .boton-anuncio -->
        </div><!-- .anuncio-wrapper -->
    </div><!--anuncio-->
    <?php } ?>
</div>
<!--.contenedor-anuncios-->