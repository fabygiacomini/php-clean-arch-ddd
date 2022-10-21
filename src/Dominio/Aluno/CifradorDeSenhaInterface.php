<?php


namespace Wasp\Arquitetura\Dominio\Aluno;


interface CifradorDeSenhaInterface
{
    public function cifrar(string $senha): string;

    public function verificar(string $senhaEmTexto, string $senhaCifrada): bool;
}