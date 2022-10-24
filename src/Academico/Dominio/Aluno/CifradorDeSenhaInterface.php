<?php


namespace Wasp\Arquitetura\Academico\Dominio\Aluno;


interface CifradorDeSenhaInterface
{
    public function cifrar(string $senha): string;

    public function verificar(string $senhaEmTexto, string $senhaCifrada): bool;
}