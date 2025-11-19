<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="index.php" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="assets/images/logo-alternativo.png" alt="" height="30">
                    </span>
                    <span class="logo-lg">
                        <img src="assets/images/logo-alternativo.png" alt="" height="50"> <span class="logo-txt">Intranet</span>
                    </span>
                </a>

                <a href="index.php" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="assets/images/logo-alternativo.png" alt="" height="24">
                    </span>
                    <span class="logo-lg">
                        <img src="assets/images/logo-alternativo.png" alt="" height="24"> <span class="logo-txt">Intranet</span>
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-16 header-item" id="vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>


        </div>

        <div class="d-flex">

            <div class="dropdown d-inline-block d-lg-none ms-2">
                <button type="button" class="btn header-item" id="page-header-search-dropdown"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i data-feather="search" class="icon-lg"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                    aria-labelledby="page-header-search-dropdown">
        
                    <form class="p-3">
                        <div class="form-group m-0">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="<?php echo $language["Search"]; ?>" aria-label="Search Result">

                                <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- NOTIFICACIONES O MENSAJES INTERNOS -->

            <div class="d-inline-block">
                <button type="button" class="btn header-item noti-icon position-relative"  aria-haspopup="true" aria-expanded="false" onclick="location.href='apps-email-inbox.php'">
                    <i data-feather="bell" class="icon-lg"></i>
                    <?php
                    // Consulta SQL
                    $sql = "SELECT COUNT(*) AS cantidad_mensajes_sin_leer FROM message WHERE status_Message = 0 AND to_Message = $id_user";
                    $resultado = mysqli_query($link, $sql);
                        // Obtención del resultado
                        if ($fila = mysqli_fetch_array($resultado)) {
                            $cantidad_mensajes_sin_leer = $fila['cantidad_mensajes_sin_leer'];
                        } else {
                            $cantidad_mensajes_sin_leer = 0;
                        }
                    {
                    ?>
<!--                    <span class="badge bg-danger rounded-pill">5</span>-->
                        <span class="badge bg-danger rounded-pill"><?php echo "$cantidad_mensajes_sin_leer"; ?></span>
                    <?php
                    }
                    ?>

                </button>
            </div>

            <!-- BANDERAS DE IDIOMA -->

            <div class="dropdown d-none d-sm-inline-block">
                <button type="button" class="btn header-item waves-effect" data-bs-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <?php if ($lang == 'en') { ?>
                        <img class="me-2" src="assets/images/flags/us.jpg" alt="Header Language" height="16"> 
                    <?php } ?>
                    <?php if ($lang == 'es') { ?>
                        <img class="me-2" src="assets/images/flags/spain.jpg" alt="Header Language" height="16"> 
                    <?php } ?>

                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <a href="?lang=es" class="dropdown-item notify-item language">
                        <img src="assets/images/flags/spain.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle"> Spanish </span>
                    </a>
                    <!-- item-->
                    <a href="?lang=en" class="dropdown-item notify-item language">
                        <img src="assets/images/flags/us.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle"> English </span>
                    </a>

                </div>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item topbar-light bg-light-subtle border-start border-end" id="page-header-user-dropdown"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">


                    <img class="rounded-circle header-profile-user" src="uploads/usuarios/<?php echo $_SESSION['image']; ?>"
                        alt="Header Avatar">
                    <span class="d-none d-xl-inline-block ms-1 fw-medium">Q:.H:. <?php echo $_SESSION['name']; ?> <?php echo $_SESSION['lastname']; ?></span>

                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>

                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <a class="dropdown-item" href="apps-contacts-profile.php"><i class="mdi mdi-face-man font-size-16 align-middle me-1"></i> <?php echo $language["Profile"]; ?></a>

                    <a class="dropdown-item" href="" data-key="t-recover-password"  data-bs-toggle="modal" data-bs-target="#change-password"><i class='bx bx-reset font-size-16 align-middle me-1'></i><?php echo $language["Recover_Password"]; ?></a>

                    <a class="dropdown-item" href="auth-lock-screen.php"><i class="mdi mdi-lock font-size-16 align-middle me-1"></i> <?php echo $language["Lock_screen"]; ?> </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="logout.php"><i class="mdi mdi-logout font-size-16 align-middle me-1"></i> <?php echo $language["Logout"]; ?></a>
                </div>
            </div>

        </div>
    </div>
</header>

