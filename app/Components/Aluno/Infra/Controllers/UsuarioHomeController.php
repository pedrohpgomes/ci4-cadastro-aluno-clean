<?php

declare(strict_types=1);

namespace App\Components\Aluno\Infra\Controllers;

use App\Controllers\BaseController;

final class UsuarioHomeController extends BaseController
{
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
    public function viewHome(): string
    {
        $viewPagina = 'viewHome';
        return $this->viewLayoutUsuario($viewPagina);
    }
}
//class
