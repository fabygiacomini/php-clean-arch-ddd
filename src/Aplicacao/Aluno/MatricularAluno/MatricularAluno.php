<?php

namespace Wasp\Arquitetura\Aplicacao\Aluno\MatricularAluno;

use Wasp\Arquitetura\Dominio\Aluno\Aluno;
use Wasp\Arquitetura\Dominio\Aluno\AlunoRepositoryInterface;

// UseCase ou Application Service ou Command Handler
class MatricularAluno
{
    private AlunoRepositoryInterface $alunoRepository;

    public function __construct(AlunoRepositoryInterface $alunoRepository)
    {
        $this->alunoRepository = $alunoRepository;
    }

    public function executa(MatricularAlunoDto $dadosAluno): void
    {
        $aluno = Aluno::comCpfNomeEEmail(
            $dadosAluno->cpfAluno,
            $dadosAluno->nomeAluno,
            $dadosAluno->emailAluno
        );

        $this->alunoRepository->adicionar($aluno);
    }
}