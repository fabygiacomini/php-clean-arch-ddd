<?php

namespace Wasp\Arquitetura\Shared\Dominio\Evento;

interface EventoInterface
{
    public function momento(): \DateTimeImmutable;
}