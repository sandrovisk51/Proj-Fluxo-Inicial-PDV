<?php

require_once __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/../procs/product.php';
require_once __DIR__ . '/../procs/lots.php';
require_once __DIR__ . '/../procs/breakdowns.php';


/*
| code for the filter
|=	equal         => 0
|>	bigger then   => 1
|<	less than     => 2
|<> different     => 3
|
*/
try {

    //count products  and breakdowns
    $filters           = ['id' => 0];
    $productCount      = $product->countProduct($filters, 1);
    $breakdownsCount   = $breakdowns->countBreakdowns($filters, 1);

    //count stock
    $filters           = ['amount' => 7];
    $productLotsCount  = $lots->countLotsProduct($filters, 2);

    //assembling array with all data
    $countData   = [
        'product'    => $productCount,
        'stock'      => $productLotsCount,
        'breakdowns' => $breakdownsCount
    ];

    header("Content-Type: application/json; charset=UTF-8");
    //Creates a json
    http_response_code(200);
    echo json_encode($countData);
} catch (Exception $e) {

    http_response_code(400);
    echo json_encode(['Ocorreu um erro ao contabilizar dados']);
}
