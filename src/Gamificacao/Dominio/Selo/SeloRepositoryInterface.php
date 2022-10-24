<?php

namespace Wasp\Arquitetura\Gamificacao\Dominio\Selo;

use Wasp\Arquitetura\Shared\Dominio\Cpf;

interface SeloRepositoryInterface
{
    public function adiciona(Selo $selo): void;
    public function selosDeAlunoComCpf(Cpf $cpf);
}