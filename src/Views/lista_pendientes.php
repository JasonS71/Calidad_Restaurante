<?php
include_once "includes/header.php";
include 'logic.php';

foreach ($data as $salaData) {
    ?>
    <div class="card">
        <div class="card-header text-center">
            Pedidos Pendientes - Sala <?php echo $salaData['sala']; ?>
        </div>
        <div class="card-body">
            <div class="row">
                <?php
                $hasPendingOrders = false;
                foreach ($salaData['mesas'] as $mesa) {
                    if ($mesa['pending']) {
                        $hasPendingOrders = true;
                        ?>
                        <div class="col-md-3">
                            <div class="card card-widget widget-user">
                                <div class="widget-user-header bg-danger">
                                    <h3 class="widget-user-username">MESA</h3>
                                    <h5 class="widget-user-desc"><?php echo $mesa['num_mesa']; ?></h5>
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
include_once "includes/footer.php";
?>
