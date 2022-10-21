<?php


use PHPUnit\Framework\TestCase;
use Wasp\Arquitetura\Aplicacao\Aluno\MatricularAluno\MatricularAluno;
use Wasp\Arquitetura\Aplicacao\Aluno\MatricularAluno\MatricularAlunoDto;
use Wasp\Arquitetura\Dominio\Cpf;
use Wasp\Arquitetura\Infra\Aluno\AlunoMemoriaRepository;

class MatricularAlunoTest extends TestCase
{
    public function testAlunoDeveSerAdicionadoAoRepositorio()
    {
        $dadosAluno = new MatricularAlunoDto(
            '123.456.789-10',
            'Teste',
            'email@example.com'
        );

        $repositorio = new AlunoMemoriaRepository();
        $useCase = new MatricularAluno($repositorio);
        $useCase->executa($dadosAluno);

        $aluno = $repositorio->buscarPorCpf(new Cpf('123.456.789-10'));

        $this->assertSame('Teste', $aluno->nome());
        $this->assertSame('email@example.com', $aluno->email());
        $this->assertEmpty($aluno->telefones());
    }
}