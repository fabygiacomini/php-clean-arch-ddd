<?php

namespace Wasp\Arquitetura\Academico\Infra\Indicacao;

use Wasp\Aplicacao\Academico\Indicacao\EnviaEmailIndicacaoInterface;
use Wasp\Arquitetura\Academico\Dominio\Aluno\Aluno;

class EnviaEmailIndicacaoPhpMail implements EnviaEmailIndicacaoInterface
{
    public function enviaPara(Aluno $alunoIndicado): void
    {
        // exemplo
        mail(
            $alunoIndicado->email(),
            "Indicação",
            "Você foi indicado para conhecer nossos cursos! ..."
        );
    }
}