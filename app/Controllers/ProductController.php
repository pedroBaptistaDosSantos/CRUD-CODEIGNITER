<?php

namespace App\Controllers;

use App\Models\ProductModel;
use CodeIgniter\RESTful\ResourceController;

class ProductController extends ResourceController
{
    protected $modelName = 'App\Models\ProductModel';
    protected $format    = 'json';

    public function create()
    {
        $productModel = new ProductModel();
        $data = $this->request->getPost();

        if ($productModel->save($data)) {
            return $this->respond([
                'cabecalho' => [
                    'status' => 201,
                    'mensagem' => 'Produto criado com sucesso!'
                ],
                'retorno' => [
                    'id' => $productModel->getInsertID()
                ]
            ], 201);
        }

        return $this->failValidationErrors($productModel->errors());
    }

    public function index()
    {
        $productModel = new ProductModel();
        $products = $productModel->findAll();

        return $this->respond([
            'cabecalho' => [
                'status' => 200,
                'mensagem' => 'Produtos encontrados'
            ],
            'retorno' => $products
        ]);
    }

    public function show($id = null)
    {
        $productModel = new ProductModel();
        $product = $productModel->find($id);

        if (!$product) {
            return $this->failNotFound('Produto não encontrado');
        }

        return $this->respond([
            'cabecalho' => [
                'status' => 200,
                'mensagem' => 'Produto encontrado'
            ],
            'retorno' => $product
        ]);
    }

    public function update($id = null)
    {
        $productModel = new ProductModel();
        $data = $this->request->getRawInput();

        $product = $productModel->find($id);
        if (!$product) {
            return $this->failNotFound('Produto não encontrado');
        }

        if ($productModel->update($id, $data)) {
            return $this->respond([
                'cabecalho' => [
                    'status' => 200,
                    'mensagem' => 'Produto atualizado com sucesso'
                ],
                'retorno' => []
            ]);
        }

        return $this->fail('Falha ao atualizar produto.');
    }

    public function delete($id = null)
    {
        $productModel = new ProductModel();

        $product = $productModel->find($id);
        if (!$product) {
            return $this->failNotFound('Produto não encontrado');
        }

        if ($productModel->delete($id)) {
            return $this->respondDeleted([
                'cabecalho' => [
                    'status' => 200,
                    'mensagem' => 'Produto deletado com sucesso'
                ],
                'retorno' => []
            ]);
        }

        return $this->fail('Falha ao deletar produto.');
    }
}
