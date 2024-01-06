<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>
<?php include 'layouts/config.php'; ?>

<head>

    <title><?php echo $titulo ?> | Nueva Noticias</title>

    <?php include 'layouts/head.php'; ?>

    <!-- DataTables -->
    <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

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
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Registro de Nueva Noticia</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="apps-news-list.php">Noticias</a></li>
                                <li class="breadcrumb-item active">Registro de Nueva Noticia</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Formulario de Registro de Nueva Noticia</h4>
                            <p class="card-title-desc">Los campos con <code>*</code> son requeridos.</p>
                        </div>
                        <div class="card-body">
                            <!-- ACA COMIENZA EL FORM-->
                            <form class="needs-validation mt-4 pt-2" action="controller/blog-new.php" method="post" enctype="multipart/form-data">

                                <div class="row mb-4">
                                    <label for="titulo_Feed" class="col-sm-3 col-form-label">Título Noticia</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="titulo_Feed" id="titulo_Feed" required>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="category_Feed" class="col-sm-3 col-form-label">Categoría</label>
                                    <div class="col-sm-5">
                                        <select name="category_Feed" id="category_Feed" class="form-select">
                                            <?php try {
                                                $sql = 'SELECT id_Category, nombre_Category FROM categoryfeed';
                                                foreach ($link->query($sql) as $rowc) {
                                                    if ($row['nombre_Category']) {
                                                        $selected = 'selected="selected"';
                                                    } else {
                                                        $selected = '';
                                                    }
                                                    ?>
                                                    <option <?= $selected ?> value="<?= $rowc['id_Category'] ?>"><?= $rowc['nombre_Category'] ?></option>
                                                    <?php
                                                }
                                            } catch (PDOException  $e) {
                                                echo "Error: " . $e;
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="file_name" class="col-sm-3 col-form-label">Imagen Principal</label>
                                    <div class="col-sm-5">
                                        <input type="file" class="form-control" name="file_name" id="file_name" required>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="cont_Feed" class="col-sm-3 col-form-label">Desarrollo</label>
                                    <div class="col-sm-5">
                                        <textarea class="form-control" id="cont_Feed" name="cont_Feed" rows="7" cols="33" required></textarea>
                                    </div>
                                </div>

                                <div class="row mb-4 justify-content-end">
                                    <div class="col-sm-9">
                                        <div>
                                            <button class="btn btn-primary w-md" type="submit" name="crear">Crear</button>
                                        </div>
                                    </div>
                                </div>

                            </form>
                            <!-- ACA TERMINA EL FORM -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- END layout-wrapper -->


<!-- Right Sidebar -->
<?php include 'layouts/right-sidebar.php'; ?>
<!-- /Right-bar -->

<!-- JAVASCRIPT -->

<?php include 'layouts/vendor-scripts.php'; ?>

<!-- Required datatable js -->
<script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>

<!-- Responsive examples -->
<script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

<!-- init js -->
<script src="assets/js/pages/datatable-pages.init.js"></script>
<!-- validation init -->
<script src="assets/js/pages/validation.init.js"></script>

<script src="assets/js/app.js"></script>


</body>