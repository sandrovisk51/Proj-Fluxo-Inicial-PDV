<?php

require_once __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/../procs/Product.php';

require_once __DIR__ . '/../procs/Lots.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $postData = file_get_contents('php://input');
    $postDataArray = json_decode($postData, true);

    //inserting current date into array
    $postDataArray['date_create'] = date('Y-m-d H:i:s');

    if (!empty($postDataArray)) {

        //checking if you have a product registered
        $barCode     = $postDataArray['bar_code'];
        $productData = $product->editProduct(['bar_code' => $barCode]);

        if (!empty($productData)) {

            unset($postDataArray['bar_code']);
            $postDataArray['id_product'] = $productData[0]['id'];

            //inserting batch form data
            if ($lots->registerLot($postDataArray)) {

                http_response_code(200);
                echo json_encode(['Lote cadastrado com sucesso.']);

            } else {

                http_response_code(400); 
                echo json_encode(['Houve um erro ao cadastrar este lote.']);
            };
        } else {

            http_response_code(400); 
            echo json_encode(['Este código de barras não foi localizado.']);
        }
    } else {

        http_response_code(400); 
        echo json_encode(['Os dados foram recebidos em branco.']);
    }
} else {

    http_response_code(400); 
    echo json_encode(['Os dados do formulário não foram enviados.']);
}
