<?php

require_once __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/../procs/product.php';

if ($id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT)) {

    //delete Product
    if ($product->deleteProduct($id)) {

        http_response_code(200);
        echo json_encode(['Produto deletado com sucesso.']);

    } else {

        http_response_code(400); 
        echo json_encode(['Houve um erro ao deletar esta produto.']);

    };
} else {

    http_response_code(400); 
    echo json_encode(['Os dados enviados não são válidos.']);

}
