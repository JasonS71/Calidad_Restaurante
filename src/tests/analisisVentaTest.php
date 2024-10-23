<?php
use PHPUnit\Framework\TestCase;

class AnalisisVentaTest extends TestCase {

    private $mockConexion;

    protected function setUp(): void {
        $this->mockConexion = $this->createMock(mysqli::class);
    }

    public function testGetProductosMasVendidos() {
        include_once 'src/logic/analisis_venta_logic.php';

        // Mock de la respuesta de la base de datos
        $resultadoMock = $this->createMock(mysqli_result::class);
        $resultadoMock->method('fetch_assoc')
            ->willReturnOnConsecutiveCalls(
                ['nombre' => 'Pizza', 'total_vendido' => 20, 'total_ingreso' => 200],
                null
            );

        // Mock de la función mysqli_query
        $this->mockConexion->method('query')
            ->willReturn($resultadoMock);

        // Llamada a la función a probar
        $result = getProductosMasVendidos($this->mockConexion);

        // Verificación de resultados
        $this->assertNotNull($result);
        $this->assertInstanceOf(mysqli_result::class, $result);
    }

    public function testGetIngresosPorFecha() {
        include_once 'src/logic/analisis_venta_logic.php';

        $resultadoMock = $this->createMock(mysqli_result::class);
        $resultadoMock->method('fetch_assoc')
            ->willReturnOnConsecutiveCalls(
                ['fecha' => '2024-10-20', 'ingreso_diario' => 1000],
                null
            );

        $this->mockConexion->method('query')
            ->willReturn($resultadoMock);

        $result = getIngresosPorFecha($this->mockConexion);

        // Verificación de resultados
        $this->assertNotNull($result);
        $this->assertInstanceOf(mysqli_result::class, $result);
    }

    public function testGetIngresosPorSala() {
        include_once 'src/logic/analisis_venta_logic.php';

        $resultadoMock = $this->createMock(mysqli_result::class);
        $resultadoMock->method('fetch_assoc')
            ->willReturnOnConsecutiveCalls(
                ['sala' => 'Sala 1', 'ingreso_sala' => 5000],
                null
            );

        $this->mockConexion->method('query')
            ->willReturn($resultadoMock);

        $result = getIngresosPorSala($this->mockConexion);

        // Verificación de resultados
        $this->assertNotNull($result);
        $this->assertInstanceOf(mysqli_result::class, $result);
    }
}
?>