<?php

namespace Wasp\Aplicacao\Academico\Indicacao;

use Wasp\Arquitetura\Academico\Dominio\Aluno\Aluno;

interface EnviaEmailIndicacaoInterface
{
    public function enviaPara(Aluno $alunoIndicado): void;
}