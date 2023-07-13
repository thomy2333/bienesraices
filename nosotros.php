<?php
    require 'includes/funciones.php';    
    incluirTemplate('header')
?>
    <main class="contenedor seccion">
        <h1>Conoce sobre Nosotros</h1>

        <div class="contenido-nosotros">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/nosotros.webp" type="image/webp">
                    <source srcset="build/img/nosotros.jpg" type="image/jpeg">
                    <img loading="lazy" src="build/img/nosotros.jpg" alt="sobre nosotros">
                </picture>
            </div>  

            <div class="texto-nosotros">
                <blockquote>
                    25 Años de experiencia
                </blockquote>

                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nobis dolores optio aspernatur velit doloremque, deserunt voluptatibus voluptatum magnam perspiciatis totam nostrum sunt fugit at suscipit aut Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium natus tempore reprehenderit, ex, eligendi at, soluta eveniet iure cupiditate ipsum officiis amet expedita aperiam dolorem. Illo debitis consequuntur nihil tempora? Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet doloremque quibusdam libero quod consectetur optio ipsa rem explicabo vel quaerat, aperiam minima in, similique consequuntur. Magnam in modi vel expedita? Lorem ipsum dolor sit .
                </p>

                <p>
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptatum excepturi architecto, doloremque esse repudiandae est impedit ratione alias nobis tenetur veniam vero expedita fugiat quisquam asperiores deleniti perferendis at quam. Lorem ipsum dolor, sit amet consectetur adipisicing elit. Doloribus delectus ipsum voluptas molestias dolor, deserunt possimus repudiandae atque perferendis sapiente quibusdam, est dolorum fugit obcaecati debitis ipsam asperiores, aspernatur exercitationem!
                </p>
            </div>
        </div>
    </main>

    <section class="contenedor seccion">
        <h1>Más Sobre Nosotros</h1>

        <div class="iconos-nosotros">
            <div class="icono">
                <img src="build/img/icono1.svg" alt="icono1" loading="lazy">
                <h3>Seguridad</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad inventore culpa deserunt dignissimos sint autem, molestiae totam reprehenderit corporis nemo minus repellendus qui officia provident maiores aut ipsam fuga ipsa.</p>
            </div>
            <div class="icono">
                <img src="build/img/icono2.svg" alt="icono2" loading="lazy">
                <h3>Precio</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad inventore culpa deserunt dignissimos sint autem, molestiae totam reprehenderit corporis nemo minus repellendus qui officia provident maiores aut ipsam fuga ipsa.</p>
            </div>
            <div class="icono">
                <img src="build/img/icono3.svg" alt="icono3" loading="lazy">
                <h3>A Tiempo</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad inventore culpa deserunt dignissimos sint autem, molestiae totam reprehenderit corporis nemo minus repellendus qui officia provident maiores aut ipsam fuga ipsa.</p>
            </div>
        </div>
    </section>

<?php
    incluirTemplate('footer')
?>