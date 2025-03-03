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
                'cabecalho' => [
                    'status' => 201,
                    'mensagem' => 'Cliente criado com sucesso!'
                ],
                'retorno' => [
                    'id' => $clientModel->getInsertID()
                ]
            ], 201); 
        }

        return $this->failValidationErrors($clientModel->errors());
    }

    public function index()
    {
        $clientModel = new ClientModel();
        $clients = $clientModel->findAll();

        return $this->respond([
            'cabecalho' => [
                'status' => 200,
                'mensagem' => 'Clientes encontrados'
            ],
            'retorno' => $clients
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
                'cabecalho' => [
                    'status' => 200,
                    'mensagem' => 'Cliente atualizado com sucesso'
                ],
                'retorno' => []
            ]);
        }

        return $this->fail('Falha ao atualizar cliente.');
    }

    public function delete($id = null)
    {
        $clientModel = new ClientModel();

        if ($clientModel->delete($id)) {
            return $this->respondDeleted([
                'cabecalho' => [
                    'status' => 200,
                    'mensagem' => 'Cliente deletado com sucesso'
                ],
                'retorno' => []
            ]);
        }

        return $this->failNotFound('Cliente não encontrado');
    }
}
