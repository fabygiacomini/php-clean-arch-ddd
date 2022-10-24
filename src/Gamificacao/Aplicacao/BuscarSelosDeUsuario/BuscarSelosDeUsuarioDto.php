<?php

class BuscarSelosDeUsuarioDto
{
    public string $cpfAluno;

    public function __construct(string $cpfAluno)
    {
        $this->cpfAluno = $cpfAluno;
    }
}