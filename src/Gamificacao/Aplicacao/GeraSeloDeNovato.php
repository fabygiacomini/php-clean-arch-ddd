<?php

use Wasp\Arquitetura\Gamificacao\Dominio\Selo\Selo;
use Wasp\Arquitetura\Gamificacao\Dominio\Selo\SeloRepositoryInterface;
use Wasp\Arquitetura\Shared\Dominio\Evento\EventoInterface;
use Wasp\Arquitetura\Shared\Dominio\Evento\OuvinteDeEvento;

class GeraSeloDeNovato extends OuvinteDeEvento
{
    private SeloRepositoryInterface $repository;

    public function __construct(SeloRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function sabeProcessar(EventoInterface $evento): bool
    {
        return $evento->nome() === 'aluno_matriculado'; // diminuir acoplamento com a classe AlunoMatriculado
    }

    public function reageAo(EventoInterface $evento): void
    {
        $data = $evento->jsonSerialize();
        $cpf = $data['cpfAluno'];

        $selo = new Selo($cpf, 'Novato');
        $this->repository->adiciona($selo);
    }
}