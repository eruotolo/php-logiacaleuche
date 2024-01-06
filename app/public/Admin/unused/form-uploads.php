<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>

<head>

    <title>File Upload | Minia - Admin & Dashboard Template</title>
    <?php include 'layouts/head.php'; ?>

    <!-- dropzone css -->
    <link href="../assets/libs/dropzone/min/dropzone.min.css" rel="stylesheet" type="text/css" />

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
                            <h4 class="mb-sm-0 font-size-18">File Upload</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                                    <li class="breadcrumb-item active">File Upload</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Dropzone</h4>
                                <p class="card-title-desc">DropzoneJS is an open source library
                                    that provides drag’n’drop file uploads with image previews.
                                </p>
                            </div>
                            <div class="card-body">

                                <div>
                                    <form action="../controller/upload.php" class="dropzone" id="refreshThis">
                                        <div class="fallback">
                                            <input name="file" type="file" multiple="multiple">
                                        </div>
                                        <div class="dz-message needsclick">
                                            <div class="mb-3">
                                                <i class="display-4 text-muted bx bx-cloud-upload"></i>
                                            </div>

                                            <h5>Drop files here or click to upload.</h5>
                                        </div>
                                    </form>
                                </div>

                                <div class="text-center mt-4">
                                    <button type="button" class="btn btn-primary waves-effect waves-light" id="startUpload" data-bs-toggle="modal" data-bs-target="#exampleModal">Send
                                        Files</button>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->

                <div class="row">
                    <div class="col-12">
                        <?php

                        ?>
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

<!-- MODAL MENSAJE ENVIADO CORRECTO -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onClick="window.location.reload();"></button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onClick="window.location.reload();">Close</button>
                <button type="button" class="btn btn-primary" onClick="window.location.reload();">Save changes</button>
            </div>
        </div>
    </div>
</div>


<!-- Right Sidebar -->
<?php include 'layouts/right-sidebar.php'; ?>
<!-- /Right-bar -->

<!-- JAVASCRIPT -->

<?php include 'layouts/vendor-scripts.php'; ?>

<!-- dropzone js -->
<script src="../assets/libs/dropzone/min/dropzone.min.js"></script>

<script src="../assets/js/app.js"></script>

<script>
    //Disabling autoDiscover
    Dropzone.autoDiscover = false;

    $(function() {

        let arrImages = [];
        //Dropzone class
        let myDropzone = new Dropzone(".dropzone", {
            url: "controller/upload.php",
            paramName: "file",
            maxFilesize: 10,
            maxFiles: 10,
            acceptedFiles: "image/*,application/pdf",
            autoProcessQueue: false,
            addRemoveLinks: true,
            dictRemoveFile: 'Eliminar',
        });

        $('#startUpload').click(function(){
            myDropzone.processQueue();
        });

        myDropzone.on('addedfile', file => {
            arrImages.push(file);
        });

        myDropzone.on('removedfile', file => {
            let i = arrImages.indexOf(file);
            arrImages.splice(i, 1);
        });

    });

</script>
<script>
    function reload() {
        window.location.refresh();
    }
</script>


</body>

</html>