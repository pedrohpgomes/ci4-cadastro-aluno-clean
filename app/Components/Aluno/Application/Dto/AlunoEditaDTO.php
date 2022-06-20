<?php

declare(strict_types=1);

namespace App\Components\Aluno\Application\Dto;

final class AlunoEditaDTO
{
    public function __construct(string $nome, string $endereco, string $foto = '')
    {
        $this->nome = $nome;
        $this->endereco = $endereco;
        if ($foto != '') {
            $this->foto = $foto;
        }
    }
}
//class
