<?php
require 'conexionbd.php';

if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmpassword = $_POST["confirmpassword"];

    if ($password == $confirmpassword) {
        $role = "empleado"; // Valor para el rol de "empleado"

        // Generar un hash seguro de la contraseña
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Consulta SQL para verificar si el username o email ya existen
        $duplicateQuery = "SELECT * FROM login_register WHERE username = ? OR email = ?";
        $duplicateStmt = $conn->prepare($duplicateQuery);
        $duplicateStmt->bind_param("ss", $username, $email);
        $duplicateStmt->execute();
        $duplicateResult = $duplicateStmt->get_result();

        if ($duplicateResult->num_rows > 0) {
            echo "<script>alert('El nombre de usuario o correo electrónico ya están en uso.');</script>";
        } else {
            // Consulta SQL para insertar los datos con el rol establecido como "empleado"
            $query = "INSERT INTO login_register (name, username, email, password, role) VALUES (?, ?, ?, ?, ?)";
            $insertStmt = $conn->prepare($query);
            $insertStmt->bind_param("sssss", $name, $username, $email, $hashedPassword, $role);

            if ($insertStmt->execute()) {
                // Obtener la ID generada para el nuevo registro en login_register
                $userId = mysqli_insert_id($conn);

                // Insertar un nuevo registro en la tabla "empleados" con la misma ID
                $insertEmployeeQuery = "INSERT INTO empleados (id, name) VALUES (?, ?)";
                $insertEmployeeStmt = $conn->prepare($insertEmployeeQuery);
                $insertEmployeeStmt->bind_param("is", $userId, $name);
                $insertEmployeeStmt->execute();

                echo "<script>alert('Registro exitoso.');</script>";
            } else {
                echo "<script>alert('Error al registrar: " . $conn->error . "');</script>";
            }
        }
    } else {
        echo "<script>alert('Las contraseñas no coinciden.');</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="css/registration.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>


<header>
    <h2 class="logo">Sistema Gestor Vacaciones</h2>
    <nav class="navigation">
        <button class="btnLogin-poput" onclick="window.location.href='login.php'">Iniciar Sesión</button>
    </nav>
</header>


    <div class="wrapper">
        <div class="form-box register">
            <h2>Registrarse</h2>
            <form class="" action="" method = "post" autocomplete="off">
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="person"></ion-icon>
                    </span>
                    <input type="text" maxlength="15" name="name" id="name" required oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')" value=""> 
                    <label for="name">Nombre</label>
                </div>
                
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="person-circle"></ion-icon>
                    </span>
                    <input type="text" maxlength="15" name="username" id="username" required value=""> 
                    <label for="username">Usuario</label>
                </div>

                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="mail"></ion-icon>
                    </span>
                    <input type="text" name="email" id="email" required value=""> 
                    <label for="email">Email</label>                    
                </div class="input-box">

                <div class="input-box">
                    <span class="icon">
                        <span class="password-toggle" id="password-toggle">
                            <ion-icon name="eye"></ion-icon>
                        </span>
                        <ion-icon name="lock-closed"></ion-icon>     
                    </span>
                    <input type="password" maxlength="16" name="password" id="password" required value=""> 
                    <label for="password">Contraseña</label>
                </div>

                <div class="input-box">
                    <span class="icon">
                        <span class="confirmpassword-toggle" id="confirmpassword-toggle">
                            <ion-icon name="eye"></ion-icon>
                        </span>
                        <ion-icon name="lock-closed"></ion-icon>     
                    </span>
                    <input type="password" maxlength="16" name="confirmpassword" id="confirmpassword" required value=""> 
                    <label for="confirmpassword">Confirmar Contraseña</label>
                </div>
                
                <button class="btn" type="submit" name="submit">Registration</button>

                <div class="login-register">
                    <p>Si tienes una cuenta, haz clic aquí ->
                    <a href="login.php">Login</a></p>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script type ="module" src ="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script> 
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script>
    const passwordInput = document.getElementById("password");
    const passwordToggle = document.getElementById("password-toggle");

    passwordToggle.addEventListener("click", function () {
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            passwordToggle.innerHTML = '<ion-icon name="eye-off"></ion-icon>';
        } else {
            passwordInput.type = "password";
            passwordToggle.innerHTML = '<ion-icon name="eye"></ion-icon>';
        }
    });

    const confirmPasswordInput = document.getElementById("confirmpassword");
    const confirmPasswordToggle = document.getElementById("confirmpassword-toggle");

    confirmPasswordToggle.addEventListener("click", function () {
        if (confirmPasswordInput.type === "password") {
            confirmPasswordInput.type = "text";
            confirmPasswordToggle.innerHTML = '<ion-icon name="eye-off"></ion-icon>';
        } else {
            confirmPasswordInput.type = "password";
            confirmPasswordToggle.innerHTML = '<ion-icon name="eye"></ion-icon>';
        }
    });
    </script>
</body>
</html>