<?php


use Wasp\Arquitetura\Gamificacao\Dominio\Selo\SeloRepositoryInterface;
use Wasp\Arquitetura\Shared\Dominio\Cpf;

// use case
class BuscarSelosDeUsuario
{
    private SeloRepositoryInterface $seloRepository;

    public function __construct(SeloRepositoryInterface $seloRepository)
    {
        $this->seloRepository = $seloRepository;
    }

    public function execute(BuscarSelosDeUsuarioDto $dados)
    {
        $cpfAluno = new Cpf($dados->cpfAluno);
        return $this->seloRepository->selosDeAlunoComCpf($cpfAluno);
    }
}