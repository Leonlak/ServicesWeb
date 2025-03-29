<?php

require 'includes/funciones.php';
 incluirTemplate('header', $inicio = true);
 ?>

    <main class="contenedor seccion">
        <h1>    Habilidades</h1>

        <div class="iconos-nosotros">
            <div class="icono">
                <img src="build/img/icono1.1.svg" alt="Icono seguridad" loading="lazy">
                <h3>Conocimientos de programación</h3>
                <p>Importante conocimiento en lenguajes de programación como Php, JavaScript, y java así como frameworks, bases de datos y herramientas de desarrollo  </p>
            </div>
            <div class="icono">
                <img src="build/img/icono2.1.svg" alt="Icono Precio" loading="lazy">
                <h3>Trabajo en equipo y comunicación</h3>
                <p>Capacidad de colaborar efectivamente con otros desarrolladores, diseñadores y partes interesadas, así como de explicar conceptos técnicos de forma clara, es clave para garantizar el éxito en proyectos de software. </p>
            </div>
            <div class="icono">
                <img src="build/img/icono3.0.svg" alt="Icono Tiempo" loading="lazy">
                <h3>Resolucion de problemas</h3>
                <p>Analizar problemas complejos, identificar sus causas y desarrollar soluciones eficientes mediante el uso de algoritmos, estructuras de datos y herramientas tecnológicas.</p>
            </div>
        </div>
    </main>

    <section class="seccion contenedor">
        <h2>Proyectos</h2>

       <?php 
       $limite = 3;
       include 'includes/templates/anuncios.php'
       ?>

        <div class="alinear-derecha">
            <a href="anuncios.php" class="boton-verde">Ver Todas</a>
        </div>
    </section>

    <section class="imagen-contacto">
        <h2>Paradigmas de programacion </h2>
        <p>Los paradigmas de programación, como el estructurado, orientado a objetos y funcional, ofrecen enfoques diversos para resolver problemas y diseñar software</p>
        <a href="contacto.php" class="boton-amarillo">Contactános</a>
    </section>

    <div class="contenedor seccion seccion-inferior">
        <section class="blog">
            <h3>Nuestro Blog</h3>

            <article class="entrada-blog">
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/blog1.1.webp" type="image/webp">
                        <source srcset="build/img/blog1.1jpg" type="image/jpeg">
                        <img loading="lazy" src="build/img/blog1.jpg" alt="Texto Entrada Blog">
                    </picture>
                </div>

                <div class="texto-entrada">
                    <a href="entrada.php">
                        <h4>HTML 5</h4>
                        <p class="informacion-meta">Escrito el: <span>25/01/2024</span> por: <span>Leonardo</span> </p>

                        <p>
                        HTML5 es la evolución que transforma la web, dotándola de herramientas avanzadas para crear experiencias interactivas y accesibles.
                        </p>
                    </a>
                </div>
            </article>

            <article class="entrada-blog">
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/blog2.2.webp" type="image/webp">
                        <source srcset="build/img/blog2.2jpg" type="image/jpeg">
                        <img loading="lazy" src="build/img/blog2.jpg" alt="Texto Entrada Blog">
                    </picture>
                </div>

                <div class="texto-entrada">
                    <a href="entrada.php">
                        <h4>CSS3</h4>
                        <p class="informacion-meta">Escrito el: <span>25/01/2024</span> por: <span>Admin</span> </p>

                        <p>
                        CSS3 es el lenguaje que da vida y estilo a la web, permitiendo diseñar interfaces atractivas, fluidas y adaptables a cualquier dispositivo.
                        </p>
                    </a>
                </div>
            </article>
        </section>

        <section class="testimoniales">
            <h3>Testimoniales</h3>

            <div class="testimonial">
                <blockquote>
                HTML y CSS se pueden catalogar como lenguajes de marcado y estilo, respectivamente, fundamentales para la creación y presentación de contenido en la web
                </blockquote>
                <p>- Juan De la torre</p>
            </div>
        </section>
    </div>

<?php
incluirTemplate('footer'); 
 ?>

   