<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


include_once '../config/database.php';
include_once '../models/city.php';

$database = new Database();
$db = $database->getConnection();

$city = new City($db);

$page = $_GET['page'] ?? 1;
$limit = 2;
$offset = $limit * ($page-1);

$statement = $city->get($limit, $offset);
$num = $statement->rowCount();

echo($num);

if ($num > 0) {

//    echo 1;
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
//        print_r($city_item);

        $city_arr["items"][] = $city_item;
//        print_r($city_arr);
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
