<?php

declare(strict_types=1);

namespace App\Components\Aluno\Infra\Controllers;

use App\Components\Aluno\Application\Exceptions\ApplicationException;
use App\Components\Aluno\Application\Interfaces\AlunoRepositoryInterface;
use App\Components\Aluno\Application\Services\AlunoCadastraService;
use App\Components\Aluno\Domain\Entity\AlunoEntity;
use App\Components\Aluno\Infra\Repositories\AlunoRepositoryCodeigniter;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\HTTP\Response;
use CodeIgniter\Session\Session;

final class AlunoCadastraController extends BaseController
{
    private AlunoRepositoryInterface $alunoRepository;
    private AlunoCadastraService $alunoCadastraService;
    private Session $session;

    // ========================================
    public function __construct()
    {
        $this->alunoRepository = new AlunoRepositoryCodeigniter();
        $this->alunoCadastraService = new AlunoCadastraService($this->alunoRepository);
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
    public function viewCadastraAluno($data = []): string
    {
        $viewPagina = 'viewCadastraAluno';
        return $this->viewLayoutUsuario($viewPagina, $data);
    }

    // ========================================
    public function formCadastraAluno(): RedirectResponse | string
    {
        if (!$this->request->getPost()) {
            return redirect()->to(route_to('AlunoListaController.viewListaAlunos'));
        }
        $rules =
        [
            'nome' => 'required',
            'endereco' => 'required',
            'foto' => 'is_image[foto]'
                . '|mime_in[foto,image/jpg,image/jpeg]'
                . '|max_size[foto,1024]'
        ];
        $messages =
        [
            'nome' => [
                'required' => 'O campo nome é obrigatório'
            ],
            'endereco' => [
                'required' => 'O campo endereço é obrigatório'
            ],
            'foto' => [
                'is_image' => 'O arquivo deve ser uma imagem no formato jpg ou jpeg',
                'mime_in'  => 'A imagem deve estar no formato jpg ou jpeg',
                'max_size' => 'A imagem deve ter no máximo 1MB de tamanho'
            ]
        ];

        if (!$this->validate($rules, $messages)) {
            $arrayErros = ['validation' => $this->validator];
            return $this->viewCadastraAluno($arrayErros);
        }
        $alunoNome = $this->request->getPost('nome');
        $alunoEndereco = $this->request->getPost('endereco');
        $foto = $this->request->getFile('foto');
        $alunoFoto = '';
        if (!empty($foto->getName())) {
            $alunoFoto = $foto->getRandomName();
        }
        $alunoNovo = new AlunoEntity();
        $alunoNovo->setNome($alunoNome)
            ->setEndereco($alunoEndereco)
            ->setFoto($alunoFoto);
        try {
            $insertedId = $this->alunoCadastraService->cadastraAluno($alunoNovo);
            if ($foto->isValid() && !$foto->hasMoved()) {
                $foto->move(WRITEPATH . "uploads/alunos/$insertedId", $alunoFoto);
            }
            $this->session->setFlashdata('success', "Aluno cadastrado com sucesso");
            return redirect()->to(route_to('AlunoListaController.viewListaAlunos'));
        } catch (ApplicationException $e) {
            $this->session->setFlashdata('danger', $e->getMessage());
        }
        return redirect()->to(route_to('AlunoCadastraController.viewCadastraAluno'));
    }
}
//class
