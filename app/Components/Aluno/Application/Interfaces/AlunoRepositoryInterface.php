<?php

declare(strict_types=1);

namespace App\Components\Aluno\Application\Interfaces;

use App\Components\Aluno\Domain\Entity\AlunoEntity;

interface AlunoRepositoryInterface
{
    /**
     * Insere um aluno na tabela alunos e retorna o ID inserido. Caso não seja possível inserir o novo aluno, retorna -1.
     *
     * @param AlunoEntity $alunoEntity
     * @return integer
     */
    public function insereAluno(AlunoEntity $alunoEntity): int;

    /**
     * Lista os alunos cadastrados. Retorna um array de objetos do tipo AlunoEntity
     *
     * @return array|null
     */
    public function listaAlunos(): ?array;

    /**
     * Exclui o aluno pelo id informado. Caso não seja possível excluir, lanca uma DatabaseException.
     *
     * @param [type] $id
     * @return boolean
     */
    public function excluiAluno($id): bool;

    /**
     * Atualiza o aluno pelo id ($alunoAtualizado->getId()). Caso não seja possível, lança uma ReflectionException.
     *
     * @param AlunoEntity $alunoAtualizado
     * @return boolean
     */
    public function editaAluno(AlunoEntity $alunoAtualizado): bool;

    /**
     * Busca um aluno pelo id informado. Retorna um objeto do tipo AlunoEntity ou null, caso não encontre.
     *
     * @param integer $id
     * @return AlunoEntity|null
     */
    public function buscaAlunoById(int $id): ?AlunoEntity;
}
//interface
