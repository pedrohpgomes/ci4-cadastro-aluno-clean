<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Components\Aluno\Application\Interfaces\AlunoRepositoryInterface;
use App\Components\Aluno\Application\Services\AlunoCadastraService;
use App\Components\Aluno\Application\Services\AlunoInsereService;
use App\Components\Aluno\Domain\Entity\AlunoEntity;
use App\Components\Aluno\Infra\Repositories\AlunoRepositoryCodeigniter;
use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use Config\Database;
use Tests\Support\Models\AlunoTest;

final class AlunoInsereServiceTest extends CIUnitTestCase
{
    use DatabaseTestTrait;

    private AlunoRepositoryInterface $alunoRepository;
    private $alunoCadastraService;

    // ===================================
    // For Migrations
    protected $migrate     = true;
    protected $migrateOnce = false;
    protected $refresh     = true;
    protected $namespace   = 'Tests\Support';

    // For Seeds
    protected $seedOnce = false;
    protected $seed     = 'AlunosSeeder';
    protected $basePath = '';

    // ===================================
    protected function setUp(): void
    {
        parent::setUp();
        //$seeder = Database::seeder();
        //$seeder->call('Tests\Support\Database\Seeds\AlunosSeederTest');
        $this->alunoRepository = new AlunoRepositoryCodeigniter();
        $this->alunoCadastraService = new AlunoCadastraService($this->alunoRepository);
    }

    // ===================================
    public function testVerificaSeAlunoEhInseridoNaTabelaAlunos()
    {
        $alunoEntity = new AlunoEntity();
        $alunoEntity->setNome('Goku')
            ->setEndereco('Rua dos Sayajins, 333, planeta Vegeta')
            ->setFoto('');
        $insertedId = $this->alunoRepository->insereAluno($alunoEntity);
        $alunoModelTest = new AlunoTest();
        $insertedId = $alunoModelTest->insert($alunoEntity->toArray());
        echo $insertedId;
    }
}
//class
