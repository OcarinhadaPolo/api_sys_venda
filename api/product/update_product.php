<?php

    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: *");
    header('Access-Control-Allow-Methods: GET, POST, OPTIONS, DELETE, PUT, PATCH');

    header("Content-Type: application/json; charset=UTF-8");
    
    date_default_timezone_set('America/Sao_Paulo');
    include '../../config/config.php';

    error_reporting(E_ALL & ~E_NOTICE);

    $json = json_decode(file_get_contents("php://input"));


    $id = $json->id;
    $nome = $json->nome;
    $preco = $json->preco;
    $unidade = $json->unidade;

    if(empty($nome)){
        echo json_encode(array('message' => 'Campos Inválidos', 'error'=> 'O nome não foi preenchido'));
        exit;
    }else if(empty($preco)){
        echo json_encode(array('message' => 'Campos Inválidos', 'error'=> 'O preço não foi preenchido'));
        exit;
    }else if(empty($unidade)){
        echo json_encode(array('message' => 'Campos Inválidos', 'error'=> 'A unidade não foi preenchida'));
        exit;
    }
    else if(empty($id)){
        echo json_encode(array('message' => 'Campos Inválidos', 'error'=> 'o ID do produto não foi preenchido'));
        exit;
    }

    if(!empty($nome) && !empty($nome) && !empty($nome) && !empty($id)){
        $update_product = $mysqli->query("UPDATE produto SET nome = '$nome', preco = '$preco', unidade = '$unidade' WHERE id = '$id'");
        $error = $mysqli->error;

        if($update_product){
            echo json_encode(array('message' => 'Produto editado com sucesso', 'code' => 200));   
            exit;
        }else{
            echo json_encode(array('message' => 'Erro ao editar produto', 'error'=> $error));
            exit;
        }
    }else{
        echo json_encode(array('message' => 'Campos Inválidos', 'error'=> 'Nenhum dado foi enviado'));
        exit;
    }


    



?>