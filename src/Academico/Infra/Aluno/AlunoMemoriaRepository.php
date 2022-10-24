<?php

namespace Wasp\Arquitetura\Academico\Infra\Aluno;

use Wasp\Arquitetura\Academico\Dominio\Aluno\Aluno;
use Wasp\Arquitetura\Academico\Dominio\Aluno\AlunoNaoEncontradoException;
use Wasp\Arquitetura\Academico\Dominio\Aluno\AlunoRepositoryInterface;
use Wasp\Arquitetura\Shared\Dominio\Cpf;

class AlunoMemoriaRepository implements AlunoRepositoryInterface
{
    private array $alunos = [];

    public function adicionar(Aluno $aluno): void
    {
        $this->alunos[] = $aluno;
    }

    public function buscarPorCpf(Cpf $cpf): Aluno
    {
        $alunosFiltrados = array_filter(
            $this->alunos,
            fn (Aluno $aluno) => $aluno->cpf() == $cpf
        );

        if (count($alunosFiltrados) === 0) {
            throw new AlunoNaoEncontradoException($cpf);
        }

        if (count($alunosFiltrados) > 1) {
            throw new \Exception("Foram encontrados mais de um aluno com o mesmo CPF.");
        }

        return $alunosFiltrados[0];
    }

    public function buscarTodos(): array
    {
        return $this->alunos;
    }
}