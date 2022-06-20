<div class="col-12 mt-3">
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Cadastra Novo Aluno</h2>
        </div><!-- /.card-header -->              
        <div class="card-body">

            <!-- Validation Errors -->
            <?php if (isset($validation)) : ?>
                <div class="d-flex justify-content-center text-danger">
                    <?= $validation->listErrors()?>
                </div>
            <?php endif; ?>
            <form action="<?=route_to('AlunoCadastraController.formCadastraAluno')?>" method="post" enctype="multipart/form-data" id="formCadastraAluno">
                                
                <!-- nome -->
                <div class="row">
                    <div class="form-group col-10 col-md-8 col-xl-6">
                        <label for="nome"><span class="text-danger">*</span> Nome</label>
                        <input type="text" name="nome" id="nome" class="form-control" value=""  />
                    </div>
                </div>

                <!-- endereco -->
                <div class="row">
                    <div class="form-group col-12 col-md-10 col-xl-8">
                        <label for="endereco"><span class="text-danger">*</span> Endereço</label>
                        <input type="text" name="endereco" id="endereco" class="form-control" value="" required />
                    </div>
                </div>
                <br>
                <!-- foto -->
                <div class="row">
                    <div class="form-group col-12 col-md-10 col-xl-8">
                        <label>Foto (opcional): </label>
                        <input type="file" name="foto" id="foto" class="" />
                        <p class="text-danger">Obs: Tamanho máximo de 1MB. Extensão permitida: jpg e jpeg</p>
                    </div>
                </div>
            </form>

             <!-- Botoes -->
            <div class="row">
                <div class="col-6">
                    <a href="<?=route_to('AlunoListaController.viewListaAlunos')?>" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Listar Alunos</a>
                </div>
                <div class="col-6 d-flex flex-row-reverse">
                    <button type="submit" class="btn btn-primary" form="formCadastraAluno"><i class="fa fa-save"></i> Cadastrar</button>
                </div>
            </div>
                
            
        </div>
    </div>
</div>
