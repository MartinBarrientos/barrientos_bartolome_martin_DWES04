<?php
require_once __DIR__.'/../models/DAO/articuloDAO.php';
class ArticuloController{
    
    function mostrar() {
        $articuloDao = new ArticuloDao();
        $result = $articuloDao->getAllArticulos();
        if($result){
            http_response_code(200);
            return ['Estado consulta' => http_response_code(200), 'message' => 'Articulos conseguidos de la BD', 'data' => $result];

        }else{
            http_response_code(404);
            return ['Estado consulta'=> http_response_code( 404),'message' => 'Articulos no encontrados'];
        }
    }
    function mostrarId($id){
        $articuloDao = new ArticuloDao();
        $result = $articuloDao->getArticulosById($id);
        if (!$result) {
            http_response_code(404);
            return ['Estado consulta' => http_response_code(404), 'message' => 'Articulo no encontrado', 'data' => $result];
        }else{
            return ['Estado consulta' => http_response_code(200),'message' => 'Articulo conseguido por id de la BD', 'data' => $result];

        }
    }
    function new($data){
        $articuloDao = new ArticuloDao();
        $result = $articuloDao->nuevoArticulo($data);
        if(is_null($data)){
            http_response_code(400);
            return ['Estado consulta' => http_response_code(400),'message' => 'Bad Request: Missing data'];
            
        }else{
            http_response_code(200);
            return ['Estado consulta' => http_response_code(200),'message' => 'Nuevo articulo creado', 'data' => $result];

        }

    }
    function update($id,$data){    
        $articuloDao = new ArticuloDao();
        $result = $articuloDao->actualizarArticulo($id, $data);
        if($result){
            http_response_code(200);
            return ['Estado consulta' => http_response_code(200),'message' => 'Articulo actualizado', 'data' => $result];
        }else{
            http_response_code(404);
            return ['Estado consulta'=> http_response_code( 404),'message' => 'Articulo no encontrado'];
        }

    }
    function delete($id){
        $articuloDao = new ArticuloDao();
        $result = $articuloDao->eliminarArticulo($id);
        if($result !== false){
            http_response_code(200);
            return ['Estado consulta' => http_response_code(200), 'message' => 'Articulo eliminado', 'data' => $result];
        }else {
            http_response_code(404);
            return ['Estado consulta'=> http_response_code( 404),'message' => 'Articulo no encontrado'];
        }
    }
}