<?php


use PHPUnit\Framework\TestCase;
use Wasp\Arquitetura\Academico\Dominio\Email;

class EmailTest extends TestCase
{
    public function testEmailNoFormatoInvalidoNaoDevePoderExistir()
    {
        $this->expectException(\InvalidArgumentException::class);
        new Email('email inválido');
    }

    public function testEmailDevePoderSerRepresentadoComoString()
    {
        $email = new Email('endereco@email.com');
        $this->assertSame('endereco@email.com', (string) $email);
    }
}