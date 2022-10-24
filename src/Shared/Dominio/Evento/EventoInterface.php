<?php

namespace Wasp\Arquitetura\Shared\Dominio\Evento;

interface EventoInterface extends \JsonSerializable
{
    public function momento(): \DateTimeImmutable;
    public function nome(): string;
}