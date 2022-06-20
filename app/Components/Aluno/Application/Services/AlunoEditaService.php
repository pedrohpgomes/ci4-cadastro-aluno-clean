<?php

declare(strict_types=1);

namespace App\Components\Aluno\Application\Services;

use App\Components\Aluno\Application\Interfaces\AlunoRepositoryInterface;
use App\Components\Aluno\Application\Exceptions\ApplicationException;
use App\Components\Aluno\Domain\Entity\AlunoEntity;
use ReflectionException;

final class AlunoEditaService
{
    private $alunoRepository;

    // ===================================
    public function __construct(AlunoRepositoryInterface $alunoRepository)
    {
        $this->alunoRepository = $alunoRepository;
    }

    /**
     * Grava o registro do aluno atualizado pelo id. Caso não seja possível lança uma ApplicationException
     *
     * @param AlunoEntity $alunoAtualizado
     * @return boolean
     */
    public function editaAluno(AlunoEntity $alunoAtualizado): bool
    {
        try {
            return $this->alunoRepository->editaAluno($alunoAtualizado);
        } catch (ReflectionException $e) {
            throw new ApplicationException('Erro ao atualizar aluno');
        }
    }
}
//class
