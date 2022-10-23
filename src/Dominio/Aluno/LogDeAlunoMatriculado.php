<?php


namespace Wasp\Arquitetura\Dominio\Aluno;

// Listener do evento AlunoMatriculado
use Wasp\Arquitetura\Dominio\EventoInterface;
use Wasp\Arquitetura\Dominio\OuvinteDeEvento;

class LogDeAlunoMatriculado extends OuvinteDeEvento
{
    /**
     * @param AlunoMatriculado $alunoMatriculado
     */
    public function reageAo(EventoInterface $alunoMatriculado): void
    {
        fprintf(
            STDERR,
            'Aluno com CPF %s foi matriculado na data %s',
            (string) $alunoMatriculado->cpfAluno(),
            $alunoMatriculado->momento()->format('d/m/Y'),
        );
    }

    public function sabeProcessar(EventoInterface $evento): bool
    {
        return $evento instanceof AlunoMatriculado;
    }
}