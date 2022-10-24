<?php

namespace Wasp\Arquitetura\Gamificacao\Infra\Selo;

use Wasp\Arquitetura\Shared\Dominio\Cpf;
use Wasp\Arquitetura\Gamificacao\Dominio\Selo\Selo;
use Wasp\Arquitetura\Gamificacao\Dominio\Selo\SeloRepositoryInterface;

class SeloMemoriaRepository implements SeloRepositoryInterface
{
    private array $selos = [];

    public function adiciona(Selo $selo): void
    {
        $this->selos[] = $selo;
    }

    public function selosDeAlunoComCpf(Cpf $cpf)
    {
        return array_filter($this->selos, fn (Selo $selo) => $selo->cpfAluno() === $cpf);
    }
}