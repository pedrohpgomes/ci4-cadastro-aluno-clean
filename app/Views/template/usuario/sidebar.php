<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <div class="">
        <a href="<?=route_to('AlunoListaController.viewListaAlunos') ?>" class="brand-link" title="ir para a home">
        <i class="fas fa-home fa-lg brand-image mt-1"></i> 
        <span class="brand-text">Home</span>
        </a>
    </div>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->


                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-graduation-cap"></i>
                        <p>
                            Alunos
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="margin-left:10px">
                        <li class="nav-item">
                            <a href="<?=route_to('AlunoListaController.viewListaAlunos')?>" class="nav-link">
                                <i class="fa fa-list nav-icon"></i>
                                <p>Listar</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=route_to('AlunoCadastraController.viewCadastraAluno')?>" class="nav-link">
                                <i class="fa fa-user-plus nav-icon"></i>
                                <p>Cadastrar</p>
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
