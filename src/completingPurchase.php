<?php

require_once __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/../procs/coupons.php';
require_once __DIR__ . '/../procs/seelProducts.php';

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $postData = file_get_contents('php://input');
        $postDataArray = json_decode($postData, true);

        if (!empty($postDataArray)) {

            //creating coupons array
            $couponsArray = [
                'operator'          =>  1,
                'date'              =>  date('Y-m-d H:i:s'),
                'total'             =>  $postDataArray['total'],
                'payment_method'    =>  $postDataArray['method'],
                'total_tax'         =>  $postDataArray['tax'],
                'amount_received'   =>  $postDataArray['received'] ?? 0,
            ];

            //registering coupon
            $idCoupon  = $coupons->registerCupomData($couponsArray);

            if (is_numeric($idCoupon)) {

                $listPurchasedItems =  $postDataArray['items'];
                
                foreach ($listPurchasedItems as $item) {

                    $itemData = [
                        'id_coupon'        => $idCoupon,
                        'id_product'       => $item['id_item'],
                        'amount'           => $item['qtd_item'],
                        'date'             => date('Y-m-d H:i:s'),
                    ];
                    //registering items
                    $seelProducts->registerSoldProduct($itemData);
                }
            } else {
                http_response_code(400);
                exit(json_encode(['Falha ao tentar baixar itens vendidos.']));
            }

            http_response_code(200);
            echo json_encode(['Venda concluida com sucesso!']);
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
    echo json_encode(['Ocorreu um erro ao finalizar esta compra.']);
}
