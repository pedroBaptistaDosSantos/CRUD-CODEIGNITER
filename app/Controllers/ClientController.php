<?php

namespace App\Controllers;

use App\Models\ClientModel;
use CodeIgniter\RESTful\ResourceController;

class ClientController extends ResourceController
{

    protected $modelName = 'App\Models\ClientModel';
    protected $format    = 'json';

    public function create()
    {
        $data = $this->request->getJSON();


        if (empty($data->cpf_cnpj) || empty($data->nome_razao_social)) {
            return $this->failValidationErrors([
                'cpf_cnpj' => 'CPF/CNPJ é obrigatório.',
                'nome_razao_social' => 'Nome/Razão Social é obrigatório.'
            ]);
        }

        $clientModel = new ClientModel();
        $dataArray = [
            'cpf_cnpj' => $data->cpf_cnpj,
            'nome_razao_social' => $data->nome_razao_social
        ];


        if ($clientModel->save($dataArray)) {
            return $this->respond([
                'status' => 201,
                'message' => 'Cliente criado com sucesso!',
                'id' => $clientModel->getInsertID()
            ], 201); 
        }


        return $this->failValidationErrors($clientModel->errors());
    }

    
    public function index()
    {
        $clientModel = new ClientModel();
        $clients = $clientModel->findAll();

        return $this->respond([
            'status' => 200,
            'message' => 'Clientes encontrados',
            'data' => $clients
        ]);
    }

    
    public function update($id = null)
    {
        $clientModel = new ClientModel();

        if ($id === null) {
            return $this->fail('ID do cliente não fornecido');
        }

        $client = $clientModel->find($id);

        if (!$client) {
            return $this->failNotFound('Cliente não encontrado');
        }

        $data = $this->request->getJSON(true);

        if (empty($data)) {
            return $this->fail('Nenhum dado foi enviado para atualização');
        }

        if ($clientModel->update($id, $data)) {
            return $this->respond([
                'status' => 200,
                'message' => 'Cliente atualizado com sucesso'
            ]);
        }

        return $this->fail('Falha ao atualizar cliente.');
    }

    
    public function delete($id = null)
    {
        $clientModel = new ClientModel();

        if ($clientModel->delete($id)) {
            return $this->respondDeleted([
                'status' => 200,
                'message' => 'Cliente deletado com sucesso'
            ]);
        }

        return $this->failNotFound('Cliente não encontrado');
    }
}
