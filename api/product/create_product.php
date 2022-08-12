<?php

    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: *");
    header('Access-Control-Allow-Methods: GET, POST, OPTIONS, DELETE, PUT, PATCH');
    
    header("Content-Type: application/json; charset=UTF-8");
    
    
    
    date_default_timezone_set('America/Sao_Paulo');
    include '../../config/config.php';

    error_reporting(E_ALL & ~E_NOTICE);

    $json = json_decode(file_get_contents("php://input"));


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

    if(!empty($nome) && !empty($nome) && !empty($nome)){
        $create_product = $mysqli->query("INSERT INTO produto (nome, preco, unidade) VALUES ('$nome', '$preco', '$unidade')");
        $error = $mysqli->error;

        if($create_product){
            echo json_encode(array('message' => 'Produto Cadastrado com sucesso', 'code' => 200));   
            exit;
        }else{
            echo json_encode(array('message' => 'Erro ao cadastrar produto', 'error'=> $error));
            exit;
        }
    }else{
        echo json_encode(array('message' => 'Campos Inválidos', 'error'=> 'Nenhum dado foi enviado'));
        exit;
    }


    



?>