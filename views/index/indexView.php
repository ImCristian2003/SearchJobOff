<body>
    <!------------------------HEADER------------------------>
    <header>
        <section class="logo">
            <h1>SearchJob</h1>
        </section>
        <nav class="logeo">
            <a href="registro.html">Crear Cuenta</a>
            <a href="login-register/login.php">Acceder</a>
        </nav>
        <section class="entrada">
            <div class="details">
                <h2>SearchJob</h2>
                <p>Estamos aquí para ayudarte a encontrar el trabajo ideal para tí <br>
                Registrate en nuestra pagina y empieza a navegar entre los tantos empleos disponibles.</p>
                <form action="buscar-empleo.php" method="post">
                    <input type="text" placeholder="Busqueda manual" name="nombre">
                    <select name="id" id="">
                        <option value="ninguno">Todos</option>
                        <?php 
                            //LLAMADA A LA FUNCION PARA MOSTRAR LOS MUNICIPIOS
                            // $resultados = conseguirMunicipios($conexion);
                            //VALIDAR QUE LA VARIABLE TENGA DATOS
                            if(!empty($resultados)):
                                //CICLO PARA IMPRIMIR LOS RESULTADOS
                                while($resultado = mysqli_fetch_assoc($resultados)):
                        ?>
                        
                            <option value="<?=$resultado['codigo'] ?>">
                                <?=$resultado['nombre']?>
                            </option>
                        
                        <?php

                                endwhile;
                            endif;

                        ?>
                    </select>
                    <input type="submit" value="Enviar">
                </form>
            </div>
        </section>
    </header>

    <hr style="width: 90%;margin:auto;">

    <!-------------------SECCION DE POR QUE NOSOTROS-------------------->
    <!-------------------PRIMERA SECCIÓN-------------------------------->

    <div class="nosotros-principal">
        <section class="nosotros1">
            <div class="nosotros1-details">
                <h2>¿Por qué buscar trabajo con nosotros?</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iure doloribus delectus rem nobis officia, ad libero tempore deleniti dolor facere natus similique ducimus accusamus laudantium enim sapiente obcaecati consectetur laborum.</p>
                <ul>
                    <li>
                        <span class="icon-checkmark"></span> 
                        Interfáz gráfica confiable e intuitiva</li>
                    <li>
                        <span class="icon-checkmark"></span>
                        Busqueda rapida y sencilla de trabajo
                    </li>
                    <li>
                        <span class="icon-checkmark"></span>
                        Registro gratuito, facil y rapido
                    </li>
                    <li>
                        <span class="icon-checkmark"></span>
                        Y muchas otras funciones disponibles
                    </li>
                </ul>
            </div>
        </section>
        <section class="nosotros2">
                <img src="assets/img/nosotros.jpg" alt="">
        </section>
    </div>

    <hr style="width: 90%;margin:auto;">
    
    <!-------------------SEGUNDA SECCIÓN-------------------------------->

    <div class="nosotros-secundaria">
        <section class="nosotros1">
            <div class="nosotros1-details">
                <h2>¿Por qué proporcionar trabajo con nosotros?</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iure doloribus delectus rem nobis officia, ad libero tempore deleniti dolor facere natus similique ducimus accusamus laudantium enim sapiente obcaecati consectetur laborum.</p>
                <ul>
                    <li>
                        <span class="icon-checkmark"></span> 
                        Interfáz gráfica confiable e intuitiva</li>
                    <li>
                        <span class="icon-checkmark"></span>
                        Busqueda rapida y sencilla de trabajo
                    </li>
                    <li>
                        <span class="icon-checkmark"></span>
                        Registro gratuito, facil y rapido
                    </li>
                    <li>
                        <span class="icon-checkmark"></span>
                        Y muchas otras funciones disponibles
                    </li>
                </ul>
            </div>
        </section>
        <section class="nosotros2">
                <img src="assets/img/nosotros1.jpg" alt="">
        </section>
    </div>

    <hr style="width: 90%;margin:auto;">

    <!----------------INTEGRANTES/DESARROLLADORES------------------------->

    <div class="equipo">
        <section class="equipo1">
            <h2>Nuestro Equipo</h2>
            <p>Creamos este equipo para facilitarte un empleo <br> en el Oriente Antioqueño</p>
        </section>
        <section class="equipo2">
            <div class="tarjeta1">
                <div class="details-tarjeta">
                    <div class="iconos">
                        <span class="icon-facebook"></span>
                        <span class="icon-instagram"></span>
                        <span class="icon-whatsapp"></span>
                        <span class="icon-google"></span>
                    </div>
                    <div class="details">
                        <h3>Cristian Cardona</h3>
                        <p>@negroamil</p>
                        <ul>
                            <li> - Programador Full Stack</li>
                            <li> - Tecnologo en ADSI</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="tarjeta2">
                <div class="details-tarjeta">
                    <div class="iconos">
                        <span class="icon-facebook"></span>
                        <span class="icon-instagram"></span>
                        <span class="icon-whatsapp"></span>
                        <span class="icon-google"></span>
                    </div>
                    <div class="details">
                        <h3>Juan José López</h3>
                        <p>@laanguilacachonda</p>
                        <ul>
                            <li> - Programador Full Stack</li>
                            <li> - Tecnologo en ADSI</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="tarjeta3">
                <div class="details-tarjeta">
                    <div class="iconos">
                        <span class="icon-facebook"></span>
                        <span class="icon-instagram"></span>
                        <span class="icon-whatsapp"></span>
                        <span class="icon-google"></span>
                    </div>
                    <div class="details">
                        <h3>Juan Esteban Alvarez</h3>
                        <p>@paraquito123</p>
                        <ul>
                            <li> - Programador Full Stack</li>
                            <li> - Tecnologo en ADSI</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <hr style="width: 90%;margin:auto;">

    <!----------------PIE DE PAGINA(PAGINA PRINCIPAL)------------------->

    <footer>
        <section class="footer1">
            <div class="footer1-det1">
                <h2>SearchJob</h2>
                <span class="icon-facebook"></span>
                <span class="icon-twitter"></span>
                <span class="icon-instagram"></span>
            </div>
            <div class="footer1-det2">
                <h3>¿Te gustó nuestra pagina?</h3>
                <a href="">¡Danos tu opinión!</a>
            </div>
        </section>
        <section class="footer2">
            <div class="footer2-det1">
                <h2>Contactanos</h2>
                <form action="">
                    <input type="text" placeholder="Nombre (s)">
                    <input type="text" placeholder="Apellidos">
                    <input type="email" placeholder="Correo electronico">
                    <textarea name="" id="" cols="30" rows="10" placeholder="Tu mensaje"></textarea>
                    <input type="submit" value="Enviar">
                </form>
            </div>
            <div class="footer2-det2">
                <p>
                    <span class="icon-phone"></span>
                    3044858665</p>
                <p>
                    <span class="icon-google"></span>
                    searchjob@gmail.com
                </p>
            </div>
        </section>
        <section class="footer3">   
            <div class="footer3-det1">
                <p><span>2022</span>Todos los derechos reservados | <b>SearchJob</b></p>
            </div>
            <div class="footer3-det2">
                <a href="">Política y Privacidad</a><span>|</span>
                <a href="">Terminos y Condiciones</a>
            </div>
        </section>
    </footer>

</body>
</html>