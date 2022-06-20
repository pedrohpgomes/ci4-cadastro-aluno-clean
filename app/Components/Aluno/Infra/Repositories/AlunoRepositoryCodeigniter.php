<?php

declare(strict_types=1);

namespace App\Components\Aluno\Infra\Repositories;

use App\Components\Aluno\Application\Dto\AlunoEditaDTO;
use App\Components\Aluno\Application\Interfaces\AlunoRepositoryInterface;
use App\Components\Aluno\Domain\Entity\AlunoEntity;
use App\Models\Aluno;
use ReflectionException;

final class AlunoRepositoryCodeigniter implements AlunoRepositoryInterface
{
    public function insereAluno(AlunoEntity $alunoEntity): int
    {
        $alunoModel = new Aluno();
        $newAlunoArray = [
            'nome' => $alunoEntity->getNome(),
            'endereco' => $alunoEntity->getEndereco(),
            'foto' => $alunoEntity->getFoto()
        ];
        try {
            $insertedId = $alunoModel->insert($newAlunoArray);
            if ($insertedId > 0) {
                return $insertedId;
            }
            return -1;
        } catch (ReflectionException $e) {
            return -1;
        }
    }

    // ==========================================
    public function listaAlunos(): ?array
    {
        $arrayAlunoEntity = [];
        $alunoModel = new Aluno();
        $alunos = $alunoModel->findAll();

        foreach ($alunos as $aluno) {
            $alunoEntity = new AlunoEntity();
            $alunoEntity->setId((int)$aluno->id);
            $alunoEntity->setEndereco($aluno->endereco);
            $alunoEntity->setNome($aluno->nome);
            $alunoEntity->setFoto($aluno->foto);
            array_push($arrayAlunoEntity, $alunoEntity);
        }
        return $arrayAlunoEntity;
    }

    // ==========================================
    public function excluiAluno($id): bool
    {
        $alunoModel = new Aluno();
        return $alunoModel->delete($id);
    }

    // ==========================================
    public function editaAluno(AlunoEditaDTO $alunoEditaDTO, int $alunoId): bool
    {
        $alunoModel = new Aluno();
        $aluno = [
            'nome' => $alunoEditaDTO->nome,
            'endereco' => $alunoEditaDTO->endereco
        ];
        if (isset($alunoEditaDTO->foto)) {
            $aluno['foto'] = $alunoEditaDTO->foto;
        }
        return $alunoModel->update($alunoId, $aluno);
    }

    // ==========================================
    public function buscaAlunoById(int $id): ?AlunoEntity
    {
        $alunoModel = new Aluno();
        $aluno = $alunoModel->find($id);
        if (isset($aluno->id)) {
            $alunoEntity = new AlunoEntity();
            $alunoEntity->setId((int)$aluno->id);
            $alunoEntity->setEndereco($aluno->endereco);
            $alunoEntity->setNome($aluno->nome);
            $alunoEntity->setFoto($aluno->foto);
            return $alunoEntity;
        }
        return null;
    }
}
//class
