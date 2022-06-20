<?php

declare(strict_types=1);

namespace App\Components\Aluno\Infra\Controllers;

use App\Components\Aluno\Application\Exceptions\ApplicationException;
use App\Components\Aluno\Application\Interfaces\AlunoRepositoryInterface;
use App\Components\Aluno\Application\Services\AlunoExcluiService;
use App\Components\Aluno\Infra\Repositories\AlunoRepositoryCodeigniter;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\Session\Session;

final class AlunoExcluiController extends BaseController
{
    private AlunoRepositoryInterface $alunoRepository;
    private AlunoExcluiService $alunoExcluiService;
    private Session $session;

    // ========================================
    public function __construct()
    {
        $this->alunoRepository = new AlunoRepositoryCodeigniter();
        $this->alunoExcluiService = new AlunoExcluiService($this->alunoRepository);
        //Inicializa a session para enviar uma mensagem do tipo flashdata
        $this->session = \Config\Services::session();
    }

    // ========================================
    public function formExcluiAluno(): RedirectResponse
    {
        //verifica se o metodo que chamou eh post. Caso nao seja, redireciona.
        if (!$this->request->getPost()) {
            return redirect()->to(route_to('AlunoListaController.viewListaAlunos'));
        }
        $id = $this->request->getPost('id');
        try {
            $sucesso = $this->alunoExcluiService->excluiAluno($id);
            $dir = WRITEPATH . "uploads\\alunos\\$id";
            // verifica se existe um diretorio com o id associado ao aluno
            if (is_dir($dir)) {
                array_map('unlink', glob("$dir/*.*"));
                rmdir($dir);
            }
            $this->session->setFlashdata('success', "Aluno excluído com sucesso");
        } catch (ApplicationException $e) {
            $this->session->setFlashdata('danger', $e->getMessage());
        }
        return redirect()->to(route_to('AlunoListaController.viewListaAlunos'));
    }
}
//class
