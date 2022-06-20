<?php

namespace Config;

use App\Components\Aluno\Infra\Controllers\AlunoCadastraController;
use App\Components\Aluno\Infra\Controllers\AlunoExcluiController;
use App\Components\Aluno\Infra\Controllers\AlunoListaController;
use App\Components\Aluno\Infra\Controllers\AlunoEditaController;
use App\Components\Aluno\Infra\Controllers\UsuarioHomeController;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
//$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
//$routes->get('/', 'Home::index');
$routes->get('/', [UsuarioHomeController::class, 'viewHome']);
$routes->get('/home', [UsuarioHomeController::class, 'viewHome'], ['as' => 'UsuarioHomeController.viewHome']);
$routes->get('/aluno', [UsuarioHomeController::class, 'viewHome']);
$routes->get('/aluno/lista-alunos', [AlunoListaController::class, 'viewListaAlunos'], ['as' => 'AlunoListaController.viewListaAlunos']);
$routes->get('/aluno/foto/(:num)', [AlunoListaController::class, 'getFoto/$1'], ['as' => 'AlunoListaController.getFoto']);
$routes->get('/aluno/cadastra-aluno', [AlunoCadastraController::class, 'viewCadastraAluno'], ['as' => 'AlunoCadastraController.viewCadastraAluno']);
$routes->match(['get','post'], '/aluno/form-cadastra-aluno', [AlunoCadastraController::class, 'formCadastraAluno'], ['as' => 'AlunoCadastraController.formCadastraAluno']);
$routes->match(['get','post'], '/aluno/form-exclui-aluno', [AlunoExcluiController::class, 'formExcluiAluno'], ['as' => 'AlunoExcluiController.formExcluiAluno']);
//$routes->post('/aluno/edita-aluno', [AlunoEditaController::class, 'viewEditaAluno'], ['as' => 'AlunoEditaController.viewEditaAluno']);
$routes->get('/aluno/edita-aluno/(:num)', [AlunoEditaController::class, 'viewEditaAluno/$1'], ['as' => 'AlunoEditaController.viewEditaAluno']);
$routes->match(['get','post'], 'aluno/form-edita-aluno', [AlunoEditaController::class, 'formEditaAluno'], ['as' => 'AlunoEditaController.formEditaAluno']);
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
