<main class="contenedor seccion contenido-centrado propiedad">
    <h1><?php echo $propiedad->titulo; ?></h1>

        <img class="img-propiedad" loading="lazy" src="../imagenes/<?php echo $propiedad->imagen; ?>" alt="Imagen de la propiedad">

    <div class="resumen-propiedad">
        <div class="propiedad-wrapper">
            <p class="precio">Precio $<?php echo $propiedad->precio; ?></p>
            <ul class="iconos-caracteristicas propiedad">
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                    <p><?php echo $propiedad->wc; ?> Baños</p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                    <p><?php echo $propiedad->estacionamiento; ?> Gar.</p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono dormitorio">
                    <p><?php echo $propiedad->habitaciones; ?> Habs.</p>
                </li>
            </ul>
        </div>

        <p class="descripcion-titulo">Descripción</p>
        <p class="descripcion"> <?php echo $propiedad->descripcion; ?> </p>

    </div>
</main>
