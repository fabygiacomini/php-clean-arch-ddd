<?php


namespace Wasp\Arquitetura\Academico\Dominio\Aluno;


use Wasp\Arquitetura\Academico\Dominio\Cpf;

interface AlunoRepositoryInterface
{
    public function adicionar(Aluno $aluno): void;
    public function buscarPorCpf(Cpf $cpf): Aluno;
    /** @return Aluno[] */
    public function buscarTodos(): array;
}