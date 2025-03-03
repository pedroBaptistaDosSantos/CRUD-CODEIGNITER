<?php

namespace App\Models;

use CodeIgniter\Model;

class PurchaseOrderModel extends Model
{
    protected $table      = 'purchase_orders';
    protected $primaryKey = 'id';

    protected $allowedFields = ['client_id', 'product_id', 'status', 'quantidade', 'preco_total'];

    protected $validationRules = [
        'client_id'   => 'required|integer',
        'product_id'  => 'required|integer',
        'status'      => 'required|in_list[Em Aberto,Pago,Cancelado]',
        'quantidade'  => 'required|integer',
        'preco_total' => 'required|numeric'
    ];

    protected $validationMessages = [
        'client_id'   => ['integer' => 'O ID do cliente deve ser um número inteiro.'],
        'product_id'  => ['integer' => 'O ID do produto deve ser um número inteiro.'],
        'status'      => ['in_list' => 'O status deve ser "Em Aberto", "Pago" ou "Cancelado".'],
        'quantidade'  => ['integer' => 'A quantidade deve ser um número inteiro.'],
        'preco_total' => ['numeric' => 'O preço total deve ser um valor numérico.']
    ];
}
