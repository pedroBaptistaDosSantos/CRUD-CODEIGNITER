<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RenameColumnsInProductsTable extends Migration
{
    public function up()
    {
        $this->forge->modifyColumn('products', [
            'name' => [
                'name' => 'nome',
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
        ]);

        $this->forge->modifyColumn('products', [
            'description' => [
                'name' => 'descricao',
                'type' => 'TEXT',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->modifyColumn('products', [
            'nome' => [
                'name' => 'name',
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'descricao' => [
                'name' => 'description',
                'type' => 'TEXT',
            ],
        ]);
    }
}
