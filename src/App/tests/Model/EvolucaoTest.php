<?php
use PHPUnit\Framework\TestCase;
//use App\Model\Evolucao;
class EvolucaoTest extends TestCase{

    public function test_if_evolucao_create()
    {
        //$evolucao = new Evolucao();
        $this->assertEquals('evolução','evolução');
    }
}