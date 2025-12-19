<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>

<?php
include('layouts/config.php');
session_start();

$id = $_GET['id'];
$query = "SELECT * FROM users WHERE id = $id";
$query_run = mysqli_query($link, $query);

if ($query_run) {
    //$usuario = array();
    while ($row  = mysqli_fetch_array($query_run)) {
    //$usuario = $row;
?>

<head>

    <title><?php echo $titulo ?> | Editar Perfil de Hermano</title>
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
                            <h4 class="mb-sm-0 font-size-18">Editar Perfil de Información</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="apps-contacts-list.php">Hermanos</a></li>
                                    <li class="breadcrumb-item active">Editar información</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-xl-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">ACTUALIZACIÓN INFORMACIÓN DEL Q:.H:.</h4>
                                <p class="card-title-desc">Los campos con <code>*</code> son campos requeridos/obligatorios.</p>
                            </div>
                            <div class="card-body">
                                <!-- ACA COMIENZA EL FORM-->
                                <form action="controller/usuario-update.php" method="POST" enctype="multipart/form-data">

                                    <div class="row">
                                        <input type="hidden" name="id" id="id" value="<?php echo $row['id'] ?> ">
                                        <div class="col-2 justify-content-center align-items-center img-perfil">
                                            <img src="uploads/usuarios/<?php echo $row['image']?>" alt="Imagen de Perfil" class="img-fluid rounded-circle d-block">
                                            <input type="file" class="form-control" id="file" name="file" >
                                        </div>

                                        <div class="col-5 info-personal">
                                            <h3>Información Personal</h3>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="mb-3">
                                                        <label for="name">Nombre del Q:.H:.</label>
                                                        <input type="text" class="form-control" id="name"  name="name" value="<?php echo $row['name'] ?>">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="mb-3">
                                                        <label for="lastname">Apellido del Q:.H:.</label>
                                                        <input type="text" class="form-control" id="lastname" required name="lastname" value="<?php echo $row['lastname']  ?>">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="mb-3">
                                                        <label for="date_birthday">Fecha de cumpleaños </label>
                                                        <input type="date" class="form-control" id="date_birthday"  name="date_birthday" value="<?php echo $row['date_birthday'] ?>">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="mb-3">
                                                        <label for="phone">Teléfono </label>
                                                        <input type="number" class="form-control" id="phone"  name="phone" value="<?php echo $row['phone']  ?>">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label for="useremail">Email </label>
                                                <div class="input-group">
                                                    <div class="input-group-text">@</div>
                                                    <input type="text" class="form-control" id="useremail" required name="useremail" value="<?php echo $row['useremail']  ?>">
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="city">Ciudad</label>
                                                <input type="text" class="form-control" id="city"  name="city" value="<?php echo $row['city']  ?>">
                                            </div>

                                            <div class="mb-3">
                                                <label for="address">Dirección</label>
                                                <input type="text" class="form-control" id="address"  name="address" value="<?php echo $row['address']  ?>">
                                            </div>
                                        </div>

                                        <div class="col-5 info-personal">
                                            <h3>Datos Masonicos</h3>

                                            <div class="mb-3">
                                                <label for="grado">Grado</label>
                                                <select name="grado" id="grado" class="form-select">
                                                    <?php
                                                    $sql = "SELECT * FROM grado";
                                                    $result = mysqli_query($link, $sql);
                                                    $grados = mysqli_fetch_all($result, MYSQLI_ASSOC);
                                                    foreach ($grados as $grado) { ?>
                                                        <option value="<?php echo $grado['id']; ?>" <?php if ($grado['id'] == $row['grado']){ echo 'selected'; } ?>><?php echo $grado['grado_nombre']; ?></option>}
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="oficialidad">Cargo en la Oficialidad</label>
                                                <select name="oficialidad" id="oficialidad" class="form-select">
                                                    <?php
                                                    $sql = "SELECT * FROM oficiales";
                                                    $result = mysqli_query($link, $sql);
                                                    $oficialidad = mysqli_fetch_all($result, MYSQLI_ASSOC);
                                                    foreach ($oficialidad as $oficiales) { ?>
                                                        <option value="<?php echo $oficiales['id_Oficial']; ?>" <?php if ($oficiales['id_Oficial'] == $row['oficialidad']){ echo 'selected'; } ?>><?php echo $oficiales['nombre_Oficial']; ?></option>}
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="date_initiation">Fecha de Iniciación </label>
                                                <input type="date" class="form-control" id="date_initiation" name="date_initiation" value="<?php echo $row['date_initiation']  ?>">
                                            </div>

                                            <div class="mb-3">
                                                <label for="date_salary">Fecha de Aumento de Salario</label>
                                                <input type="date" class="form-control" id="date_salary" name="date_salary" value="<?php echo $row['date_salary']  ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="date_exalted">Fecha de Exaltación</label>
                                                <input type="date" class="form-control" id="date_exalted" name="date_exalted" value="<?php echo $row['date_exalted']  ?>">
                                            </div>

                                            <div class="mb-3 btn-actualizar">
                                                <button type="submit" name="update" class="btn btn-primary w-md">Actualizar</button>
                                            </div>

                                        </div>
                                    </div>
                                </form>
                                <!-- FINALIZA EL FORM-->
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->

                    </div>
                    <!-- end col -->

                </div>
                <!-- end row -->

            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->


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

<script src="assets/js/app.js"></script>


</body>

</html>

<?php
    }
}
?>




