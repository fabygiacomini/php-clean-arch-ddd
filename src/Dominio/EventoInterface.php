<?php

namespace Wasp\Arquitetura\Dominio;

interface EventoInterface
{
    public function momento(): \DateTimeImmutable;
}