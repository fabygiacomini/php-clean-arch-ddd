<?php


namespace Wasp\Arquitetura\Academico\Dominio;


class PublicadorDeEvento
{
    private array $ouvintes = [];

    public function adicionarOuvinte(OuvinteDeEvento $ouvinte): void
    {
        $this->ouvintes[] = $ouvinte;
    }

    public function publicar(EventoInterface $evento): void
    {
        /** @var OuvinteDeEvento $ouvinte */
        foreach ($this->ouvintes as $ouvinte) {
            $ouvinte->processa($evento);
        }
    }
}