<?php

    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: *");
    header('Access-Control-Allow-Methods: GET, POST, OPTIONS, DELETE, PUT, PATCH');

    header("Content-Type: application/json; charset=UTF-8");
    
    date_default_timezone_set('America/Sao_Paulo');
    include '../../config/config.php';

    $json = json_decode(file_get_contents("php://input"));
    $id = $json->id;

    $all_clients = $mysqli->query("SELECT * FROM cliente WHERE id = '$id'");

    $clients = array();
    
    while($product = $all_clients->fetch_assoc()){
        $clients[] = $product;
    }

    $json_response = [];

    if(empty($clients)){
        $json_response = [
            'message' => 'Nenhum cliente encontrado',
            'result' => $clients];
    }else{
        $json_response = [
            'message' => 'cliente Encontrado',
            'result' => $clients];
    }

    

    echo json_encode($json_response);


    



?>