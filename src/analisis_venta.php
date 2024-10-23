<?php
session_start();
if ($_SESSION['rol'] == 1) {
    include_once "includes/header.php";
    include "../conexion.php";
?>

<div class="container mt-3">
    <h2 class="text-center mb-4">Análisis de Ventas</h2>

    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Productos más Vendidos</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>Producto</th>
                            <th>Total Vendido</th>
                            <th>Total Ingreso</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $queryProductos = "
                            SELECT p.nombre, SUM(dp.cantidad) AS total_vendido, SUM(dp.cantidad * dp.precio) AS total_ingreso
                            FROM detalle_pedidos dp
                            JOIN platos p ON dp.nombre = p.nombre
                            JOIN pedidos pe ON dp.id_pedido = pe.id
                            WHERE pe.estado = 'FINALIZADO'
                            GROUP BY p.nombre
                            ORDER BY total_vendido DESC
                        ";
                        $resultProductos = mysqli_query($conexion, $queryProductos);
                        while ($row = mysqli_fetch_assoc($resultProductos)) {
                            echo "<tr>
                                    <td>{$row['nombre']}</td>
                                    <td>{$row['total_vendido']}</td>
                                    <td>{$row['total_ingreso']}</td>
                                  </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0">Ingresos por Fecha</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Fecha</th>
                                    <th>Ingreso Diario</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $queryIngresosFecha = "
                                    SELECT DATE(pe.fecha) AS fecha, SUM(pe.total) AS ingreso_diario
                                    FROM pedidos pe
                                    WHERE pe.estado = 'FINALIZADO'
                                    GROUP BY DATE(pe.fecha)
                                    ORDER BY fecha DESC
                                ";
                                $resultIngresosFecha = mysqli_query($conexion, $queryIngresosFecha);
                                while ($row = mysqli_fetch_assoc($resultIngresosFecha)) {
                                    echo "<tr>
                                            <td>{$row['fecha']}</td>
                                            <td>{$row['ingreso_diario']}</td>
                                          </tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-info text-white">
                    <h4 class="mb-0">Ingresos por Sala</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Sala</th>
                                    <th>Ingreso Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $queryIngresosSala = "
                                    SELECT s.nombre AS sala, SUM(pe.total) AS ingreso_sala
                                    FROM pedidos pe
                                    JOIN salas s ON pe.id_sala = s.id
                                    WHERE pe.estado = 'FINALIZADO'
                                    GROUP BY s.nombre
                                ";
                                $resultIngresosSala = mysqli_query($conexion, $queryIngresosSala);
                                while ($row = mysqli_fetch_assoc($resultIngresosSala)) {
                                    echo "<tr>
                                            <td>{$row['sala']}</td>
                                            <td>{$row['ingreso_sala']}</td>
                                          </tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    mysqli_close($conexion);
    include_once "includes/footer.php";
} else {
    header('Location: permisos.php');
}
?>
