<?php


namespace Wasp\Arquitetura\Dominio\Aluno;


use Wasp\Arquitetura\Dominio\Cpf;

interface AlunoRepositoryInterface
{
    public function adicionar(Aluno $aluno): void;
    public function buscarPorCpf(Cpf $cpf): Aluno;
    /** @return Aluno[] */
    public function buscarTodos(): array;
}