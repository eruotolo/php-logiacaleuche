<?php
include ('../layouts/config.php');

// NUEVO USUARIO
if(isset($_POST['crear'])){
    $useremail = $_POST['useremail'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = "";
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $param_token = bin2hex(random_bytes(50));
    $firstname = $_POST['name'];
    $lastname = $_POST['lastname'];
    $category = $_POST['category'];
    $grado = $_POST['grado'];
    $estado = $_POST['estado'];
    $oficialidad = 1;


    #file name with a random number so that similar dont get replaced
    $pname = rand(1000,10000)."-".$_FILES["file"]["name"];

    #temporary file name to store file
    $tname = $_FILES["file"]["tmp_name"];

    #upload directory path
    $uploads_dir = '../uploads/usuarios/';

    #TO move the uploaded file to specific location
    move_uploaded_file($tname, $uploads_dir.'/'.$pname);

    // Validate useremail
    if (empty(trim($_POST["useremail"]))) {
        $useremail_err = "Please enter a useremail.";
    } elseif (!filter_var($_POST["useremail"], FILTER_VALIDATE_EMAIL)) {
        $useremail_err = "Invalid email format";
    } else {
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE useremail = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_useremail);

            // Set parameters
            $param_useremail = trim($_POST["useremail"]);

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                /* store result */
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $useremail_err = "Este correo electrónico ya está en uso.";
                } else {
                    $useremail = trim($_POST["useremail"]);
                }
            } else {
                echo "¡Ups! Algo salió mal. Por favor, inténtelo de nuevo.";
            }

            // Close statement
            mysqli_stmt_close($stmt);

        }
    }

    // Validate Nombre
    if (empty(trim($_POST["firstname"]))) {
        $firstname_err = "Por favor, ingrese un nombre.";
    } else {
        $firstname = trim($_POST["firstname"]);
    }

    // Validate Apellido
    if (empty(trim($_POST["lastname"]))) {
        $lastname_err = "Por favor, ingrese un apellido.";
    } else {
        $lastname = trim($_POST["lastname"]);
    }

    // Validate Usuario
    if (empty(trim($_POST["username"]))) {
        $username_err = "Por favor, ingrese un nombre de usuario.";
    } else {
        $username = trim($_POST["username"]);
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Por favor, ingrese una contraseña.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "La contraseña debe tener al menos 6 caracteres.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Por favor, introduzca una contraseña de confirmación.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "La contraseña no coincidió.";
        }
    }

    // Validate Categoria Interno para el Administrador General Siempre Ingresar con 3
    if (empty(trim($_POST["category"]))) {
        $category_err = "Por favor, ingrese una categoría.";
    } else {
        $category = trim($_POST["category"]);
    }

    // Validate Grado
    if (empty(trim($_POST["grado"]))) {
        $grado_err = "Por favor, ingrese el grado.";
    } else {
        $grado = trim($_POST["grado"]);
    }

    // Validate Estado Activo o No Activo
    if (empty(trim($_POST["estado"]))) {
        $estado_err = "Por favor, ingrese un cargo o no en la oficialidad.";
    } else {
        $estado = trim($_POST["estado"]);
    }


// Check input errors before inserting in database

    $query = "INSERT INTO users (useremail,username,password,token,image,name,lastname,category,grado,estado,oficialidad)
            VALUES('$useremail','$username','$hash','$param_token','$pname','$firstname','$lastname','$category','$grado','$estado','$oficialidad')";

    //echo $query;
    //die();

    if(mysqli_query($link, $query)){
        //echo "File Sucessfully uploaded";
        header('Location: ../apps-contacts-list.php');
    }else{
        echo"Error";
        header('Location: ../error-cargar-archivo.php');
    }
}

?>