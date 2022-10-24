<?php


namespace Wasp\Arquitetura\Academico\Dominio\Aluno;

// Listener do evento AlunoMatriculado;
use Wasp\Arquitetura\Shared\Dominio\Evento\EventoInterface;
use Wasp\Arquitetura\Shared\Dominio\Evento\OuvinteDeEvento;

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
        return $evento->nome() === 'aluno_matriculado';
    }
}