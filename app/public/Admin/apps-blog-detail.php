<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>
<?php include ('layouts/config.php');?>

<?php

session_start();
$id_Feed = $_GET['id_Feed'];
$query = "SELECT * , F.created_at AS 'fcreated_at'
                FROM feed F
                JOIN users U on F.user_Feed = U.id
                JOIN categoryfeed C on F.category_Feed = C.id_Category
            WHERE id_Feed = $id_Feed";

$query_run = mysqli_query($link, $query) or ($error= mysqli_error($link));
//echo $error;
//die();

if ($query_run) {
//$usuario = array();
while ($row  = mysqli_fetch_array($query_run)) {
//$usuario = $row;
?>

<head>
    <title><?php echo $titulo ?> | <?php echo $row['titulo_Feed']; ?></title>
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
                                    <h4 class="mb-sm-0 font-size-18">Blog Detalle</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
                                            <li class="breadcrumb-item active">Blog Detalle</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-lg-8">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="">
                                            <div class="text-center mb-3">
                                                <h4><?php echo $row['titulo_Feed']; ?></h4>
                                            </div>
                                            <div class="mb-4">
                                                <img src="uploads/feed/<?php echo $row['file_name']; ?>" alt="" class="img-thumbnail mx-auto d-block">
                                            </div>

                                            <div class="text-center">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div>
                                                            <h6 class="mb-2">Categoría</h6>
                                                            <p class="text-muted font-size-15"><?php echo $row['nombre_Category']; ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="mt-4 mt-sm-0">
                                                            <h6 class="mb-2">Fecha</h6>
                                                            <p class="text-muted font-size-15"><?php echo date("d/m/Y", strtotime($row['fcreated_at'])); ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="mt-4 mt-sm-0">
                                                            <p class="text-muted mb-2">Autor</p>
                                                            <h5 class="font-size-15"><?php echo $row['name']; ?> <?php echo $row['lastname']; ?></h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>

                                            <div class="mt-4">
                                                <div class="text-muted font-size-14">
                                                    <p><?php echo $row['cont_Feed']; ?></p>
                                                </div>

                                                <hr>

                                                <div class="mt-5">
                                                    <h5 class="font-size-15"><i class="bx bx-message-dots text-muted align-middle me-1"></i> Comentarios :</h5>

                                                    <div>
                                                        <?php
                                                        $query="SELECT *, FC.created_at as 'fccreated_at'
                                                                       FROM commentsfeed FC
                                                                       JOIN users U on FC.user_Comment = U.id
                                                                       JOIN feed F on FC.feed_Comment = F.id_Feed
                                                                WHERE id_Feed=$id_Feed ORDER BY fccreated_at ASC";
                                                        $result_task = mysqli_query($link, $query);
                                                        while ($row = mysqli_fetch_Array($result_task))  {
                                                        ?>
                                                        <div class="d-flex py-3 border-top">
                                                            <div class="flex-shrink-0 me-3">
                                                                <div class="avatar-md">
                                                                    <img src="uploads/usuarios/<?php echo $row['image']; ?>" alt="" class="img-fluid d-block rounded-circle">
                                                                </div>
                                                            </div>

                                                            <div class="flex-grow-1">
                                                                <h5 class="font-size-14 mb-1"><?php echo $row['name']; ?> <?php echo $row['lastname']; ?><small class="text-muted float-end"><?php echo date("d/m/Y", strtotime($row['fccreated_at'])); ?></small></h5>
                                                                <p class="text-muted"><?php echo $row['message_Comment']; ?></p>
                                                            </div>
                                                        </div>
                                                        <?php
                                                            }
                                                        ?>
                                                    </div>
                                                </div>

                                                <hr>
                                                <div class="mt-5">
                                                    <h5 class="font-size-16 mb-3">Comentar:</h5>

                                                    <form action="controller/comments-new.php" method="post">
                                                        <div class="row">
                                                            <input type="hidden" class="form-control" placeholder="<?php echo $_SESSION['id']; ?>">
                                                            <input type="hidden" name="feed_Comment" id="feed_Comment" class="form-control" value="<?php echo $id_Feed ?>">
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="" class="form-label">Nombre</label>
                                                                    <input type="text" id="" class="form-control" placeholder="<?php echo $_SESSION['name']; ?>" disabled>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="" class="form-label">Apellido</label>
                                                                    <input type="text" id="" class="form-control"  placeholder="<?php echo $_SESSION['lastname']; ?>" disabled>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="message_Comment" class="form-label">Comentario</label>
                                                            <textarea class="form-control" name="message_Comment" id="message_Comment" placeholder="Tu comentario..." rows="3"></textarea>
                                                        </div>

                                                        <div class="text-end">
                                                            <button type="submit" name="crear" class="btn btn-primary w-sm" >Comentar</button>
                                                        </div>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->

                            <div class="col-lg-4 ">
                                <div class="row">
                                    <div class="card">
                                        <div class="card-body">

                                            <div class="mt-5">
                                                <h5 class="mb-3">Otros Post</h5>
                                                <div class="list-group list-group-flush">
                                                    <?php
                                                    $query="SELECT *, F.id_Feed as 'fid', F.created_at AS 'fcreated_at', F.estado_Feed      AS 'festado' from feed F
                                                          JOIN categoryfeed CF ON F.category_Feed = CF.id_Category
                                                          JOIN users U ON F.user_Feed = U.id
                                                          WHERE F.estado_Feed = 1 ORDER BY fcreated_at DESC";
                                                    $result_task = mysqli_query($link, $query);
                                                    while ($row = mysqli_fetch_Array($result_task))  {
                                                    ?>
                                                    <a href="apps-blog-detail.php?id_Feed=<?php echo $row['id_Feed'] ?>" class="list-group-item text-muted py-3 px-2">
                                                        <div class="d-flex align-items-center">
                                                            <div class="flex-shrink-0 me-3">
                                                                <img src="uploads/feed/<?php echo $row['file_name']; ?>" alt="" class="avatar-xl h-auto d-block rounded">
                                                            </div>
                                                            <div class="flex-grow-1 overflow-hidden">
                                                                <h5 class="font-size-13 text-truncate"><?php echo $row['titulo_Feed']; ?></h5>
                                                                <p class="mb-0 text-truncate"><?php echo date("d/m/Y", strtotime($row['fcreated_at'])); ?></p>
                                                            </div>
                                                        </div>
                                                    </a>
                                                        <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>

                                        </div>
                                    </div> <!-- end card -->
                                </div>
                            </div>

                        </div>
                        
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

        <!-- App js -->
        <script src="assets/js/app.js"></script>

    </body>
</html>
    <?php
}
} else {
    echo '<script> alert ("No se a guardado")</script>';
    //header('Location: apps-blog-detail.php?id_Feed=$id_Feed');
}
?>