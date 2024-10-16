<?php
require_once("./app/config/dependencias.php");


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=CSS."bootstrap.min.css";?>">
    <link rel="stylesheet" href="<?=CSS."inicio.css";?>">
    <title>Formulario de datos</title>
    <style>
        .form-container {
            margin-top: 80px; 
        }

        .custom-form, .custom-table {
            max-width: 600px;
            margin: 0 auto;
        }

        .custom-table {
            margin-top: 30px; 
        }
    </style>
</head>
<body class="vh-100">
    
    <div class="row m-4 c-datos bg-primary">
        <div class="d-flex justify-content-around align-items-center w-100">
            <h1 class="text-center text-white m-0">Telcel</h1>
            
                <button class="btn btn-danger" id="btn-cerrrar">
                    Cerrar sesión
                </button>
            </div>
        </div>
    </div>
    
    <div class="form-container" style="justify-content: center;">
        <div class="custom-form p-5 bg-light rounded shadow-sm">
            <form action="./index.php" method="post">
                <div class="input-group mt-3 c-input px-2 p-1 rounded-3">
                    <input type="text" class="form-control" id="nombre" placeholder="Nombre " name="nombre_alumno" value="">
                </div>
                <div class="input-group mt-3 c-input px-2 p-1 rounded-3">
                    <input type="text" class="form-control" id="apellido" placeholder="Apellido" name="apellido_alumno" value="">
                </div>
                <div class="input-group mt-3 c-input px-2 p-1 rounded-3">
                    <input type="text" class="form-control" id="ingreso" placeholder="Fecha de ingreso" name="year_ingreso_alumno" value="">
                </div>
                <div class="input-group mt-3 c-input px-2 p-1 rounded-3">
                    <input type="text" class="form-control" id="carrera" placeholder="Carrera" name="carrera_alumno" value="">
                </div>
                <div class="input-group mt-3 c-input px-2 p-1 rounded-3">
                    <input type="text" class="form-control" id="nacimiento" placeholder="Fecha de nacimiento" name="year_nacimiento_alumno" value="">
                </div>
                <div class="mt-3 c-button d-flex justify-content-center">
                    <button type="button" id="btn-registrar-producto" class="btn btn-danger text-white fs-4">Registrar alumno</button> 
                </div>
            </form>
        </div>

        <div class="custom-table p-5">
            <table class="table table-dark table-striped text-center">
                <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido</th>
                        <th scope="col">Año de ingreso</th>
                        <th scope="col">Carrera</th>
                        <th scope="col">Año de nacimiento</th>
                        <th scope="col">Opciones</th>

                    </tr>
                </thead>
                <tbody id="tabla_productos">
                </tbody>
            </table>
        </div>
    </div>

    <script src="./public/js/alerts.js"></script>
    <script src="./public/js/registro_productos.js"></script>
    <script src="./public/js/cerrar_session.js"></script>
</body>
</html>   