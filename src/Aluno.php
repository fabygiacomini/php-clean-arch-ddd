<?php


namespace Wasp\Arquitetura;

// Entity
class Aluno
{
    private Cpf $cpf;
    private string $nome;
    private Email $email;
    private array $telefones;

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
    }

    public function adicionarTelefone(string $ddd, string $numero): self
    {
        $this->telefones[] = new Telefone($ddd, $numero);
        return $this;
    }
}