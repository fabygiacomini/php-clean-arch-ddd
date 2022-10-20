<?php


namespace Wasp\Arquitetura\Dominio\Aluno;


use Throwable;
use Wasp\Arquitetura\Dominio\Cpf;

class AlunoNaoEncontradoException extends \DomainException
{
    public function __construct(Cpf $cpf)
    {
        parent::__construct("Aluno com CPF $cpf não encontrado.");
    }
}