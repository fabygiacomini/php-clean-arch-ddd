<?php


namespace Wasp\Arquitetura\Academico\Dominio\Aluno;


use Throwable;
use Wasp\Arquitetura\Academico\Dominio\Cpf;

class AdicaoTelefoneAlemDoPermitidoException extends \DomainException
{
    public function __construct(Cpf $cpf)
    {
        parent::__construct("Aluno com CPF $cpf já possui 2 telefones. Não pode adicionar outro.");
    }
}