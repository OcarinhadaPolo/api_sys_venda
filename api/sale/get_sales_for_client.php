<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: *");
header('Access-Control-Allow-Methods: GET, POST, OPTIONS, DELETE, PUT, PATCH');

header("Content-Type: application/json; charset=UTF-8");
    date_default_timezone_set('America/Sao_Paulo');
    include '../../config/config.php';

    $json = json_decode(file_get_contents("php://input"));
    $client = $json->cliente;

    $all_sales = $mysqli->query("SELECT * FROM venda v INNER JOIN vendaitem vi ON v.id = vi.venda_id INNER JOIN produto p ON p.id = vi.produto_id  WHERE v.cliente_id = '$client'");

    $sales = array();
    
    while($product = $all_sales->fetch_assoc()){
        $sales[] = $product;
    }

    $products = [];

    $json_response = [];

    if(empty($sales)){
        $json_response = [
            'message' => 'Nenhum venda encontrada',
            'result' => $sales];
    }else{
        $json_response = [
            'message' => 'venda Encontrada',
            'result' => $sales];
    }

    

    echo json_encode($json_response);


    



?>