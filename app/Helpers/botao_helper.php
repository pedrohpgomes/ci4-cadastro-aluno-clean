<?php

/**
 * Aqui fica alguns botões usados para deixar a página mais limpa
 */


// =============================
/**
 * Botao para excluir um aluno. Fica em App/Helpers/botao_helper.php
 *
 * @param [type] $id
 * @param [type] $nome
 * @return void
 */
function excluiAlunoBotaoHelper($id, $nome)
{
    echo
    "<form action='" . route_to('AlunoExcluiController.formExcluiAluno') . "' method='post' id='formExcluiAluno-$id'>
        <input type='hidden' name='id' value='$id'>
        <button type='submit'  class='btn btn-transparent' title='excluir aluno' form='formExcluiAluno-$id'>" . '<i class="fa fa-trash text-muted" onclick="return confirma(\'' . $id . '\',\'' . $nome . '\')"></i></button>' .
    "</form>";
}

// caso a rota para editar aluno necessite mudar de get para post, o botão já está pronto para ser chamado
function editaAlunoBotaoHelper($id)
{
    echo
    "<form action='" . route_to('AlunoEditaController.viewEditaAluno') . "' method='post' id='formEditaAluno-$id'>
        <input type='hidden' name='id' value='$id'>
        <button type='submit'  class='btn btn-transparent' title='editar aluno' form='formEditaAluno-$id'>" . '<i class="fa fa-edit text-primary"></i></button>' .
    "</form>";
}
