<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


include_once '../config/database.php';
include_once '../models/city.php';

$database = new Database();
$db = $database->getConnection();

$city = new City($db);


$statement = $city->get();
$num = $statement->rowCount();

if ($num > 0) {

    $city_arr = array();
    $city_arr["items"] = array();

    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {

        // извлекаем строку
//        extract($row, 1);
        extract($row, EXTR_OVERWRITE);

        $city_item = array(
            "id" => $id,
            "name" => $name,
        );

        $city_arr["items"][] = $city_item;
    }

    http_response_code(200);

    try {
        echo json_encode($city_arr, JSON_THROW_ON_ERROR);
    } catch (JsonException $e) {
    }

} else {
    http_response_code(404);

    try {
        echo json_encode(["message" => "Пользователь не найдены."], JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE);
    } catch (JsonException $e) {
    }
}
