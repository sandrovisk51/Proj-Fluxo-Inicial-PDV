<?php

require_once __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/../procs/product.php';
require_once __DIR__ . '/../procs/lots.php';


try {

    header("Content-Type: application/json; charset=UTF-8");

    //returns the list of products by name
    $listProduct = $product->listProduct('name');

    //returns the list of products by name
    $filters = ['amount' => 7];
    $listLots = $lots->listLotsProductStock($filters, 2);


    //create array the list
    $listData = [
        'product'     => $listProduct,
        'stock'       => $listLots
    ];

    //Creates a json
    http_response_code(200);
    echo json_encode($listData);
} catch (Exception $e) {

    http_response_code(400);
    echo json_encode(['Ocorreu um erro ao gerar listas do estoque.']);
}
