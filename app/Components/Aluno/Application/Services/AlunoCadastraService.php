<?php

declare(strict_types=1);

namespace App\Components\Aluno\Application\Services;

use App\Components\Aluno\Application\Interfaces\AlunoRepositoryInterface;
use App\Components\Aluno\Application\Exceptions\ApplicationException;
use App\Components\Aluno\Domain\Entity\AlunoEntity;

final class AlunoCadastraService
{
    private $alunoRepository;

    // ===================================
    public function __construct(AlunoRepositoryInterface $alunoRepository)
    {
        $this->alunoRepository = $alunoRepository;
    }

    // ===================================
    /**
     * Insere o aluno na tabela alunos. Caso não consiga, lança uma ApplicationException
     *
     * @param AlunoEntity $alunoNovo
     * @return integer
     */
    public function cadastraAluno(AlunoEntity $alunoNovo): int
    {
        $insertedId = $this->alunoRepository->insereAluno($alunoNovo);
        if ($insertedId == -1) {//Não foi possivel inserir o aluno na tabela
            throw new ApplicationException('Erro ao inserir aluno');
        }
        return $insertedId;
    }
}
//class
