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


    if(empty($id)){
        echo json_encode(array('message' => 'Campos Inválidos', 'error'=> 'o ID do cliente não foi preenchido'));
        exit;
    }

    if(!empty($id)){
        $delete_client = $mysqli->query("DELETE FROM cliente WHERE id = '$id'");
        $error = $mysqli->error;

        if($delete_client){
            echo json_encode(array('message' => 'cliente deletado com sucesso', 'code' => 200));   
            exit;
        }else{
            echo json_encode(array('message' => 'Erro ao deletar cliente', 'error'=> $error));
            exit;
        }
    }else{
        echo json_encode(array('message' => 'Campos Inválidos', 'error'=> 'Nenhum dado foi enviado'));
        exit;
    }


    



?>