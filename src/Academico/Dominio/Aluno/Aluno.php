<?php


namespace Wasp\Arquitetura\Academico\Dominio\Aluno;

// Entity
use Wasp\Arquitetura\Shared\Dominio\Cpf;
use Wasp\Arquitetura\Academico\Dominio\Email;

class Aluno
{
    private Cpf $cpf;
    private string $nome;
    private Email $email;
    private array $telefones;
    private string $senha;

    // named constructor
    public static function comCpfNomeEEmail(string $cpf, string $nome, string $email): self
    {
        return new Aluno(
            new Cpf($cpf),
            $nome,
            new Email($email)
        );
    }

    public function __construct(Cpf $cpf, string $nome, Email $email)
    {
        $this->cpf = $cpf;
        $this->nome = $nome;
        $this->email = $email;
        $this->telefones = [];
    }

    public function adicionarTelefone(string $ddd, string $numero): self
    {
        // Invariância: regra entre duas classes (Aluno-Telefone)
        if (count($this->telefones) === 2) {
            throw new AdicaoTelefoneAlemDoPermitidoException($this->cpf);
        }
        $this->telefones[] = new Telefone($ddd, $numero);
        return $this;
    }

    public function cpf(): Cpf
    {
        return $this->cpf;
    }

    public function nome(): string
    {
        return $this->nome;
    }

    public function email(): string
    {
        return $this->email;
    }

    /** @return Telefone[] */
    public function telefones(): array
    {
        return $this->telefones;
    }
}