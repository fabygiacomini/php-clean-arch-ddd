<?php


namespace Wasp\Arquitetura\Dominio;

// VO
class Cpf implements \Stringable
{
    private string $numero;

    public function __construct(string $numero)
    {
        $this->setNumero($numero);
    }

    // clause guard
    private function setNumero(string $numero): void
    {
        $opcoes = [
            'options' => [
                'regexp' => "/\d{3}\.\d{3}\.\d{3}\-\d{2}/"
            ]
        ];

        if (filter_var($numero, FILTER_VALIDATE_REGEXP, $opcoes) === false) {
            throw new \InvalidArgumentException("CPF no formato inválido");
        }

        $this->numero = $numero;
    }

    public function __toString(): string
    {
        return $this->numero;
    }
}