Prova Técnica - CRUD de Clientes, Produtos e Pedidos de Compra
Descrição

Este projeto foi desenvolvido como parte de uma prova técnica, com o objetivo de criar uma API RESTful para gerenciamento de clientes, produtos e pedidos de compra. A API permite realizar as operações CRUD (Criar, Ler, Atualizar e Deletar) de forma simples e eficiente.
Tecnologias Utilizadas

    PHP 8.x
    CodeIgniter 4
    MySQL
    REST API

Funcionalidades

A API oferece as seguintes funcionalidades:
Clientes

    Criar Cliente: Registra um novo cliente com CPF/CNPJ e Nome/Razão Social.
    Listar Clientes: Retorna uma lista de todos os clientes cadastrados.
    Atualizar Cliente: Atualiza as informações de um cliente existente.
    Deletar Cliente: Remove um cliente do banco de dados.

Produtos

    Criar Produto: Registra um novo produto com informações básicas como nome e preço.
    Listar Produtos: Retorna uma lista de todos os produtos cadastrados.
    Visualizar Produto: Exibe os detalhes de um produto específico.
    Atualizar Produto: Atualiza as informações de um produto existente.
    Deletar Produto: Remove um produto do banco de dados.

Pedidos de Compra

    Criar Pedido de Compra: Registra um novo pedido de compra com cliente, produto, quantidade e preço.
    Listar Pedidos de Compra: Retorna uma lista de todos os pedidos de compra.
    Atualizar Pedido de Compra: Atualiza as informações de um pedido de compra, incluindo status.
    Deletar Pedido de Compra: Remove um pedido de compra do banco de dados.

Estrutura de Resposta da API

Todas as respostas da API seguem o padrão:

{
  "cabecalho": {
    "status": 200,
    "mensagem": "Pedido de compra deletado com sucesso."
  },
  "retorno": []
}

Onde:

    cabecalho contém informações sobre o status da requisição e uma mensagem descritiva.
    retorno contém os dados solicitados (se aplicável).

Endpoints
Clientes

    POST /clientes - Criar Cliente
    GET /clientes - Listar Clientes
    GET /clientes/{id} - Visualizar Cliente
    PUT /clientes/{id} - Atualizar Cliente
    DELETE /clientes/{id} - Deletar Cliente

Produtos

    POST /produtos - Criar Produto
    GET /produtos - Listar Produtos
    GET /produtos/{id} - Visualizar Produto
    PUT /produtos/{id} - Atualizar Produto
    DELETE /produtos/{id} - Deletar Produto

Pedidos de Compra

    POST /pedidos-compra - Criar Pedido de Compra
    GET /pedidos-compra - Listar Pedidos de Compra
    GET /pedidos-compra/{id} - Visualizar Pedido de Compra
    PUT /pedidos-compra/{id} - Atualizar Pedido de Compra
    DELETE /pedidos-compra/{id} - Deletar Pedido de Compra

Requisitos

    PHP 8.x ou superior
    MySQL
    Composer

Instruções de Instalação

    Clone o repositório para o seu diretório local:

git clone https://github.com/pedroBaptistaDosSantos/CRUD-CODEIGNITER.git
cd CRUD-CODEIGNITER

Instale as dependências utilizando o Composer:

composer install

Configure o arquivo .env com as credenciais do banco de dados:

database.default.hostname = localhost
database.default.database = nome_do_banco
database.default.username = root
database.default.password = ""

Execute as migrations para criar as tabelas no banco de dados:

php spark migrate

Inicie o servidor embutido do CodeIgniter:

    php spark serve

    A aplicação estará disponível em http://localhost:8080.

Testando a API

Use o Postman ou qualquer cliente HTTP para testar os endpoints da API. As respostas estarão no formato JSON, conforme descrito.
Caso Prefira, utilize o arquivo [L5Network.postman_collection.json] para importar a coleção das requisições para o PostMan
