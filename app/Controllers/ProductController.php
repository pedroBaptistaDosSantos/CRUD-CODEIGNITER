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
                'status' => 201,
                'message' => 'Produto criado com sucesso!',
                'id' => $productModel->getInsertID()
            ], 201);
        }

        return $this->failValidationErrors($productModel->errors());
    }

    public function index()
    {
        $productModel = new ProductModel();
        $products = $productModel->findAll();

        return $this->respond([
            'status' => 200,
            'message' => 'Produtos encontrados',
            'data' => $products
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
            'status' => 200,
            'message' => 'Produto encontrado',
            'data' => $product
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
                'status' => 200,
                'message' => 'Produto atualizado com sucesso'
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
                'status' => 200,
                'message' => 'Produto deletado com sucesso'
            ]);
        }

        return $this->fail('Falha ao deletar produto.');
    }
}
