<?php

require_once __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/../procs/product.php';
require_once __DIR__ . '/../procs/lots.php';
require_once __DIR__ . '/../procs/tax.php';


try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $postData = file_get_contents('php://input');
        $postDataArray = json_decode($postData, true);


        if (!empty($postDataArray)) {

            $barCodeArray['bar_code']  = $postDataArray['bar_code_product'];
            $productData               = $product->editProduct($barCodeArray);

            $idProduct['id_product']   = $productData[0]['id'] ?? 0;
            $lotsData                  = $lots->editLot($idProduct);

            $idTax['id']               = $lotsData[0]['tax'] ?? 0;
            $taxData                   = $tax->editTax($idTax);

            $qtdItem                   = $postDataArray['quantity_product'];

            if ($productData && $lotsData && $taxData && is_numeric($qtdItem) && $qtdItem > 0) {

                if ($qtdItem > $lotsData[0]['amount']) {
                    http_response_code(400);
                    exit(json_encode(['Quantidade não disponivel em estoque.']));
                }

                $itemProduct = $tax->calculateTax($productData, $lotsData, $taxData, $qtdItem);

                http_response_code(200);
                echo json_encode($itemProduct);
            } else {

                http_response_code(400);
                echo json_encode(['Informações são invalidas']);
            }
        } else {

            http_response_code(400);
            echo json_encode(['Os dados foram recebidos em branco.']);
        }
    } else {

        http_response_code(400);
        echo json_encode(['Os dados do formulário não foram enviados.']);
    }
} catch (Exception $e) {

    http_response_code(400);
    echo json_encode(['Ocorreu um erro ao localizar produto.']);
}
