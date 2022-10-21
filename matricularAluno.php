<?php

use Wasp\Arquitetura\Aplicacao\Aluno\MatricularAluno\MatricularAluno;
use Wasp\Arquitetura\Aplicacao\Aluno\MatricularAluno\MatricularAlunoDto;
use Wasp\Arquitetura\Infra\Aluno\AlunoMemoriaRepository;

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
$useCase = new MatricularAluno(new AlunoMemoriaRepository());
$useCase->executa($dadosAluno);
