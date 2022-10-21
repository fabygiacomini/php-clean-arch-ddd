<?php


use Wasp\Arquitetura\Dominio\Aluno\CifradorDeSenhaInterface;

class CifradorDeSenhaMd5 implements CifradorDeSenhaInterface
{

    public function cifrar(string $senha): string
    {
        return md5($senha);
    }

    public function verificar(string $senhaEmTexto, string $senhaCifrada): bool
    {
        return md5($senhaEmTexto) === $senhaCifrada;
    }
}