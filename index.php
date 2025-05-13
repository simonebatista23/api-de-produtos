<?php
header("Content-Type: application/json");
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/src/ProdutoController.php';

$controller = new ProdutoController($pdo);
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        $controller->listar();
        break;

    case 'POST':
        $data = json_decode(file_get_contents("php://input"), true);
        $controller->criar($data);
        break;

    case 'PUT':
        $data = json_decode(file_get_contents("php://input"), true);
        $controller->atualizar($data);
        break;

    case 'DELETE':
        $data = json_decode(file_get_contents("php://input"), true);
        $controller->excluir($data['id']);
        break;

    default:
        http_response_code(405);
        echo json_encode(["erro" => "Método não permitido"]);
}
