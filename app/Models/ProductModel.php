<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table      = 'products';       
    protected $primaryKey = 'id';             
    protected $allowedFields = ['nome', 'descricao', 'preco'];  
    protected $useTimestamps = true;          
    protected $dateFormat = 'datetime';       

    protected $validationRules = [
        'nome'        => 'required|min_length[3]',
        'descricao'   => 'required|min_length[5]',
        'preco'       => 'required|decimal', 
    ];

    protected $validationMessages = [
        'nome' => [
            'required' => 'O nome do produto é obrigatório.',
            'min_length' => 'O nome do produto deve ter no mínimo 3 caracteres.',
        ],
        'descricao' => [
            'required' => 'A descrição do produto é obrigatória.',
            'min_length' => 'A descrição do produto deve ter no mínimo 5 caracteres.',
        ],
        'preco' => [
            'required' => 'O preço do produto é obrigatório.',
            'decimal' => 'O preço deve ser um valor decimal.',
        ],
    ];
}
