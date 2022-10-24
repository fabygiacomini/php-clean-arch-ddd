<?php

use Wasp\Arquitetura\Academico\Aplicacao\Aluno\MatricularAluno\MatricularAluno;
use Wasp\Arquitetura\Academico\Aplicacao\Aluno\MatricularAluno\MatricularAlunoDto;
use Wasp\Arquitetura\Academico\Dominio\Aluno\LogDeAlunoMatriculado;
use Wasp\Arquitetura\Academico\Dominio\PublicadorDeEvento;
use Wasp\Arquitetura\Academico\Infra\Aluno\AlunoMemoriaRepository;

require 'vendor/autoload.php';

$cpf = $argv[1];
$nome = $argv[2];
$email = $argv[3];
$ddd = $argv[4];
$numero = $argv[5];

//$aluno = Aluno::comCpfNomeEEmail($cpf, $nome, $email)
//    ->adicionarTelefone($ddd, $numero);
//
//$repositorio = new AlunoMemoriaRepository();
//$repositorio->adicionar($aluno);

// use case
$dadosAluno = new MatricularAlunoDto($cpf, $nome, $email);
$publicador = new PublicadorDeEvento(); // possivelmente esta configuração ficaria dentro deum container de injeção de dependências
$publicador->adicionarOuvinte(new LogDeAlunoMatriculado());
$useCase = new MatricularAluno(new AlunoMemoriaRepository(), $publicador);
$useCase->executa($dadosAluno);
