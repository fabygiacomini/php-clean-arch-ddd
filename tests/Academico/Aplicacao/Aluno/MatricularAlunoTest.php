<?php


use PHPUnit\Framework\TestCase;
use Wasp\Arquitetura\Academico\Aplicacao\Aluno\MatricularAluno\MatricularAluno;
use Wasp\Arquitetura\Academico\Aplicacao\Aluno\MatricularAluno\MatricularAlunoDto;
use Wasp\Arquitetura\Academico\Dominio\Aluno\LogDeAlunoMatriculado;
use Wasp\Arquitetura\Shared\Dominio\Evento\PublicadorDeEvento;
use Wasp\Arquitetura\Academico\Infra\Aluno\AlunoMemoriaRepository;
use Wasp\Arquitetura\Shared\Dominio\Cpf;

class MatricularAlunoTest extends TestCase
{
    public function testAlunoDeveSerAdicionadoAoRepositorio()
    {
        $dadosAluno = new MatricularAlunoDto(
            '123.456.789-10',
            'Teste',
            'email@example.com'
        );

        $publicador = new PublicadorDeEvento(); // possivelmente esta configuração ficaria dentro deum container de injeção de dependências
        $publicador->adicionarOuvinte(new LogDeAlunoMatriculado());

        $repositorio = new AlunoMemoriaRepository();
        $useCase = new MatricularAluno($repositorio, $publicador);
        $useCase->executa($dadosAluno);

        $aluno = $repositorio->buscarPorCpf(new Cpf('123.456.789-10'));

        $this->assertSame('Teste', $aluno->nome());
        $this->assertSame('email@example.com', $aluno->email());
        $this->assertEmpty($aluno->telefones());
    }
}