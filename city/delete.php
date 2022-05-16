<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../models/city.php';

$database = new Database();
$db = $database->getConnection();

$user = new City($db);

$data = $_GET['id'];
$user->id = $data;

if ($user->delete()) {

    http_response_code(200);

    try {
        echo json_encode(["message" => "Пользователь был удалён."], JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE);
    } catch (JsonException $e) {
    }
} else {

    http_response_code(503);

    try {
        echo json_encode(["message" => "Не удалось удалить пользователя."], JSON_THROW_ON_ERROR);
    } catch (JsonException $e) {
    }
}