<?php

declare(strict_types=1);

namespace App\Components\Aluno\Application\Services;

use App\Components\Aluno\Application\Interfaces\AlunoRepositoryInterface;
use App\Components\Aluno\Application\Exceptions\ApplicationException;
use App\Components\Aluno\Domain\Entity\AlunoEntity;
use CodeIgniter\Database\Exceptions\DatabaseException;

final class AlunoListaService
{
    private $alunoRepository;

    // ===================================
    public function __construct(AlunoRepositoryInterface $alunoRepository)
    {
        $this->alunoRepository = $alunoRepository;
    }

    // ===================================
    /**
     * Retorna uma lista com os alunos cadastrado. Cada aluno é um objeto do tipo AlunoEntity. Caso não seja possível buscar os alunos, lança uma ApplicationException.
     *
     * @return array|null
     */
    public function listaAlunos(): ?array
    {
        try {
            $listaAlunos = $this->alunoRepository->listaAlunos();
        } catch (DatabaseException $e) {
            throw new ApplicationException('Erro ao listar alunos. Tente novamente mais tarde');
        }
        return $listaAlunos;
    }
}
//class
