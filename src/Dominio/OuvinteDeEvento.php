<?php


namespace Wasp\Arquitetura\Dominio;


abstract class OuvinteDeEvento
{
    public function processa(EventoInterface $evento)
    {
        if ($this->sabeProcessar($evento)) {
            $this->reageAo($evento);
        }
    }

    abstract public function sabeProcessar(EventoInterface $evento): bool;
    abstract public function reageAo(EventoInterface $evento): void;
}