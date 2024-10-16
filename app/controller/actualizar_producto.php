<?php 
require_once '../config/conexion.php';
session_start();

if (!empty($_POST['nombre_alumno']) && !empty($_POST['apellido_alumno']) && !empty($_POST['year_ingreso_alumno'])
&& !empty($_POST['carrera_alumno'])&& !empty($_POST['year_nacimiento_alumno'])) {

    $id = $_POST['idInput'];
    $nombre = $_POST['nombre_alumno'];
    $apellido = $_POST['apellido_alumno'];
    $year_Ingreso = $_POST['year_ingreso_alumno'];
    $carrera = $_POST['carrera_alumno'];
    $year_Nacimiento = $_POST['year_nacimiento_alumno'];

    if (is_numeric($year_Ingreso) && is_numeric($year_Nacimiento)) {
        $actualizacion = $conexion->prepare("UPDATE t_alumno 
        SET nombre = :nombre, apellido = :apellido, year_Ingredo = :year_Ingreso, carrera = :carrera,
        year_Nacimiento = :year_Nacimiento  WHERE id = :id");
    
        $id = $idAlumno;
        $nombre = $nombreAlumno;
        $apellido = $apellidoAlumno;
        $year_Ingreso = $ingresoAlumno;
        $carrera = $carreraAlumno;
        $year_Nacimiento = $nacimientoAlumno;
        
    
        $actualizacion->bindParam(':id',$id);
        $actualizacion->bindParam(':nombre',$nombre);
        $actualizacion->bindParam(':apellido',$apellido);
        $actualizacion->bindParam(':year_Ingreso',$year_Ingreso);
        $actualizacion->bindParam(':carrera',$carrera);
        $actualizacion->bindParam(':year_Nacimiento',$year_Nacimiento);

        
        $actualizacion->execute();
    
        if ($actualizacion) {
            echo json_encode([1,"Actualización realizada"]);
        } else {
            echo json_encode([0,"Fallo en actualización"]);
        }
    } else {
        echo json_encode([0,"Solo datos numericos en precio y la cantidad"]);
    }

    
} else {
    echo json_encode([0,"Faltan campos por llenar"]);
}

?>