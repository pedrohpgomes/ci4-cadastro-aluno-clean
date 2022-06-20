<?php

declare(strict_types=1);

namespace App\Components\Aluno\Infra\Controllers;

use App\Components\Aluno\Application\Exceptions\ApplicationException;
use App\Components\Aluno\Application\Interfaces\AlunoRepositoryInterface;
use App\Components\Aluno\Application\Services\AlunoListaService;
use App\Components\Aluno\Infra\Repositories\AlunoRepositoryCodeigniter;
use App\Controllers\BaseController;
use CodeIgniter\Session\Session;
use CodeIgniter\View\View;

final class AlunoListaController extends BaseController
{
    private AlunoRepositoryInterface $alunoRepository;
    private AlunoListaService $alunoListaService;
    private Session $session;

    // ========================================
    public function __construct()
    {
        $this->alunoRepository = new AlunoRepositoryCodeigniter();
        $this->alunoListaService = new AlunoListaService($this->alunoRepository);
        $this->session = \Config\Services::session();
    }

    // ========================================
    public function viewLayoutUsuario(string $viewPagina, array $data = []): string
    {
        return view('template/usuario/header')
            . view('template/usuario/topbar')
            . view('template/usuario/sidebar')
            . view('template/usuario/pre-content')
            . view('usuario/' . $viewPagina, $data)
            . view('template/usuario/pos-content')
            . view('template/usuario/footer')
            . view('template/usuario/scripts-body');
    }

    // ========================================
    public function viewListaAlunos(): string
    {
        $arrayAlunosEntity = $this->listaAlunos();
        $data = [
            'alunos' => $arrayAlunosEntity
        ];
        $pagina = 'viewListaAluno';
        return $this->viewLayoutUsuario($pagina, $data);
    }

    // ========================================
    /**
     * Retorna uma lista com os alunos cadastrados. Cada Aluno é um objeto do tipo AlunoEntity
     *
     * @return void
     */
    public function listaAlunos(): ?array
    {
        $listaAlunos = [];
        try {
            $listaAlunos = $this->alunoListaService->listaAlunos();
            //return $listaAlunos;
        } catch (ApplicationException $e) {
            $this->session->setFlashdata('danger', $e->getMessage());
        } finally {
            return $listaAlunos;
        }
    }

    // ========================================
    /**
     * Exibe a imagem. Caso não tenha foto, exibe a string 'sem foto'. Caso o id não exista, exibe a mensagem 'aluno não encontrado'.
     *
     * @param integer $id
     * @return string
     */
    public function getFoto(int $id): string
    {
        $id = $id;
        $alunoEntity = $this->alunoRepository->buscaAlunoById($id);
        if (!isset($alunoEntity)) {
            return 'aluno não encontrado';
        }
        $nomeFoto = $alunoEntity->getFoto();
        if ($nomeFoto == null || $nomeFoto == '') {
            return 'sem foto';
        }
        $filename = WRITEPATH . "uploads\\alunos\\$id\\" .  $nomeFoto;
        if (!file_exists($filename)) {
            return 'arquivo movido ou deletado';
        }
        $imgInfo = getimagesize($filename);
        $this->response->setHeader('Content-Type', $imgInfo['mime']);
        return file_get_contents($filename);
    }
}
//class
