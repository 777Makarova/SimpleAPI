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

$city = new City($db);


if (!empty($_GET['name']))
{
    $city->name = $_GET['name'];

    if ($city->create()) {

        http_response_code(201);
        try {
            echo json_encode(array("message" => "Пользователь был создан."), JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE);
        } catch (JsonException $e) {
        }
    } else {
        http_response_code(503);

        try {
            echo json_encode(["message" => "Невозможно создать пользователя."], JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE);
        } catch (JsonException $e) {
        }
    }
} else {

    http_response_code(400);

    try {
        echo json_encode(["message" => "Невозможно создать пользователя. Данные неполные."], JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE);
    } catch (JsonException $e) {
    }
}
