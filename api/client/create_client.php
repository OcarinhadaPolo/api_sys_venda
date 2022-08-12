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
    $cpf = $json->cpf;
    $cc = $json->cc;
    $limite = $json->limite;

    if(empty($nome)){
        echo json_encode(array('message' => 'Campos Inválidos', 'error'=> 'O nome não foi preenchido'));
        exit;
    }else if(empty($cpf)){
        echo json_encode(array('message' => 'Campos Inválidos', 'error'=> 'O cpf não foi preenchido'));
        exit;
    }else if(empty($cc)){
        echo json_encode(array('message' => 'Campos Inválidos', 'error'=> 'O CC não foi preenchido'));
        exit;
    }
    else if(empty($limite)){
        echo json_encode(array('message' => 'Campos Inválidos', 'error'=> 'O limite não foi preenchido'));
        exit;
    }

    if(!empty($nome) && !empty($cpf) && !empty($cc) && !empty($limite)){
        $create_client = $mysqli->query("INSERT INTO cliente (nome, cpf, cc, limite) VALUES ('$nome', '$cpf', '$cc', '$limite')");
        $error = $mysqli->error;

        if($create_client){
            echo json_encode(array('message' => 'cliente Cadastrado com sucesso', 'code' => 200));   
            exit;
        }else{
            echo json_encode(array('message' => 'Erro ao cadastrar cliente', 'error'=> $error));
            exit;
        }
    }else{
        echo json_encode(array('message' => 'Campos Inválidos', 'error'=> 'Nenhum dado foi enviado'));
        exit;
    }


    



?>