<?php

require_once __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/../procs/product.php';
require_once __DIR__ . '/../procs/lots.php';
require_once __DIR__ . '/../procs/breakdowns.php';

try {
    if ($id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT)) {

        $idArray       =  ['id' => $id];
        $idProdutArray =  ['id_product' => $id];

        //locating data for each item
        $productData    = $product->editProduct($idArray);
        $lotsData       = $lots->editLot($idProdutArray);
        $breakdownsData = $breakdowns->editBreakdowns($idProdutArray);

        //removing unnecessary items
        if ($lotsData) {
            unset(
                $lotsData[0]['id'],
                $lotsData[0]['date_create'],
                $lotsData[0]['id_product'],
            );
        }

        if ($breakdownsData) {
            unset(
                $breakdownsData[0]['id'],
                $breakdownsData[0]['date_create'],
                $breakdownsData[0]['id_product']
            );
        }

        //associating all data into a single array
        if($productData)    $allData[] = $productData[0];
        if($lotsData)       $allData[] = $lotsData[0];
        if($breakdownsData) $allData[] = $breakdownsData[0];

        //joined array
        if($productData && $lotsData){
            $mergedArray = call_user_func_array('array_merge_recursive', $allData);
        }else{
            $mergedArray = $allData[0];
        }

        header("Content-Type: application/json; charset=UTF-8");

        //Creates a json
        http_response_code(200);
        echo json_encode($mergedArray);
    } else {

        http_response_code(400);
        echo json_encode(['Os dados enviados não são válidos.']);
    }
} catch (Exception $e) {

    http_response_code(400);
    echo json_encode(['Ocorreu um erro ao processar os dados.']);
}
