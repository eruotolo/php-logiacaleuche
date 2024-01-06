<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to index page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: index.php");
    exit;
}
// Include config file
require_once "layouts/config.php";

// Define variables and initialize with empty values
$useremail = $username = $password = $image = $name = $lastname = $date_birthday = $phone = $address = $city = $category = $date_initiation = $date_salary = $date_exalted = $oficialidad = $grado = $grado = "";
$username_err = $password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if username is empty
    if (empty(trim($_POST["username"]))) {
        $username_err = "Ingresar nombre de usuarios.";
    } else {
        $username = trim($_POST["username"]);
    }

    // Check if password is empty
    if (empty(trim($_POST["password"]))) {
        $password_err = "Ingresar password de usuario.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if (empty($username_err) && empty($password_err)) {
        // Prepare a select statement
        $sql = "SELECT id, useremail, username, password, image, name, lastname, date_birthday, phone, address, city, category, date_initiation, date_salary, date_exalted, grado, oficialidad, estado  FROM users WHERE username = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            $param_username = $username;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Store result
                mysqli_stmt_store_result($stmt);

                // Check if username exists, if yes then verify password
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    // Bind result variables
                    mysqli_stmt_bind_result(
                            $stmt,
                            $userid,
                            $useremail,
                            $username,
                            $hashed_password,
                            $image,
                            $name,
                            $lastname,
                            $date_birthday,
                            $phone,
                            $address,
                            $city,
                            $category,
                            $date_initiation,
                            $date_salary,
                            $date_exalted,
                            $grado,
                            $oficialidad,
                            $estado);

                    if (mysqli_stmt_fetch($stmt)) {
                        if (password_verify($password, $hashed_password))  {
                            // Password is correct, so start a new session
                            session_start();
                            // Store data in session variables
                            $_SESSION['loggedin'] = true;
                            $_SESSION['id'] = $userid;
                            $_SESSION['useremail'] = $useremail;
                            $_SESSION['username'] = $username;
                            $_SESSION['hashed_password'] = $hashed_password;
                            $_SESSION['image'] = $image;
                            $_SESSION['name'] = $name;
                            $_SESSION['lastname'] = $lastname;
                            $_SESSION['date_birthday'] = $date_birthday;
                            $_SESSION['phone'] = $phone;
                            $_SESSION['address'] = $address;
                            $_SESSION['city'] = $city;
                            $_SESSION['category'] = $category;
                            $_SESSION['date_initiation'] = $date_initiation;
                            $_SESSION['date_salary'] = $date_salary;
                            $_SESSION['date_exalted'] = $date_exalted;
                            $_SESSION['grado'] = $grado;
                            $_SESSION['oficialidad'] = $oficialidad;
                            $_SESSION['estado'] = $estado;

                            // Redirect user to welcome page
                            header("location: index.php");
                        } else {
                            // Display an error message if password is not valid
                            $password_err = "La contraseña que has introducido no es válida.";
                        }

                    }

                } else {
                    // Display an error message if username doesn't exist
                    $username_err = "No se encontró ninguna cuenta con ese nombre de usuario.";
                }
            }else {
                echo "Oops! Algo salió mal. Por favor, inténtelo de nuevo más tarde.";
            }
            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Close connection
    mysqli_close($link);
}
?>
<?php include 'layouts/head-main.php'; ?>

<head>

    <title><?php echo $titulo ?> | Ingresar</title>

    <?php include 'layouts/head.php'; ?>

    <?php include 'layouts/head-style.php'; ?>

</head>

<?php include 'layouts/body.php'; ?>
<div class="auth-page">
    <div class="container-fluid p-0">
        <div class="row g-0">
            <div class="col-xxl-3 col-lg-4 col-md-5">
                <div class="auth-full-page-content d-flex p-sm-5 p-4">
                    <div class="w-100">
                        <div class="d-flex flex-column h-100">
                            <div class="mb-4 mb-md-5 text-center">
                                <a href="index.php" class="d-block auth-logo">
                                    <!--<img src="assets/images/logo-sm.svg" alt="" height="28"> <span class="logo-txt">Intranet Logia Caleuche</span>-->
                                    <img class="logo-caleuche" src="assets/images/logo.jpg" alt="Logo">
                                </a>
                            </div>
                            <div class="auth-content my-auto">
                                <div class="text-center">
                                    <h5 class="mb-0">Bienvenido!</h5>
                                    <p class="text-muted mt-2">Inicia sesión para continuar en la Intranet.</p>
                                </div>
                                <form class="mt-4 pt-2" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                    <div class="mb-3 <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                                        <label class="form-label" for="username">RUT del usuario</label>
                                        <input type="text" class="form-control" id="username" placeholder="Ingrese su RUT sin puntos y sin guión" name="username" value="">
                                        <span class="text-danger"><?php echo $username_err; ?></span>
                                    </div>
                                    <div class="mb-3 <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                                        <div class="d-flex align-items-start">
                                            <div class="flex-grow-1">
                                                <label class="form-label" for="password">Contraseña</label>
                                            </div>
                                            <!--<div class="flex-shrink-0">
                                                <div class="">
                                                    <a href="auth-recoverpw.php" class="text-muted">Has olvidado tu contraseña?</a>
                                                </div>
                                            </div>-->
                                        </div>
                                        
                                        <div class="input-group auth-pass-inputgroup">
                                            <input type="password" class="form-control" placeholder="Ingrese su Contraseña" name="password" value="" aria-label="Password" aria-describedby="password-addon">

                                            <button class="btn btn-light ms-0" type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                            <span class="text-danger"><?php echo $password_err; ?></span>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="remember-check">
                                                <label class="form-check-label" for="remember-check">
                                                    Recordarme
                                                </label>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="mb-3">
                                        <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Ingresar</button>
                                    </div>
                                </form>

                            </div>
                            <div class="mt-4 mt-md-5 text-center">
                                <p class="mb-0">© <script>
                                        document.write(new Date().getFullYear())
                                    </script> Design & Develop <i class="mdi mdi-heart text-danger"></i> by <a href="https://crowadvance.com" target="_blank">Crow Advance</a> </p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end auth full page content -->
            </div>
            <!-- end col -->
            <div class="col-xxl-9 col-lg-8 col-md-7">
                <div class="auth-bg pt-md-5 p-4 d-flex">
                    <div class="bg-overlay bg-primary"></div>
                    <ul class="bg-bubbles">
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                    </ul>
                    <!-- end bubble effect -->
                    <div class="row justify-content-center align-items-center">
                        <div class="col-xl-7">
                            <div class="p-0 p-sm-4 px-xl-0">
                                <div id="reviewcarouselIndicators" class="carousel slide" data-bs-ride="carousel">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container fluid -->
</div>


<!-- JAVASCRIPT -->

<?php include 'layouts/vendor-scripts.php'; ?>
<!-- password addon init -->
<script src="assets/js/pages/pass-addon.init.js"></script>

</body>

</html>