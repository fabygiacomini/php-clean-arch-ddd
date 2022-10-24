<?php

namespace Wasp\Arquitetura\Academico\Dominio;

interface EventoInterface
{
    public function momento(): \DateTimeImmutable;
}