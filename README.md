# API de Produtos

Esta é uma API simples para gerenciar produtos. A API permite realizar operações CRUD (Create, Read, Update, Delete) em uma lista de produtos.

## Tecnologias Utilizadas

- PHP
- PDO para conexão com banco de dados
- PHP dotenv para variáveis de ambiente

## Endpoints

### 1. Criar Produto
- **Método**: POST
- **URL**: `/produtos`
- **Body**:
  ```json
  {
    "nome": "Nome do Produto",
    "quantidade": 10
  }
