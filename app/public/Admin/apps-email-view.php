<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>
<?php include ('layouts/config.php');?>

<?php
    $id_user = $_SESSION['id'];
?>

<?php

session_start();

$id_Message = $_GET['id_Message'];
    $query = "SELECT *, UT.name as 'utname', UT.lastname as 'utlastname', UF.useremail as 'ufemail', UF.name as 'ufname', UF.lastname as 'uflastname', UF.image as 'ufimage', UF.useremail as 'ufuseremail' FROM message M
            LEFT JOIN users UT on UT.id = M.to_Message
            LEFT JOIN users UF on UF.id = M.from_Message 
            WHERE id_Message = $id_Message";

    $query_run = mysqli_query($link, $query) or ($error= mysqli_error($link));
    //echo $error;
    //die();

    if ($query_run) {
    //$usuario = array();
    while ($row  = mysqli_fetch_array($query_run)) {
    //$usuario = $row;

?>

<head>

    <title><?php echo $titulo ?> | Mensajes</title>
    <?php include 'layouts/head.php'; ?>
    <?php include 'layouts/head-style.php'; ?>

</head>

<?php include 'layouts/body.php'; ?>

<!-- Begin page -->
<div id="layout-wrapper">

    <?php include 'layouts/menu.php'; ?>

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Leer Mensaje</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Mensajes Internos</a></li>
                                    <li class="breadcrumb-item active">Leer mensaje</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-12">
                        <!-- Left sidebar -->
                        <div class="email-leftbar card">
                            <button type="button" class="btn btn-danger btn-block waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#composemodal">
                                Redactar
                            </button>
                            <div class="mail-list mt-4">
                                <a href="apps-email-inbox.php" class="active"><i class="mdi mdi-email-outline me-2"></i> Recibidos
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



                                    // Mostrar la cantidad de mensajes sin leer en pantalla dentro de una etiqueta <p>
                                    echo "<span>(" . $cantidad_mensajes_sin_leer . ")</span>";
                                    ?>

                                </a>

                                <a href="apps-email-read.php"><i class='mdi mdi-email-open-outline me-2'> </i>Leídos</a>
                                <a href="apps-email-send.php"><i class="mdi mdi-email-check-outline me-2"> </i>Enviados</a>
<!--                                <a href="apps-email-draft.php"><i class="mdi mdi-trash-can-outline me-2"> </i>Eliminados</a>-->
                            </div>

                        </div>
                        <!-- End Left sidebar -->

                        <!-- Right Sidebar -->
                        <div class="email-rightbar mb-3">

                            <div class="card">
                                <div class="btn-toolbar gap-2 p-3" role="toolbar">
                                    <div class="btn-group">
                                        <h5>Lectura de Mensaje</h5>
                                    </div>

                                </div>


                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-4">
                                        <div class="flex-shrink-0 me-3">
                                            <img class="rounded-circle avatar-sm" src="uploads/usuarios/<?php echo $row['image'] ?>" alt="Generic placeholder image">
                                        </div>
                                        <div class="flex-grow-1">
                                            <h5 class="font-size-14 mb-0"><?php echo $row['name'] ?> <?php echo $row['lastname'] ?></h5>
                                            <small class="text-muted"><?php echo $row['ufuseremail'] ?></small>
                                        </div>
                                    </div>

                                    <h4 class="font-size-16"><?php echo $row['subject_Message'] ?></h4>
                                    <br />
                                    <p>Q:.H:. <?php echo $row['utname'] ?> <?php echo $row['utlastname'] ?>,</p>
                                    <br />
                                    <p><?php echo $row['content_Message'] ?>
                                    </p>

                                    <a href="" class="btn btn-secondary waves-effect mt-4" data-bs-toggle="modal" data-bs-target="#composemodal1"><i class="mdi mdi-reply me-1"></i> Responder</a>
                                </div>

                            </div>
                        </div>
                        <!-- card -->

                    </div>
                    <!-- end Col -->

                </div>
                <!-- end row -->

            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        <!-- Modal -->
        <div class="modal fade" id="composemodal1" tabindex="-1" role="dialog" aria-labelledby="composemodalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <form action="controller/email-replay.php" method="POST" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title font-size-16" id="composemodalTitle">Nuevo Mensaje</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div>
                                <div class="mb-3">
                                    <input type="hidden" name="to_Message" id="to_Message" class="form-select" value="<?php echo $row['from_Message'] ?>">
                                    <input type="text" value="<?php echo $row['ufname'] ?> <?php echo $row['uflastname'] ?>" class="form-select" disabled>
                                </div>

                                <div class="mb-3">
                                    <input type="text" name="subject_Message" id="subject_Message" class="form-control" placeholder="Asunto">
                                </div>
                                <div class="mb-3 email-editor">
                                    <textarea name="content_Message" id="content_Message" cols="30" rows="10" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" name="crear" class="btn btn-primary">Enviar <i class="fab fa-telegram-plane ms-1"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- end modal -->

        <!-- Modal 2 -->
        <div class="modal fade" id="composemodal" tabindex="-1" role="dialog" aria-labelledby="composemodalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <form action="controller/email-new.php" method="POST" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title font-size-16" id="composemodalTitle">Nuevo Mensaje</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div>
                                <div class="mb-3">

                                    <select name="to_Message" id="to_Message" class="form-select">
                                        <?php try {
                                            $sql = 'SELECT id, name, lastname FROM users';
                                            foreach ($link->query($sql) as $rowc) {
                                                if ($row['name']) {
                                                    $selected = 'selected="selected"';
                                                } else {
                                                    $selected = '';
                                                }
                                                ?>
                                                <option <?= $selected ?> value="<?= $rowc['id'] ?>"><?= $rowc['name'] ?> <?= $rowc['lastname'] ?></option>
                                                <?php
                                            }
                                        } catch (PDOException  $e) {
                                            echo "Error: " . $e;
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <input type="text" name="subject_Message" id="subject_Message" class="form-control" placeholder="Asunto">
                                </div>
                                <div class="mb-3 email-editor">
                                    <textarea name="content_Message" id="content_Message" cols="30" rows="10" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" name="crear" class="btn btn-primary">Enviar <i class="fab fa-telegram-plane ms-1"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- end modal -->



        <?php include 'layouts/footer.php'; ?>
    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->


<!-- Right Sidebar -->
<?php include 'layouts/right-sidebar.php'; ?>
<!-- /Right-bar -->

<!-- JAVASCRIPT -->

<?php include 'layouts/vendor-scripts.php'; ?>

<!--ckeditor js-->
<script src="assets/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js"></script>

<!-- email editor init -->
<script src="assets/js/pages/email-editor.init.js"></script>

<script src="assets/js/app.js"></script>

</body>

</html>
<?php
    }
} else {
        echo '<script> alert ("No se a guardado")</script>';
        header('Location: index.php');
    }
?>