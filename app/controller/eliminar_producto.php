<?php
require_once '../config/conexion.php';
session_start();

$idAlumno = $_POST['idInput'];

$eliminar = $conexion->prepare("DELETE FROM t_alumno WHERE id = :id");
$id = $idAlumno;
$eliminar->bindParam(':id',$id);
$eliminar->execute();

if ($eliminar) {
    echo json_encode([1,'Se elimino el producto']);
} else {
    echo json_encode([0,'Fallo en la eliminación']);
}

?>