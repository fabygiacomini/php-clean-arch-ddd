<?php


namespace Wasp\Arquitetura\Academico\Dominio\Aluno;


use Throwable;
use Wasp\Arquitetura\Shared\Dominio\Cpf;

class AlunoNaoEncontradoException extends \DomainException
{
    public function __construct(Cpf $cpf)
    {
        parent::__construct("Aluno com CPF $cpf não encontrado.");
    }
}