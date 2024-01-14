<?php

require_once __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/../procs/product.php';
require_once __DIR__ . '/../procs/lots.php';
require_once __DIR__ . '/../procs/breakdowns.php';

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $postData = file_get_contents('php://input');
        $postDataArray = json_decode($postData, true);


        if (!empty($postDataArray)) {

            $idProduct = $postDataArray['id'];

            //creating product array
            $productArray = [
                'id'          =>  $idProduct,
                'name'        =>  $postDataArray['name'],
                'category'    =>  $postDataArray['category'],
                'bar_code'    =>  $postDataArray['bar_code'],
                'type'        =>  $postDataArray['type'],
                'description' =>  $postDataArray['description'],
            ];

            //updating product
            $product->updateProduct($productArray);

            //creating lot array
            $lotArray = [
                'id_product'     => $idProduct,
                'batch'          => $postDataArray['batch'],
                'amount'         => $postDataArray['amount'],
                'weight'         => $postDataArray['weight'],
                'due_date'       => $postDataArray['due_date'],
                'purchase_price' => $postDataArray['purchase_price'],
                'sale_value'     => $postDataArray['sale_value'],
                'tax'            => $postDataArray['tax'],
            ];

            //Update or create the batch as needed
            $lots->updateOrCreateLot($lotArray);

            if(isset($postDataArray['quantity_damage']) && isset($postDataArray['details_breakdown'])){
                
                //creating breakdowns arrayc
                $breakdownsArray = [
                    'id_product'        => $idProduct,
                    'quantity_damage'   => $postDataArray['quantity_damage'],
                    'details_breakdown' => $postDataArray['details_breakdown'],
                ];

                //Updates or creates break data as needed
                $breakdowns->updateOrCreateBreakdown($breakdownsArray);
            }


            http_response_code(200);
            echo json_encode(['Produto atualizado com sucesso.']);
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
    echo json_encode(['Ocorreu um erro ao atualizar os dados do produto.']);
}
