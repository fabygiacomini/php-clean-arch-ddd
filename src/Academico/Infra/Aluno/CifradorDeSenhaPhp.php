<?php

namespace Wasp\Arquitetura\Academico\Infra\Aluno;

use Wasp\Arquitetura\Academico\Dominio\Aluno\CifradorDeSenhaInterface;

class CifradorDeSenhaPhp implements CifradorDeSenhaInterface
{

    public function cifrar(string $senha): string
    {
        return password_hash($senha, PASSWORD_ARGON2ID);
    }

    public function verificar(string $senhaEmTexto, string $senhaCifrada): bool
    {
        return password_verify($senhaEmTexto, $senhaCifrada);
    }
}