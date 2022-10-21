<?php


use Wasp\Arquitetura\Dominio\Aluno\Aluno;

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