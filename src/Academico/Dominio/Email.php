<?php


namespace Wasp\Arquitetura\Academico\Dominio;

// VO
class Email implements \Stringable
{
    private string $endereco; // identificador único da entidade Email

    public function __construct(string $endereco)
    {
        if (filter_var($endereco, FILTER_VALIDATE_EMAIL) === false) {
            throw new \InvalidArgumentException(
                "Endereço de e-mail inválido"
            );
        }
        $this->endereco = $endereco;
    }

    public function __toString(): string
    {
        return $this->endereco;
    }
}