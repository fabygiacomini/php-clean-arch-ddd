<?php


use PHPUnit\Framework\TestCase;
use Wasp\Arquitetura\Dominio\Aluno\AdicaoTelefoneAlemDoPermitidoException;
use Wasp\Arquitetura\Dominio\Aluno\Aluno;
use Wasp\Arquitetura\Dominio\Cpf;
use Wasp\Arquitetura\Dominio\Email;

class AlunoTest extends TestCase
{
    private Aluno $aluno;

    protected function setUp(): void
    {
        $this->aluno = new Aluno(
            $this->createStub(Cpf::class),
            '',
            $this->createStub(Email::class)
        );
    }

    public function testAdicionarMaisDe2TelefonesDeveLancarExcecao()
    {
        $this->expectException(AdicaoTelefoneAlemDoPermitidoException::class);

        $this->aluno->adicionarTelefone('14', '11111111');
        $this->aluno->adicionarTelefone('14', '222222222');
        $this->aluno->adicionarTelefone('14', '33333333');
    }

    public function testAdicionar1TelefoneDeveFuncionar()
    {
        $this->aluno->adicionarTelefone('11', '11111111');

        $this->assertCount(1, $this->aluno->telefones());
    }

    public function testAdicionar2TelefonesDeveFunciona()
    {
        $this->aluno->adicionarTelefone('11', '11111111');
        $this->aluno->adicionarTelefone('11', '22222222');

        $this->assertCount(2, $this->aluno->telefones());
    }
}