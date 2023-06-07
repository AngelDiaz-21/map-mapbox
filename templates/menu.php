<header>
            <nav class="menu" id="menu">
                <div class="contenedor contenedor-botones-menu">
                    <button id="btn-menu-barras" class="btn-menu-barras"><i class="fas fa-bars"></i></button>
                    <button id="btn-menu-cerrar" class="btn-menu-cerrar"><i class="fas fa-times"></i></button>
                </div>
                <div class="contenedor contenedor-enlaces-nav">
                    <div class="btn-departamentos" id="btn-departamentos">
                        <p>Sistema de información <span>COVID-19</span></p>
                        <i class="fas fa-caret-down"></i>
                    </div>

                    <div class="enlaces">
                        <a href="index.php">Hospitales cercanos</a>
                        <a href="inicio.php">Conoce tu ruta</a>
                        <a href="https://coronavirus.gob.mx/" target="_blank">Más información del COVID-19</a>
                        <!-- <input id="btn-abrir-popup" type="submit" class="main-header__link" value="Iniciar sesion"> -->
                        <a href="inicia-sesion.php">Iniciar sesión</a>
                    </div>
                </div>
                <?php
                    include('templates/contenido-imagenes.php');
                ?>
            </nav>
        </header>