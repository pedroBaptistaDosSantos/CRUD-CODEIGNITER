<?php

namespace App\Models;

use CodeIgniter\Model;

class ClientModel extends Model
{
    
    protected $table      = 'clients';       
    protected $primaryKey = 'id';           
    protected $allowedFields = ['cpf_cnpj', 'nome_razao_social'];
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';

    protected $validationRules = [
        'cpf_cnpj' => 'required|is_unique[clients.cpf_cnpj]', // CPF/CNPJ obrigatório e único
        'nome_razao_social' => 'required|min_length[3]', // Nome/Razão social obrigatório e com no mínimo 3 caracteres
    ];
    protected $validationMessages = [
        'cpf_cnpj' => [
            'required' => 'O CPF/CNPJ é obrigatório.',
            'is_unique' => 'Esse CPF/CNPJ já está cadastrado.',
        ],
        'nome_razao_social' => [
            'required' => 'O nome/razão social é obrigatório.',
            'min_length' => 'O nome/razão social deve ter pelo menos 3 caracteres.',
        ],
    ];
}
