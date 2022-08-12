<?php

    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: *");
    header('Access-Control-Allow-Methods: GET, POST, OPTIONS, DELETE, PUT, PATCH');

    header("Content-Type: application/json; charset=UTF-8");
    date_default_timezone_set('America/Sao_Paulo');
    include '../../config/config.php';

    $json = json_decode(file_get_contents("php://input"));
    $id = $json->id;

    $all_products = $mysqli->query("SELECT * FROM produto WHERE id = '$id'");

    $products = array();
    
    while($product = $all_products->fetch_assoc()){
        $products[] = $product;
    }

    $json_response = [];

    if(empty($products)){
        $json_response = [
            'message' => 'Nenhum produto encontrado',
            'result' => $products];
    }else{
        $json_response = [
            'message' => 'Produto Encontrado',
            'result' => $products];
    }

    

    echo json_encode($json_response);


    



?>