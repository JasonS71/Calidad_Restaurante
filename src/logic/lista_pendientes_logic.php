<?php
session_start();
include "../conexion.php";

function checkAuthorization($allowed_roles = []) {
    if (!isset($_SESSION['rol']) || !in_array($_SESSION['rol'], $allowed_roles)) {
        header('Location: permisos.php');
        exit;
    }
}

function getSalas() {
    return [1, 2, 3];
}

function getSalaById($conexion, $id_sala) {
    $query = mysqli_query($conexion, "SELECT * FROM salas WHERE id = " . intval($id_sala));
    return mysqli_fetch_assoc($query);
}

function getPendingOrders($conexion, $id_sala, $num_mesa) {
    $query = mysqli_query($conexion, "SELECT * FROM pedidos WHERE id_sala = " . intval($id_sala) . " AND num_mesa = " . intval($num_mesa) . " AND estado = 'PENDIENTE'");
    return mysqli_fetch_assoc($query);
}

function prepareData() {
    global $conexion;
    $salas = getSalas();
    $data = [];

    foreach ($salas as $id_sala) {
        $sala = getSalaById($conexion, $id_sala);
        if ($sala) {
            $mesas = [];
            for ($i = 1; $i <= $sala['mesas']; $i++) {
                $pedido = getPendingOrders($conexion, $id_sala, $i);
                if ($pedido) {
                    $mesas[$i] = ['pending' => true, 'num_mesa' => $i];
                } else {
                    $mesas[$i] = ['pending' => false, 'num_mesa' => $i];
                }
            }
            $data[] = ['sala' => $id_sala, 'mesas' => $mesas];
        }
    }
    return $data;
}

checkAuthorization([2, 3]);

$data = prepareData();
?>
