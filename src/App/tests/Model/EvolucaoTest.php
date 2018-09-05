<?php
use PHPUnit\Framework\TestCase;
class EvolucaoTest extends TestCase{

    public function test_if_evolucao_create()
    {
        $this->assertEquals('evolução','evolução');
    }
}