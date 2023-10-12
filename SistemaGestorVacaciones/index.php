<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="css/index.css">
</head>
<body>

    <header>
        <h2 class="logo">Bienvenido a nuestro Proyecto Final
            <br>Luciano Di Muro, Facundo Antezana, Lucas Hadjilias, Fernando Nolasco
        </h2>
        <nav class="navigation">
            <button class="btnLogin-poput" onclick="window.location.href='login.php'">Iniciar Sesión</button>
            <button class="btnLogin-poput" onclick="window.location.href='registration.php'">Registrarse</button>
        </nav>
    </header>
    

    <div class="wrapper">
        <div class="form-box register"><br><br>
            <h2>Sistema Gestor de Vacaciones</h2>
            <div class="login-register">
                <p>Bienvenido a nuestro Sistema de Gestión de Vacaciones, esta aplicación web, cuenta un login y un register,
                    las funciones se dividiran en 2 secciones Empelado - administrador:
                    <li>
                        Empleado: Se podra registrar en la aplicación, una vez ingresado sus datos y registrador, se podrá logear y acceder
                                    a un apartado, donde podrá cargarse en el Sistema Vacacional. Podrá visualizar sus datos y 
                                    vacaciones solicitadas.
                    </li><br>
                    <li>
                        Administrador: Tendrá una cuenta cargada en el Sistema, el cual le permitirá logearse y constara con una tabla que tendra los registros
                                        de todos aquellos Empleados que se hayan cargado en el Sistema.
                                        El Administrador tendra una interfaz de ABM, podrá Añadir, Modificar y Eliminar tanto Empleados, como solicitudes de Vacaciones. También contara con un apartado
                                        donde prodra ver solicitudes de vacaciones e ingresar solicitudes.
                    </li>
                </p>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script type ="module" src ="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script> 
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>