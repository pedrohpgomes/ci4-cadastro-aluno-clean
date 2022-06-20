

<div class="col-12 mt-3">
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Lista de Alunos</h2>
            <div class="d-flex flex-row-reverse">
                <a href="<?=route_to('AlunoCadastraController.viewCadastraAluno')?>" class="btn btn-primary" title="cadastrar novo aluno"><i class="fa fa-plus"></i> Cadastrar Aluno</a>
            </div>
        </div><!-- /.card-header -->              
        <div class="card-body">
            <!-- Validation Errors -->
            <?php if (isset($validation)) : ?>
                <div class="d-flex justify-content-center text-danger">
                    <?= $validation->listErrors()?>
                </div>
            <?php endif; ?>
            <!-- Tabrela -->
            <table id="tableAlunos" class="table table-bordered table-striped nowrap" width="100%">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nome</th>
                        <th>Endereço</th>
                        <th>Foto</th>
                        <th style="width:100px" class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($alunos as $aluno) : ?>
                        <tr>
                            <td><?=$aluno->getId()?></td>
                            <td><?=$aluno->getNome()?></td>
                            <td><?=$aluno->getEndereco()?></td>
                            <td>
                                <?php if ($aluno->getFoto() != null || $aluno->getFoto() != '') { ?>
                                    <a href="<?=base_url('aluno/foto/' . $aluno->getId())?>" target="_blank"><img class="foto" src="<?=base_url('aluno/foto/' . $aluno->getId()) ?>" alt="foto" style="max-width:100px;max-height:100px;"></a>
                                <?php } ?>
                                
                            </td>
                            <td class="text-center">
                                <div class="row">
                                    <span class="col-6 mr-0 mt-2">
                                    <a href="<?=route_to('AlunoEditaController.viewEditaAluno', $aluno->getId())?>" title="editar aluno"><i class="fa fa-edit"></i></a>
                                    </span>
                                    <span class="col-6 ml-0">                                                            
                                        <?=excluiAlunoBotaoHelper($aluno->getId(), $aluno->getNome())?>
                                    </span>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- Bootstrap 4 -->
<script src="<?php echo base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')?>"></script>
<!-- DataTables -->
<script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js')?>"></script>
<script src="<?php echo base_url('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')?>"></script>
<script src="<?php echo base_url('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js')?>"></script>
<script src="<?php echo base_url('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')?>"></script>

<script>
    $(document).ready(function() {
        $("#tableAlunos").DataTable({
            "responsive": true,
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "todas"]],
            "order": [[ 0, "desc" ]],
            'columnDefs' : [
                //hide the second column
                { 'visible': false, 'targets': [] }
            ]
        });
    });
</script>

<script>
    function confirma(codigo,nome) {
        if (!confirm("Deseja excluir o aluno: " + nome + " - código: " + codigo + " ?")) {
            return false;
        }
        return true;
    }
</script>