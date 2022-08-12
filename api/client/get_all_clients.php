<?php

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: GET");
    date_default_timezone_set('America/Sao_Paulo');
    include '../../config/config.php';

    $all_clients = $mysqli->query("SELECT * FROM cliente");

    $clients = array();
    
    while($product = $all_clients->fetch_assoc()){
        $clients[] = $product;
    }

    $json_response = [];

    if(empty($clients)){
        $json_response = [
            'message' => 'Nenhum cliente cadastrado',
            'result' => $clients];
    }else{
        $json_response = [
            'message' => 'clientes Encontrados',
            'result' => $clients];
    }

    

    echo json_encode($json_response);


    



?>