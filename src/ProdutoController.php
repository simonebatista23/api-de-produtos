<?php

class ProdutoController
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function listar()
    {
        $stmt = $this->pdo->query("SELECT * FROM produtos");
        echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    public function criar($data)
    {
        if (empty($data['nome']) || empty($data['quantidade'])) {
            http_response_code(400);
            echo json_encode(["erro" => "Os campos 'nome' e 'quantidade' são obrigatórios e não podem estar vazios"]);
            return;
        }

        $stmt = $this->pdo->prepare("INSERT INTO produtos (nome, quantidade) VALUES (?, ?)");

        $stmt->execute([$data['nome'], $data['quantidade']]);

        echo json_encode(["mensagem" => "Produto criado com sucesso"]);
    }


    public function atualizar($data)
    {
        if (empty($data['id']) || empty($data['nome']) || empty($data['quantidade'])) {
            http_response_code(400); 
            echo json_encode(["erro" => "Os campos 'id', 'nome' e 'quantidade' são obrigatórios"]);
            return;
        }

        if (!is_numeric($data['id'])) {
            http_response_code(400);
            echo json_encode(["erro" => "O 'id' deve ser um número válido"]);
            return;
        }

        $stmt = $this->pdo->prepare("UPDATE produtos SET nome = ?, quantidade = ? WHERE id = ?");

        $stmt->execute([$data['nome'], $data['quantidade'], $data['id']]);

        echo json_encode(["mensagem" => "Produto atualizado com sucesso"]);
    }

    public function excluir($id)
    {
        if (empty($id) || !is_numeric($id)) {
            http_response_code(400);
            echo json_encode(["erro" => "O 'id' deve ser fornecido e ser um número válido"]);
            return;
        }

        $stmt = $this->pdo->prepare("DELETE FROM produtos WHERE id = ?");

        $stmt->execute([$id]);

        echo json_encode(["mensagem" => "Produto excluído com sucesso"]);
    }
}
