<?php 
header('Access-Control-Allow-Origin: *'); // Разрешаем запросы с любых сайтов
header('Content-Type: application/json'); // Указываем тип ответа (обычный текст) и кодировку

// Включение логов
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);

// Получение тела запроса от вебхука
$json = file_get_contents('php://input');

// Отправка запроса на вебхук
$curl = curl_init();

curl_setopt_array($curl, [
  CURLOPT_URL => $_GET['hook'],
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => $json,
  CURLOPT_HTTPHEADER => [
    "Content-Type: application/json"
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);
