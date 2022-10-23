<?php

namespace Wasp\Arquitetura\Aplicacao\Aluno\MatricularAluno;

use Wasp\Arquitetura\Dominio\Aluno\Aluno;
use Wasp\Arquitetura\Dominio\Aluno\AlunoMatriculado;
use Wasp\Arquitetura\Dominio\Aluno\AlunoRepositoryInterface;
use Wasp\Arquitetura\Dominio\Aluno\LogDeAlunoMatriculado;
use Wasp\Arquitetura\Dominio\PublicadorDeEvento;

// UseCase ou Application Service ou Command Handler
class MatricularAluno
{
    private AlunoRepositoryInterface $alunoRepository;
    private PublicadorDeEvento $publicador;

    public function __construct(AlunoRepositoryInterface $alunoRepository, PublicadorDeEvento $publicador)
    {
        $this->alunoRepository = $alunoRepository;
        $this->publicador = $publicador;
    }

    public function executa(MatricularAlunoDto $dadosAluno): void
    {
        $aluno = Aluno::comCpfNomeEEmail(
            $dadosAluno->cpfAluno,
            $dadosAluno->nomeAluno,
            $dadosAluno->emailAluno
        );

        $this->alunoRepository->adicionar($aluno);

        $evento = new AlunoMatriculado($aluno->cpf());
        $this->publicador->publicar($evento);
    }
}