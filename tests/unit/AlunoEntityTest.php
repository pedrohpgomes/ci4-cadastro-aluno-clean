<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Components\Aluno\Domain\Entity\AlunoEntity;
use CodeIgniter\Test\CIUnitTestCase;

final class AlunoEntityTest extends CIUnitTestCase
{
    // ===================================
    public function testAlunoEntitySemFoto()
    {
        $alunoEntity = new AlunoEntity();
        $alunoEntity->setId(200)
            ->setNome('Goku')
            ->setEndereco('Rua dos Sayajins, 333, planeta Vegeta');
        $this->assertEquals($alunoEntity->getId(), 200);
    }
}
//class
