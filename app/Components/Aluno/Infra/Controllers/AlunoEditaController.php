<?php

declare(strict_types=1);

namespace App\Components\Aluno\Infra\Controllers;

use App\Components\Aluno\Application\Dto\AlunoEditaDTO;
use App\Components\Aluno\Application\Exceptions\ApplicationException;
use App\Components\Aluno\Application\Interfaces\AlunoRepositoryInterface;
use App\Components\Aluno\Application\Services\AlunoEditaService;
use App\Components\Aluno\Domain\Entity\AlunoEntity;
use App\Components\Aluno\Infra\Repositories\AlunoRepositoryCodeigniter;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\Session\Session;

final class AlunoEditaController extends BaseController
{
    private AlunoRepositoryInterface $alunoRepository;
    private AlunoEditaService $alunoEditaService;
    private Session $session;

    // ========================================
    public function __construct()
    {
        $this->alunoRepository = new AlunoRepositoryCodeigniter();
        $this->alunoEditaService = new AlunoEditaService($this->alunoRepository);
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
    public function viewEditaAluno(string $id, $arrayErros = []): string | RedirectResponse
    {
        $id = (int) $id;
        $aluno = $this->alunoRepository->buscaAlunoById($id);
        if ($aluno == null) {
            $this->session->setFlashdata('danger', 'Aluno não encontrado');
            return redirect()->to(route_to('AlunoListaController.viewListaAlunos'));
        }
        //$id = $this->request->getPost('id');
        $viewPagina = 'viewEditaAluno';
        $data = [
        'aluno' => $aluno
        ];
        if (isset($arrayErros['validation'])) {
            $data['validation'] = $arrayErros['validation'];
        }
        return $this->viewLayoutUsuario($viewPagina, $data);
    }

    // ========================================
    public function formEditaAluno(): RedirectResponse | string
    {
        dd(isset($foto2));
        if (!$this->request->getPost()) {
            return redirect()->to(route_to('AlunoListaController.viewListaAlunos'));
        }
        $id = (int) $this->request->getPost('id');
        if (!isset($id)) {
            $this->session->setFlashdata('danger', "aluno não encontrado");
            return redirect()->to(route_to('AlunoListaController.viewListaAlunos'));
        }
        $rules =
        [
            'id' => 'required',
            'nome' => 'required',
            'endereco' => 'required',
            'foto' => 'is_image[foto]'
                . '|mime_in[foto,image/jpg,image/jpeg]'
                . '|max_size[foto,1024]'
        ];
        $messages =
        [
            'id' => [
                'required' => 'O id é obrigatório'
            ],
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
            return $this->viewEditaAluno((string)$id, $arrayErros);
        }
        $alunoDB = $this->alunoRepository->buscaAlunoById($id);
        $alunoNome = $this->request->getPost('nome');
        $alunoEndereco = $this->request->getPost('endereco');
        $foto = $this->request->getFile('foto');
        $alunoFoto = $foto->getRandomName();
        $alunoEditaDTO = new AlunoEditaDTO($alunoNome, $alunoEndereco, $alunoFoto);
        $alunoAtualizado = new AlunoEntity();
        $alunoAtualizado->setNome($alunoNome)
            ->setEndereco($alunoEndereco)
            ->setFoto($alunoFoto)
            ->setId($id);
        try {
            if ($foto->isValid() && !$foto->hasMoved()) {
                $dir = WRITEPATH . "uploads\\alunos\\$id";
                $fotoAntiga = $alunoDB->getFoto();
                if ($fotoAntiga != $alunoFoto && ($fotoAntiga != null || $fotoAntiga != '')) {
                    $dirFotoAntiga = $dir . '\\' . $fotoAntiga;
                    if (file_exists($dirFotoAntiga)) {
                        unlink($dirFotoAntiga);
                    }
                }
                $foto->move($dir, $alunoFoto);
            }
            $this->alunoEditaService->editaAluno($alunoAtualizado);
            $this->session->setFlashdata('success', "Aluno atualizado com sucesso");
            return redirect()->to(route_to('AlunoListaController.viewListaAlunos'));
        } catch (ApplicationException $e) {
            $this->session->setFlashdata('danger', $e->getMessage());
        }
        return redirect()->to(route_to('AlunoEditaController . viewEditaAluno'));
    }
}
        //class
