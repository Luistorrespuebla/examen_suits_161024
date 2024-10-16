<?php
require_once '../config/conexion.php';
session_start();

if (isset($_POST['nombre_alumno']) && !empty($_POST['nombre_alumno']) && 
    isset($_POST['apellido_alumno']) && !empty($_POST['apellido_alumno']) && 
    isset($_POST['year_ingreso_alumno']) && !empty($_POST['year_ingreso_alumno']) &&
    isset($_POST['carrera_alumno']) && !empty($_POST['carrera_alumno']) &&
    isset($_POST['year_nacimiento_alumno']) && !empty($_POST['year_nacimiento_alumno'])
    ) {

    $nombreAlumno = $_POST['nombre_alumno'];
    $apellidoAlumno = $_POST['apellido_alumno'];
    $ingresoAlumno = $_POST['year_ingreso_alumno'];
    $carreraAlumno = $_POST['carrera_alumno'];
    $nacimientoAlumno = $_POST['year_nacimiento_alumno'];

    // Verificamos que los años sean numéricos
    if (is_numeric($ingresoAlumno) && is_numeric($nacimientoAlumno)) {
        // Preparamos la consulta con placeholders correctamente
        $insercion = $conexion->prepare("INSERT INTO t_alumno (nombre, apellido, year_Ingreso, carrera, year_Nacimiento) 
                                         VALUES(:nombre, :apellido, :yearIngreso, :carrera, :yearNacimiento)");
        // Asignamos los valores
        $nombre = $nombreAlumno;
        $apellido = $apellidoAlumno;  // Cambio aquí, corregir nombre de la variable
        $yearIngreso = $ingresoAlumno;
        $carrera = $carreraAlumno;  // Cambio aquí, corregir nombre de la variable
        $yearNacimiento = $nacimientoAlumno;

        // Asignamos los parámetros
        $insercion->bindParam(':nombre', $nombre);
        $insercion->bindParam(':apellido', $apellido);
        $insercion->bindParam(':yearIngreso', $yearIngreso);
        $insercion->bindParam(':carrera', $carrera);
        $insercion->bindParam(':yearNacimiento', $yearNacimiento);

        // Ejecutamos la consulta
        if ($insercion->execute()) {
            echo json_encode([1, "Registro correcto"]);
        } else {
            echo json_encode([0, "Registro incorrecto"]);
        }
    } else {
        echo json_encode([0, "Los campos Año de Ingreso y Año de Nacimiento deben ser numéricos"]);
    }

} else {
    echo json_encode([0, "No puedes dejar campos vacíos"]);
}
?>
