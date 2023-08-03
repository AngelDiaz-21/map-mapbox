<!-- <a name="volver-arriba"></a> -->
<header>
    <nav class="navbar navbar-expand-lg navbar-light text-center fw-bold">
        <div class="container-fluid">
            <div class="text-black p-2 shadow-lg rounded btn-departamentos">
                <div class="d-flex align-items-center" id="btn-departamentos">
                    <p class="btn-departamentos__p--font">Sistema de información <span class="btn-departamentos__span--font d-block">COVID-19</span></p>
                    <i class="fas fa-caret-down"></i>
                </div>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                <ul class="menu__lista navbar-nav mb-2 mb-lg-0 fs-6">
                    <li class="nav-item menu-link">
                        <a class="nav-link" href="<?php echo constant('URL');?>">Hospitales cercanos</a>
                    </li>
                    <li class="nav-item menu-link">
                        <a class="nav-link" href="<?php echo constant('URL');?>maps/showDrawRoute">Dibuja tu ruta</a>
                    </li>
                    <li class="nav-item menu-link">
                        <a class="nav-link" href="https://coronavirus.gob.mx/">Más información del COVID-19</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<?php
    include('views/templates/content-images.php');
?>