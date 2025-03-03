<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePurchaseOrdersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'            => [
                'type'           => 'INT',
                'unsigned'      => true,
                'auto_increment'=> true,
            ],
            'client_id'     => [
                'type'           => 'INT',
                'unsigned'      => true,
            ],
            'product_id'    => [
                'type'           => 'INT',
                'unsigned'      => true,
            ],
            'status'        => [
                'type'           => 'ENUM',
                'constraint'     => ['Em Aberto', 'Pago', 'Cancelado'],
                'default'        => 'Em Aberto',
            ],
            'quantidade'    => [
                'type'           => 'INT',
                'unsigned'      => true,
            ],
            'preco_total'   => [
                'type'           => 'DECIMAL',
                'constraint'     => '10,2',
            ],
            'created_at'    => [
                'type'           => 'DATETIME',
                'null'           => true,
            ],
            'updated_at'    => [
                'type'           => 'DATETIME',
                'null'           => true,
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('client_id', 'clients', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('product_id', 'products', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('purchase_orders');
    }

    public function down()
    {
        $this->forge->dropTable('purchase_orders');
    }
}
