<?php
session_start();
if ($_SESSION['rol'] == 2 || $_SESSION['rol'] == 3) {
    include_once "includes/header.php";
    include "../conexion.php";
    $salas = [1, 2, 3];

    foreach ($salas as $id_sala) {
        $query = mysqli_query($conexion, "SELECT * FROM salas WHERE id = $id_sala");
        $result = mysqli_num_rows($query);

        if ($result > 0) {
            $data = mysqli_fetch_assoc($query);
            $mesas = $data['mesas'];
?>
            <div class="card">
                <div class="card-header text-center">
                    Pedidos Pendientes - Sala <?php echo $id_sala; ?>
                </div>
                <div class="card-body">
                    <div class="row">
                        <?php
                        $hasPendingOrders = false;
                        $item = 1;

                        for ($i = 0; $i < $mesas; $i++) {
                            $consulta = mysqli_query($conexion, "SELECT * FROM pedidos WHERE id_sala = $id_sala AND num_mesa = $item AND estado = 'PENDIENTE'");
                            $resultPedido = mysqli_num_rows($consulta);
                            if ($resultPedido > 0) {
                                $hasPendingOrders = true;
                                $pedidoData = mysqli_fetch_assoc($consulta);
                        ?>
                                <div class="col-md-3">
                                    <div class="card card-widget widget-user">
                                        <div class="widget-user-header bg-danger">
                                            <h3 class="widget-user-username">MESA</h3>
                                            <h5 class="widget-user-desc"><?php echo $item; ?></h5>
                                        </div>
                                        <div class="widget-user-image">
                                            <img class="img-circle elevation-2" src="../assets/img/mesa.jpg" alt="Mesa Avatar">
                                        </div>
                                        <div class="card-footer">
                                            <div class="description-block">
                                                <p>Estado: Pendiente</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        <?php 
                            }
                            $item++;
                        }

                        if (!$hasPendingOrders) {
                        ?>
                            <div class="col-12 text-center">
                                <p>No hay pedidos de la mesa</p>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
<?php 
        }
    }

    include_once "includes/footer.php";
} else {
    header('Location: permisos.php');
}
?>
