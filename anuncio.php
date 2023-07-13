<?php
    require 'includes/funciones.php';    
    incluirTemplate('header')
?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Casa en Venta frente al bosque</h1>

        <picture>
            <source srcset="build/img/destacada.webp" type="image/webp">
            <source srcset="build/img/destacada.jpg" type="image/jpeg">
            <img loading="lazy" src="build/img/destacada.jpg" alt="destacada">
        </picture>

        <div class="resumen-propiedad">
            <p class="precio">$3.000.000</p>
            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="iconowc">
                    <p>3</p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="iconoestacionamiento">
                    <p>3</p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="iconodormitorio">
                    <p>4</p>
                </li>
            </ul>

            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo repellat fuga reiciendis vero doloribus ducimus, aliquid sunt possimus nemo quasi modi aut, omnis suscipit optio laudantium ut exercitationem facere? Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem molestias numquam quis veniam, officiis esse architecto odio eius nostrum iste assumenda iure aperiam minus suscipit laboriosam natus laborum voluptatibus possimus. ñLorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium fugiat soluta ex aperiam ullam dolor, qui ratione inventore, atque voluptas eaque at recusandae quidem eveniet laboriosam praesentium! Amet, quidem? Eos! In.</p>

            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa explicabo exercitationem iusto, molestiae repellendus soluta sit quos, voluptas magni tempore quam, nulla sapiente praesentium saepe nihil nam laboriosam incidunt. Unde. Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus veniam eligendi eius repellat provident, aspernatur blanditiis, amet, corrupti sint facere velit eum harum cum possimus est et sapiente nemo illo.</p>
        </div>
    </main>

<?php
    incluirTemplate('footer')
?>