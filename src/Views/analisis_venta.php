<?php
include_once "includes/header.php";
include 'logic.php';
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
                        while ($row = mysqli_fetch_assoc($productos)) {
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
                                while ($row = mysqli_fetch_assoc($ingresosFecha)) {
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
                                while ($row = mysqli_fetch_assoc($ingresosSala)) {
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

<?php include_once "includes/footer.php"; ?>
