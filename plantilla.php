<?php $text = ""; ?>
<body>
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="index.html">
                            <img src="images/icon/logo-mini2.png" alt="CRUD" />
                        </a>
                        <button class="hamburger hamburger--vortex" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
                        <li>
                            <a href="inicial.php">
                                <i class="fa-solid fa-sitemap"></i>Menú Principal</a>
                        </li>
                        <li>
                            <a href="registrar_procedimientos.php">
                                <i class="fa-solid fa-clipboard-user"></i>Registro de
                                Expediente</a>
                        </li>
                        <li>
                            <a href="consulta_procedimientos.php">
                                <i class="fa-solid fa-book-open"></i></i>Consulta de
                                Expedientes en trámite</a>
                        </li>
                        <li>
                            <a href="consulta_procedimientos.php">
                                <i class="fas fa-clipboard-check"></i>Consulta de
                                Expedientes concluidos</a>
                        </li>
                        <li>
                            <a href="informes.php">
                                <i class="fas fa-tachometer-alt"></i>Informes</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- END HEADER MOBILE-->
        <!-- MENU SIDEBAR-->
        <aside class=" menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="#">
                    <img src="images/icon/logo-mini2.png" alt="CRUD Admin" />
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li>
                            <a href="inicial.php">
                                <i class="fa-solid fa-sitemap"></i>Menú Principal</a>
                        </li>
                        <?php
                        if (isset($_SESSION["tipo_usuario"])) {
                            $tipoUsuario = $_SESSION["tipo_usuario"];
                            if ($tipoUsuario == '1') {
                                echo '<li>
                                <a href="registrar_procedimientos.php">
                                    <i class="fa-solid fa-clipboard-user"></i>Registro de
                                    Expediente</a>
                            </li>
                            <li>
                                <a href="consulta_procedimientos.php">
                                    <i class="fa-solid fa-book-open"></i></i>Consulta de
                                    Expedientes en trámite</a>
                            </li>
                            <li>
                                <a href="consulta_procedimientos_con.php">
                                    <i class="fas fa-clipboard-check"></i>Consulta de
                                    Expedientes concluidos</a>
                            </li>
                            <li>
                                <a href="informes.php">
                                    <i class="fas fa-tachometer-alt"></i>Informes</a>
                            </li>
                            <li>
                                <a href="graficas_manuales.php">
                                    <i class="fa-solid fa-chart-simple"></i>Gráficos Manuales</a>
                            </li>
                            <li>
                                <a href="consultas.php">
                                    <i class="fa-solid fa-magnifying-glass-arrow-right"></i></i>Consultas</a>
                            </li>
                            <li>
                                <a href="resumen.php">
                                    <i class="fas fa-marker"></i>Reporte Accessos</a>
                            </li>
                            <li>
                                <a href="repositorio.php">
                                    <i class="fa-solid fa-box-archive"></i></i>Repositorio</a>
                            </li>
                            <li>
                                <a href="registro.php">
                                    <i class="fas fa-poll-h"></i></i>Logs</a>
                            </li>
                            </ul>';
                            } else if ($tipoUsuario == '2') {
                                echo '<li>
                                <a href="registrar_procedimientos.php">
                                    <i class="fa-solid fa-clipboard-user"></i>Registro de
                                    Expediente</a>
                            </li>
                            <li>
                                <a href="consulta_procedimientos.php">
                                    <i class="fa-solid fa-book-open"></i></i>Consulta de
                                    Expedientes en trámite</a>
                            </li>
                            <li>
                                <a href="consulta_procedimientos_con.php">
                                    <i class="fas fa-clipboard-check"></i>Consulta de
                                    Expedientes concluidos</a>
                            </li>
                            <li>
                                <a href="informes.php">
                                    <i class="fas fa-tachometer-alt"></i>Informes</a>
                            <li>
                                <a href="resumen.php">
                                    <i class="fas fa-marker"></i>Reporte Accessos</a>
                            </li>
                            <li>
                                <a href="usuarios.php">
                                    <i class="fa-solid fa-user-plus"></i>Usuarios</a>
                            </li>
                            <li>
                                <a href="graficas_manuales.php">
                                    <i class="fa-solid fa-chart-simple"></i>Gráficos Manuales</a>
                            </li>
                            <li>
                                <a href="consultas.php">
                                    <i class="fa-solid fa-magnifying-glass-arrow-right"></i></i>Consultas</a>
                            </li>
                            <li>
                                <a href="repositorio.php">
                                    <i class="fa-solid fa-box-archive"></i></i>Repositorio</a>
                            </li>
                            <li>
                                <a href="https://172-17-232-199.cjefpres.direct.quickconnect.to:5001/oo/r/yDHxCphxR46CbZbvIEhP1xVo9wLbrSuK">
                                    <i class="fa-solid fa-file-circle-exclamation"></i></i>Database CJEF-Matriz 2024</a>
                            </li>
                            </ul>';
                            } else if ($tipoUsuario == '3') {
                                echo '<li>
                                <a href="registrar_procedimientos.php">
                                    <i class="fa-solid fa-clipboard-user"></i>Registro de
                                    Expediente</a>
                            </li>
                            <li>
                                <a href="consulta_procedimientos.php">
                                    <i class="fa-solid fa-book-open"></i></i>Consulta de
                                    Expedientes en trámite</a>
                            </li>
                            <li>
                                <a href="consulta_procedimientos_con.php">
                                    <i class="fas fa-clipboard-check"></i>Consulta de
                                    Expedientes concluidos</a>
                            </li>
                            </ul>';
                            } else if ($tipoUsuario == '4') {
                                echo '
                            <li>
                                <a href="consulta_procedimientos.php">
                                    <i class="fa-solid fa-book-open"></i></i>Consulta de
                                    Expedientes en trámite</a>
                            </li>
                            <li>
                                <a href="consulta_procedimientos_con.php">
                                    <i class="fas fa-clipboard-check"></i>Consulta de
                                    Expedientes concluidos</a>
                            </li>
                            </ul>';
                            } else {

                                echo 'NO TIENES ACCESO';
                            }
                        } else {
                            // Si no hay tipo de usuario definido en la sesión
                            echo '<li>No se ha iniciado sesión</li>';
                        }
                        echo '
                        <ul class="list-unstyled navbar__list">
                            <!--<li>
                                <a href="consulta_procedimientos_historico.php">
                                    <i class="fas fa-clipboard-check"></i>Consulta de
                                    Expedientes Histórico</a>
                            </li> -->
                            <li>
                                <a href="archivo.php">
                                    <i class="fas fa-save"></i>Archivo</a>
                            </li>
                            <li>
                                <a href="cambio_contra.php">
                                    <i class="fa-solid fa-fingerprint"></i></i>Cambiar contraseña</a>
                            </li>
                            <li>
                                <a href="ManualControversias.pdf">
                                    <i class="fa-solid fa-book-open"></i></i>Manual de Operación</a>
                            </li>
                            <li>
                                <a href="cerrar_sesion.php">
                                    <i class="fas fa-taxi"></i>Salir</a>
                            </li>
                        </ul>';
                        ?>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <form class="form-header" action="" method="POST">

                            </form>
                            <div class="header-button">
                                <div class="noti-wrap">
                                </div>
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="image d-flex align-items-center">
                                            <?php
                                            $text = "";
                                            switch ($_SESSION["iniciales"]) {
                                                case "gsimon":
                                                    $text = "458.jpg";
                                                    break;
                                                case "dcruz":
                                                    $text = "884.jpg";
                                                    break;
                                                case "mgavina":
                                                    $text = "865.jpg";
                                                    break;
                                                case "esandoval":
                                                    $text = "904.jpg";
                                                    break;
                                                case "mocampo":
                                                    $text = "95.jpg";
                                                    break;
                                                case "mgabina":
                                                    $text = "859.jpg";
                                                    break;
                                                case "obautista":
                                                    $text = "769.jpg";
                                                    break;
                                                case "walburo":
                                                    $text = "682.jpg";
                                                    break;
                                                case "mfernanda":
                                                    $text = "c5mewbe17dc80s0gsc.jpg";
                                                    break;
                                                case "mmunoz":
                                                    $text = "963.jpg";
                                                    break;
                                                case "mvazquez":
                                                    $text = "ct09bl7wsbcc8ggk8g.jpg";
                                                    break;
                                                case "arosas":
                                                    $text = "d8nqtd13yc8ckk484.jpg";
                                                    break;
                                                case "anavarro":
                                                    $text = "945.jpg";
                                                    break;
                                                case "aperez":
                                                    $text = "877.jpg";
                                                    break;
                                            }
                                            $url = 'http://172.17.232.110/directorio/images/' . $text;
                                            echo '<img src="' . $url . '" class="img-circle profile_img">';
                                            ?>
                                        </div>
                                        <div class="content">
                                            <?php
                                            echo '<span style="font-size: 16px; color: #bc955c;">Bienvenid@,</span>';
                                            ?>
                                            <h2 style="font-size: 16px;">
                                                <?php
                                                if ($_SESSION["nombre"]) {
                                                    echo $_SESSION["nombre"];
                                                } else {
                                                    echo "¿Tienes Permiso?";
                                                }
                                                ?>
                                            </h2>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image">
                                                    <a href="#">
                                                        <img img src="images/icon/user.png" class="img-circle profile_img">
                                                    </a>
                                                </div>
                                                <div class="content">
                                                    <h5 class="name">
                                                        <h2 style="font-size: 16px;">
                                                            <?php echo $_SESSION["nombre"]; ?>
                                                        </h2>
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__footer">
                                                <a href="cambio_contra.php">
                                                    <i class="fas fa-unlock-alt"></i>Cambiar Contraseña</a>
                                                <a href="cerrar_sesion.php">
                                                    <i class="zmdi zmdi-power"></i>Salir</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->
</body>

</html>