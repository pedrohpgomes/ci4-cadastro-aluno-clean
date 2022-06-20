<?php

declare(strict_types=1);

namespace App\Components\Aluno\Application\Services;

use App\Components\Aluno\Application\Exceptions\ApplicationException;
use App\Components\Aluno\Application\Interfaces\AlunoRepositoryInterface;
use CodeIgniter\Database\Exceptions\DatabaseException;

final class AlunoExcluiService
{
    private $alunoRepository;

    // ===================================
    public function __construct(AlunoRepositoryInterface $alunoRepository)
    {
        $this->alunoRepository = $alunoRepository;
    }

    // ===================================
    /**
     * Exclui o aluno pelo id informado. Caso não seja possível exlcuir, lanca uma ApplicationException.
     *
     * @param [type] $id
     * @return boolean
     */
    public function excluiAluno($id): bool
    {
        try {
            return $this->alunoRepository->excluiAluno($id);
        } catch (DatabaseException $e) {
            throw new ApplicationException('Erro ao excluir aluno');
        }
    }
}
//class
