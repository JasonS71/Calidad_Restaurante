<?php
session_start();
include dirname(__DIR__) . "../../conexion.php";


function checkAuthorization($allowed_roles = []) {
    if (!isset($_SESSION['rol']) || !in_array($_SESSION['rol'], $allowed_roles)) {
        header('Location: permisos.php');
        exit;
    }
}

function getProductosMasVendidos($conexion) {
    $query = "
        SELECT p.nombre, SUM(dp.cantidad) AS total_vendido, SUM(dp.cantidad * dp.precio) AS total_ingreso
        FROM detalle_pedidos dp
        JOIN platos p ON dp.nombre = p.nombre
        JOIN pedidos pe ON dp.id_pedido = pe.id
        WHERE pe.estado = 'FINALIZADO'
        GROUP BY p.nombre
        ORDER BY total_vendido DESC
    ";
    return mysqli_query($conexion, $query);
}

function getIngresosPorFecha($conexion) {
    $query = "
        SELECT DATE(pe.fecha) AS fecha, SUM(pe.total) AS ingreso_diario
        FROM pedidos pe
        WHERE pe.estado = 'FINALIZADO'
        GROUP BY DATE(pe.fecha)
        ORDER BY fecha DESC
    ";
    return mysqli_query($conexion, $query);
}

function getIngresosPorSala($conexion) {
    $query = "
        SELECT s.nombre AS sala, SUM(pe.total) AS ingreso_sala
        FROM pedidos pe
        JOIN salas s ON pe.id_sala = s.id
        WHERE pe.estado = 'FINALIZADO'
        GROUP BY s.nombre
    ";
    return mysqli_query($conexion, $query);
}

checkAuthorization([1]);

$productos = getProductosMasVendidos($conexion);
$ingresosFecha = getIngresosPorFecha($conexion);
$ingresosSala = getIngresosPorSala($conexion);

mysqli_close($conexion);
?>
