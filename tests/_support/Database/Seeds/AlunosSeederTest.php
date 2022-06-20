<?php

namespace Tests\Support\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AlunosSeederTest extends Seeder
{
    public function run()
    {
        $aluno1 = [
            'id' => 1,
            'nome' => 'Johnny Depp',
            'endereco' => 'Rua dos Atores, n 145, bairro centro, Cabaceiras - PB, CEP: 58480-000',
            'foto' => ''
        ];
        $aluno2 = [
            'id' => 2,
            'nome' => 'Will Smith',
            'endereco' => 'Rua dos Tapas, n 2022, bairro apelou, Nova Iorque - MA, CEP: 65880-970',
            'foto' => ''
        ];
        $aluno3 = [
            'id' => 3,
            'nome' => 'Galvão Bueno',
            'endereco' => 'Rua Galvão Bueno, n 71, bairro Liberdade, São Paulo - SP, CEP: 01506-000 ',
            'foto' => ''
        ];
        $aluno4 = [
            'id' => 4,
            'nome' => 'Chaves',
            'endereco' => 'Rua das Gentalhas, n 8, Praça México, Belo Horizonte - MG, CEP: 31110-610 ',
            'foto' => ''
        ];

        $this->db->table('alunos')->insert($aluno1);
        $this->db->table('alunos')->insert($aluno2);
        $this->db->table('alunos')->insert($aluno3);
        $this->db->table('alunos')->insert($aluno4);
    }
}
