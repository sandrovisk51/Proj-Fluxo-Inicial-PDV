<?php

require_once __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/../procs/tax.php';

if ($id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT)) {

    //delete tax 
    if ($tax->deleteTax($id)) {

        http_response_code(200);
        echo json_encode(['Imposto deletado com sucesso.']);

    } else {

        http_response_code(400); 
        echo json_encode(['Houve um erro ao deletar esta imposto.']);

    };
} else {

    http_response_code(400); 
    echo json_encode(['Os dados enviados não são válidos.']);

}
