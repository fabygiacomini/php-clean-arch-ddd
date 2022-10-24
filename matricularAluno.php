<?php

use Wasp\Arquitetura\Academico\Aplicacao\Aluno\MatricularAluno\MatricularAluno;
use Wasp\Arquitetura\Academico\Aplicacao\Aluno\MatricularAluno\MatricularAlunoDto;
use Wasp\Arquitetura\Academico\Dominio\Aluno\LogDeAlunoMatriculado;
use Wasp\Arquitetura\Academico\Infra\Aluno\AlunoMemoriaRepository;
use Wasp\Arquitetura\Gamificacao\Infra\Selo\SeloMemoriaRepository;
use Wasp\Arquitetura\Shared\Dominio\Evento\PublicadorDeEvento;

require 'vendor/autoload.php';

$cpf = $argv[1];
$nome = $argv[2];
$email = $argv[3];
$ddd = $argv[4];
$numero = $argv[5];

$publicador = new PublicadorDeEvento(); // possivelmente esta configuração ficaria dentro de um container de injeção de dependências
$publicador->adicionarOuvinte(new LogDeAlunoMatriculado());
$publicador->adicionarOuvinte(new GeraSeloDeNovato(new SeloMemoriaRepository()));

// use case
$dadosAluno = new MatricularAlunoDto($cpf, $nome, $email);
$useCase = new MatricularAluno(new AlunoMemoriaRepository(), $publicador);
$useCase->executa($dadosAluno);
