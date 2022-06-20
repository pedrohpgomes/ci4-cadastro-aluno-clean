<?php

declare(strict_types=1);

namespace App\Components\Aluno\Domain\Entity;

use App\Components\Aluno\Domain\ValueObject\Endereco;

final class AlunoEntity
{
    private int $id;

    private string $nome;

    private string $endereco;

    private string $foto;

    // ==================================
    /**
     * transforma de objeto para array
     *
     * @return array
     */
    public function toArray(): array
    {
        $id = '';
        if (isset($this->id)) {
            $id = $this->getId();
        }
        $alunoArray = [
            'id' => isset($this->id) ? $this->id : '',
            'nome' => $this->getNome(),
            'endereco' => $this->getEndereco(),
            'foto' => $this->getFoto()
        ];
        return $alunoArray;
    }

    // ==================================

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of nome
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set the value of nome
     *
     * @return  self
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get the value of endereco
     */
    public function getEndereco()
    {
        return $this->endereco;
    }

    /**
     * Set the value of endereco
     *
     * @return  self
     */
    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;

        return $this;
    }

    /**
     * Get the value of foto
     */
    public function getFoto()
    {
        return $this->foto;
    }

    /**
     * Set the value of foto
     *
     * @return  self
     */
    public function setFoto($foto)
    {
        $this->foto = $foto;

        return $this;
    }
}
//class
