<?php
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: *");
    header('Access-Control-Allow-Methods: GET, POST, OPTIONS, DELETE, PUT, PATCH');
     
    header("Content-Type: application/json; charset=UTF-8");

    date_default_timezone_set('America/Sao_Paulo');
    include '../../config/config.php';
  
    error_reporting(E_ALL & ~E_NOTICE);
  
    $json = json_decode(file_get_contents("php://input"));
   

    $cliente_id = $json->cliente;

    $products = $json->products;

    $error = '';

    if(empty($cliente_id)){
        echo json_encode(array('message' => 'Campos Inválidos', 'error'=> 'O cliente não foi preenchido'));
        exit;
    }else if(empty($products)){
        echo json_encode(array('message' => 'Campos Inválidos', 'error'=> 'Os produtos não foram enviados'));
        exit;
    }else{
        $create_sale = $mysqli->query("INSERT INTO venda (cliente_id, total, desconto_total) VALUES ('$cliente_id', 0,0)");
        $error .= $mysqli->error;

        if($create_sale){
            $last_sale = $mysqli->insert_id;

            $price_total = 0.0;
            $discount_total = 0.0;

            


            $total_success = 0;

            foreach($products as $product){
                $id = $product->id;
                $quantity = $product->quantidade;
                $value_sale = $product->preco;
                $discount = $product->desconto; // desconto por item * quantidade 

                $price_real = ($quantity * $value_sale);
                $price_sale = $price_real -  ($price_real * $discount);

                $price_total += $price_sale;
                $discount_total += $discount;

                $create_sale_item = $mysqli->query("INSERT INTO vendaitem (venda_id, produto_id, quantidade, preco_na_venda, desconto) VALUES('$last_sale', '$id', '$quantity', '$price_sale', '$discount')") ;
                if($create_sale_item){
                    $total_success++;
                }else{
                    $error.= $mysqli->error;
                    echo json_encode(array('message' => 'Erro ao criar a venda', 'error' => $error));   
                }
            }

            if($total_success == count($products)){
                $update_sale = $mysqli->query("UPDATE venda SET total = '$price_total', desconto_total = '$discount_total' WHERE id = '$last_sale'");

                if($update_sale){
                    echo json_encode(array('message' => 'Sucesso ao criar a venda', 'code' => 200));   
                }else{
                    echo json_encode(array('message' => 'Erro ao criar a venda', 'error' => $error));   
                }
            }

           
        }
    }


?>