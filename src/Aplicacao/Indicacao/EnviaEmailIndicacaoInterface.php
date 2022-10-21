<?php

namespace Wasp\Aplicacao\Indicacao;

use Wasp\Arquitetura\Dominio\Aluno\Aluno;

interface EnviaEmailIndicacaoInterface
{
    public function enviaPara(Aluno $alunoIndicado): void;
}