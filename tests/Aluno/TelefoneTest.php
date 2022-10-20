<?php

use PHPUnit\Framework\TestCase;
use Wasp\Arquitetura\Dominio\Aluno\Telefone;

class TelefoneTest extends TestCase
{
    public function testTelefoneDevePoderSerRepresentadoComoString()
    {
        $telefone = new Telefone('14', '22222222');
        $this->assertSame('(14) 22222222', (string) $telefone);
    }

    public function testTelefoneComDddInvalidoNaoDeveExistir()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectDeprecationMessage('DDD inválido');
        new Telefone('ddd', '22222222');
    }

    public function testTelefoneComNumeroInvalidoNaoDeveExistir()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectDeprecationMessage('Número de telefone inválido');
        new Telefone('14', 'número');
    }
}