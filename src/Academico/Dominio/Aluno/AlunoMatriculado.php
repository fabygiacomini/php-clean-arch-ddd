<?php


namespace Wasp\Arquitetura\Academico\Dominio\Aluno;

// Evento de domínio
use Wasp\Arquitetura\Academico\Dominio\Cpf;
use Wasp\Arquitetura\Academico\Dominio\EventoInterface;

class AlunoMatriculado implements EventoInterface
{
    private \DateTimeImmutable $momento;
    private Cpf $cpfAluno;

    public function __construct(Cpf $cpfAluno)
    {
        $this->momento = new \DateTimeImmutable();
        $this->cpfAluno = $cpfAluno;
    }

    public function cpfAluno(): Cpf
    {
        return $this->cpfAluno;
    }

    public function momento(): \DateTimeImmutable
    {
        return $this->momento;
    }
}