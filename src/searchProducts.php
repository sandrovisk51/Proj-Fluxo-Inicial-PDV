<?php

require_once __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/../procs/product.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $postData = file_get_contents('php://input');
    $postDataArray = json_decode($postData, true);
    

    if (!empty($postDataArray)) {

        $dataSearch =  $postDataArray['search'];

        //creating new array
        $newArraySearch = [
            'name' => $dataSearch,
            'bar_code' => $dataSearch,
            'description' => $dataSearch,
        ];

        //searching for products
        $productData = $product->searchProduct($newArraySearch);

        header("Content-Type: application/json; charset=UTF-8");

        if ($productData) {

            //returning the registered rate data
            http_response_code(200); 
            echo json_encode($productData);
        } else {
            http_response_code(400); 
            echo json_encode(['Este produto não foi localizado.']);
        };
    } else {

        http_response_code(400); 
        echo json_encode(['Insira um detalhe do produto para realizar a pesquisa.']);
    }
} else {

    http_response_code(400); 
    echo json_encode(['Os dados enviados são inválidos.']);
}
