<?php
require_once __DIR__.'/../app/core/routers/ArticuloRouter.php';
// Obtener la URL solicitada
$url = $_SERVER['QUERY_STRING'];
$url = trim($url, '/');
$urlParams = explode('/', $url);

// Inicializar el array de la URL
$urlArray = array(
    'HTTP'=> $_SERVER['REQUEST_METHOD'],
    'controller'=> $urlParams[0],
    'action'=> $urlParams[1],
    'params'=> $urlParams[2] ?? null,
    'path'=> $url
);
error_log(print_r($urlArray, true));
// Validación de la URL
if(empty($urlParams[0]) || empty($urlParams[1])){
    http_response_code(400);
    echo json_encode(['message' => 'Bad Request: Falta controlador o accion']);
    exit;
}

$respuesta = $articuloRouter->route($urlArray);
// Enviar la respuesta
header('Content-type: Json');
echo json_encode($respuesta, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);