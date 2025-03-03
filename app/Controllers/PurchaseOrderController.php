<?php

namespace App\Controllers;

use App\Models\PurchaseOrderModel;
use App\Models\ClientModel;
use App\Models\ProductModel;
use CodeIgniter\RESTful\ResourceController;

class PurchaseOrderController extends ResourceController
{
    protected $modelName = 'App\Models\PurchaseOrderModel';
    protected $format    = 'json';

    public function create()
    {
        $model = new PurchaseOrderModel();
        $data = $this->request->getJSON(true);

        $clientModel = new ClientModel();
        $productModel = new ProductModel();

        if (!$clientModel->find($data['client_id'])) {
            return $this->failNotFound('Cliente não encontrado.');
        }

        if (!$productModel->find($data['product_id'])) {
            return $this->failNotFound('Produto não encontrado.');
        }

        if ($model->save($data)) {
            return $this->respondCreated([
                'cabecalho' => [
                    'status' => 201,
                    'mensagem' => 'Pedido de compra criado com sucesso!'
                ],
                'retorno' => ['id' => $model->getInsertID()]
            ]);
        }

        return $this->failValidationErrors($model->errors());
    }

    public function index()
    {
        $model = new PurchaseOrderModel();
        $purchaseOrders = $model->findAll();

        return $this->respond([
            'cabecalho' => [
                'status' => 200,
                'mensagem' => 'Pedidos de compra retornados com sucesso.'
            ],
            'retorno' => $purchaseOrders
        ]);
    }

    public function show($id = null)
    {
        $model = new PurchaseOrderModel();
        $purchaseOrder = $model->find($id);

        if (!$purchaseOrder) {
            return $this->failNotFound('Pedido de compra não encontrado');
        }

        return $this->respond([
            'cabecalho' => [
                'status' => 200,
                'mensagem' => 'Pedido de compra encontrado.'
            ],
            'retorno' => $purchaseOrder
        ]);
    }

    public function update($id = null)
    {
        $purchaseOrderModel = new PurchaseOrderModel();
        $data = $this->request->getJSON(true);

        $purchaseOrder = $purchaseOrderModel->find($id);
        if (!$purchaseOrder) {
            return $this->failNotFound('Pedido de compra não encontrado.');
        }

        if (!$purchaseOrderModel->validate($data)) {
            return $this->failValidationErrors($purchaseOrderModel->errors());
        }

        if ($purchaseOrderModel->update($id, $data)) {
            return $this->respond([
                'status' => 200,
                'mensagem' => 'Pedido de compra atualizado com sucesso.',
                'retorno' => $data
            ], 200);
        } else {
            return $this->failServerError('Erro ao atualizar o pedido de compra.');
        }
    }

    public function delete($id = null)
    {
        $model = new PurchaseOrderModel();

        $purchaseOrder = $model->find($id);
        if (!$purchaseOrder) {
            return $this->failNotFound('Pedido de compra não encontrado');
        }

        if ($model->delete($id)) {
            return $this->respondDeleted([
                'cabecalho' => [
                    'status' => 200,
                    'mensagem' => 'Pedido de compra deletado com sucesso.'
                ],
                'retorno' => []
            ]);
        }

        return $this->fail('Falha ao deletar o pedido de compra.');
    }
}