<!-- ========== Left Sidebar Start ========== -->
<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" data-key="t-menu"><?php echo $language["Menu"]; ?></li>

                <li>
                    <a href="index.php">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard"><?php echo $language["Dashboard"]; ?></span>
                    </a>
                </li>
                <li>
                    <a href="apps-documentos-list.php">
                        <i class="bx bx-folder-open"></i>
                        <span data-key=""><?php echo $language["Documentos_Generales"]; ?></span>
                    </a>
                </li>


                <?php
                if ($_SESSION['oficialidad'] == 7 || $_SESSION['username'] == '270396356' ) {
                ?>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="bx bx-dollar"></i>
                        <span data-key=""><?php echo $language["Tesoreria"]; ?></span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="apps-tesoreria-entrada.php"><?php echo $language["Tesoreria_Entrada"]; ?></a></li>
                        <li><a href="apps-tesoreria-salida.php"><?php echo $language["Tesoreria_Salida"]; ?></a></li>
                        <li><a href="apps-tesoreria-informe.php"><?php echo $language["Generar_Informe"]; ?></a></li>
                    </ul>
                </li>
                    <?php
                }
                ?>


                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="bx bx-news"></i>
                        <span data-key="t-news"><?php echo $language["News"]; ?></span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="apps-news-list.php" data-key="t-news-list"><?php echo $language["News_List"]; ?></a></li>
                        <li><a href="apps-news-new.php" data-key="t-news-new"><?php echo $language["News_New"]; ?></a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class='bx bx-calendar'></i>
                        <span data-key="t-news"><?php echo $language["Calendar"]; ?></span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="apps-evento-list.php" data-key="t-news-list"><?php echo $language["Calendar_List"]; ?></a></li>
                        <?php
                        if ($_SESSION['category'] == 2 || $_SESSION['category'] == 1) {
                            ?>
                            <li><a href="apps-evento-new.php" data-key="t-news-new"><?php echo $language["Calendar_New"]; ?></a></li>
                            <?php
                        }
                        ?>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="users"></i>
                        <span data-key="t-authentication"><?php echo $language["Authentication"]; ?></span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="apps-contacts-list.php" data-key="t-user-list"><?php echo $language["User_List"]; ?></a></li>
                        <?php
                        if ($_SESSION['category'] == 2 || $_SESSION['category'] == 1) {
                        ?>
                        <li><a href="apps-contacts-register.php" data-key="t-register"><?php echo $language["Register"]; ?></a></li>
                            <?php
                        }
                        ?>

                    </ul>
                </li>

                <li class="menu-title mt-2" data-key="t-components"><?php echo $language["Elements"]; ?></li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow iconos-menu">
                        <i class='bx bx-dice-3'></i>
                        <span data-key="t-aprendiz"><?php echo $language["Aprendiz"]; ?></span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="apps-aprendiz-trazados.php" data-key="t-aprendiz"><?php echo $language["Aprendiz_Trazados"]; ?></a></li>
                        <li><a href="apps-aprendiz-actas.php" data-key="t-aprendiz"><?php echo $language["Aprendiz_Actas"]; ?></a></li>
                        <li><a href="apps-aprendiz-biblioteca.php" data-key="t-aprendiz"><?php echo $language["Aprendiz_Biblioteca"]; ?></a></li>
                        <li><a href="apps-aprendiz-boletin.php" data-key="t-aprendiz"><?php echo $language["Aprendiz_Boletin"]; ?></a></li>

                    </ul>
                </li>

                <?php
                if ($_SESSION['grado'] == 3 || $_SESSION['username'] == '270396356' || $_SESSION['grado'] == 2 ) {
                ?>

                <li>
                    <a href="javascript: void(0);" class="has-arrow iconos-menu">
                        <i class='bx bx-dice-5' ></i>
                        <span data-key="t-aprendiz"><?php echo $language["Companeros"]; ?></span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="apps-companero-trazados.php" data-key="t-aprendiz"><?php echo $language["Companeros_Trazados"]; ?></a></li>
                        <li><a href="apps-companero-actas.php" data-key="t-aprendiz"><?php echo $language["Companeros_Actas"]; ?></a></li>
                        <li><a href="apps-companero-biblioteca.php" data-key="t-aprendiz"><?php echo $language["Companeros_Biblioteca"]; ?></a></li>
                        <li><a href="apps-companero-boletin.php" data-key="t-aprendiz"><?php echo $language["Companeros_Boletin"]; ?></a></li>
                    </ul>
                </li>
                <?php
                }
                ?>

                <?php
                if ($_SESSION['grado'] == 3 || $_SESSION['username'] == '270396356' ) {
                ?>

                <li>
                    <a href="javascript: void(0);" class="has-arrow iconos-menu">
                        <i class='bx bx-sun'></i>
                        <span data-key="t-aprendiz"><?php echo $language["Maestros"]; ?></span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="apps-maestro-trazados.php" data-key="t-aprendiz"><?php echo $language["Maestros_Trazados"]; ?></a></li>
                        <li><a href="apps-maestro-actas.php" data-key="t-aprendiz"><?php echo $language["Maestros_Actas"]; ?></a></li>
                        <li><a href="apps-maestro-biblioteca.php" data-key="t-aprendiz"><?php echo $language["Maestros_Biblioteca"]; ?></a></li>
                        <li><a href="apps-maestro-boletin.php" data-key="t-aprendiz"><?php echo $language["Maestros_Boletin"]; ?></a></li>
                    </ul>
                </li>
                    <?php
                }
                ?>

            </ul>

        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->

<-- MODAL CHANGE PASSWORD -->


<div class="modal fade" id="change-password" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cambiar Contraseña</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            <form action="controller/password-update.php" method="POST">
                <input type="hidden" name="id" id="id" value="<?php echo $_SESSION['id'] ?> ">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Nuevo Password:</label>
                        <input type="password" class="form-control" placeholder="Ingrese password" name="password" required>

                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Confirmar Nuevo Password:</label>
                        <input type="password" class="form-control" placeholder="Confirme su password" name="confirm_password" required>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="update" class="btn btn-primary w-md">Actualizar Password</button>
                </div>
            </form>
        </div>
    </div>
</div>
