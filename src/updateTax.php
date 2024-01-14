<?php

require_once __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/../procs/tax.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $postData = file_get_contents('php://input');
    $postDataArray = json_decode($postData, true);
    

    if (!empty($postDataArray)) {

        //updating tax form
        if ($tax->updateTax($postDataArray)) {

            http_response_code(200); 
            echo json_encode(['Imposto atualizado com sucesso.']);

        } else {

            http_response_code(400); 
            echo json_encode(['Houve um erro ao atualizar este imposto.']);

        };
    } else {

        http_response_code(400); 
        echo json_encode(['Os dados foram recebidos em branco.']);
    }
} else {
    
    http_response_code(400); 
    echo json_encode(['Os dados do formulário não foram enviados.']);
}
