<?php

require 'vendor/autoload.php';
use PHPUnit\Framework\TestCase;

class LogicTest extends TestCase
{
    public function testCheckAuthorization()
    {
        $_SESSION['rol'] = 2;
        ob_start();
        checkAuthorization([2, 3]);
        ob_end_clean();
        
        $this->assertTrue(true);
    }

    public function testGetSalas()
    {
        $expectedSalas = [1, 2, 3];
        $this->assertEquals($expectedSalas, getSalas());
    }

    public function testGetSalaById()
    {
        $mockConexion = $this->createMock(mysqli::class);

        $expectedResult = ['id' => 1, 'mesas' => 5];
        
        $mockQuery = $this->createMock(mysqli_result::class);
        $mockQuery->method('fetch_assoc')->willReturn($expectedResult);

        $mockConexion->method('query')->willReturn($mockQuery);
        
        $salaData = getSalaById($mockConexion, 1);
        $this->assertEquals($expectedResult, $salaData);
    }
}
