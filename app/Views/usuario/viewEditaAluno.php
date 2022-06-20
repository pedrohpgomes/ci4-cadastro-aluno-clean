<div class="col-12 mt-3">
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Edita Aluno</h2>
        </div><!-- /.card-header -->              
        <div class="card-body">

            <!-- Validation Errors -->
            <?php if (isset($validation)) : ?>
                <div class="d-flex justify-content-center text-danger">
                    <?= $validation->listErrors()?>
                </div>
            <?php endif; ?>

            <!-- Codigo -->
            <div class="row">
                <div class="form-group col-10 col-md-8 col-xl-6">
                    <label for="codigo">Codigo</label>
                    <input type="text" name="codigo" id="codigo" class="form-control" value="<?=$aluno->getId() ?? 'indefinido' ?>" readonly disabled />
                </div>
            </div>

            <form action="<?=route_to('AlunoEditaController.formEditaAluno')?>" method="post" enctype="multipart/form-data" id="formEditaAluno">                

                <!-- nome -->
                <div class="row">
                    <div class="form-group col-10 col-md-8 col-xl-6">
                        <label for="nome"><span class="text-danger">*</span> Nome</label>
                        <input type="text" name="nome" id="nome" class="form-control" value="<?=$aluno->getNome() ?? 'indefinido' ?>"" required />
                    </div>
                </div>
                <!-- endereco -->
                <div class="row">
                    <div class="form-group col-12 col-md-10 col-xl-8">
                        <label for="endereco"><span class="text-danger">*</span> Endereço</label>
                        <input type="text" name="endereco" id="endereco" class="form-control" value="<?=$aluno->getEndereco() ?? 'indefinido' ?>" required />
                    </div>
                </div>
                <!-- foto -->
                <div class="row">
                    <div class="col-12">
                        <?php if ($aluno->getFoto() != null || $aluno->getFoto() != '') { ?>
                            <a href="<?=base_url('aluno/foto/' . $aluno->getId())?>" target="_blank"><img class="foto" src="<?=base_url('aluno/foto/' . $aluno->getId()) ?>" alt="foto" style="max-width:100px;max-height:100px;"></a>
                        <?php } else {
                            echo 'sem foto cadastrada';
                        } ?>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-12 col-md-10 col-xl-8">
                        <label>Alterar foto (opcional): </label>
                        <input type="file" name="foto" id="foto" class="" />
                        <p class="text-danger">Obs: Tamanho máximo de 1MB. Extensão permitida: jpg e jpeg</p>
                    </div>
                </div>
                <!-- input hidden com o id do aluno -->
                <div class="row">
                    <input type="hidden" name="id" value="<?=$aluno->getId()?>" readonly required />
                </div>
            </form>

             <!-- Botoes -->
            <div class="row">
                <div class="col-6">
                    <a href="<?=route_to('AlunoListaController.viewListaAlunos')?>" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Listar Alunos</a>
                </div>
                <div class="col-6 d-flex flex-row-reverse">
                    <button type="submit" class="btn btn-primary" form="formEditaAluno"><i class="fa fa-save"></i> Salvar</button>
                </div>
            </div>
        </div>
    </div>
</div>




