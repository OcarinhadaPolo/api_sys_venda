<?php

    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: *");
    header('Access-Control-Allow-Methods: GET, POST, OPTIONS, DELETE, PUT, PATCH');

    header("Content-Type: application/json; charset=UTF-8");
    
    date_default_timezone_set('America/Sao_Paulo');
    include '../../config/config.php';

    $json = json_decode(file_get_contents("php://input"));


    $id = $json->id;
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
    else if(empty($id)){
        echo json_encode(array('message' => 'Campos Inválidos', 'error'=> 'o ID do cliente não foi preenchido'));
        exit;
    }

    if(!empty($nome) && !empty($nome) && !empty($nome) && !empty($id)){
        $update_client = $mysqli->query("UPDATE cliente SET nome = '$nome', cpf = '$cpf', cc = '$cc', limite = '$limite' WHERE id = '$id'");
        $error = $mysqli->error;

        if($update_client){
            echo json_encode(array('message' => 'cliente editado com sucesso', 'code' => 200));   
            exit;
        }else{
            echo json_encode(array('message' => 'Erro ao editar cliente', 'error'=> $error));
            exit;
        }
    }else{
        echo json_encode(array('message' => 'Campos Inválidos', 'error'=> 'Nenhum dado foi enviado'));
        exit;
    }


    



?>