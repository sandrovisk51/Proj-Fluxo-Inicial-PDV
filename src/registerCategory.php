<?php

require_once __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/../procs/category.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $postData = file_get_contents('php://input');
    $postDataArray = json_decode($postData, true);

    //inserting current date into array
    $postDataArray['date_create'] = date('Y-m-d H:i:s');

    if (!empty($postDataArray)) {

        //inserting the catgory form data
        $categoryData = $category->registerCategory($postDataArray);

        if ($categoryData) {

            header("Content-Type: application/json; charset=UTF-8");

            //added returned id
            $postDataArray['id'] = $categoryData;
            //returning the registered rate data
            http_response_code(200);
            echo json_encode($postDataArray);
        } else {

        http_response_code(400); 
        echo json_encode(['Houve um erro ao cadastrar esta categoria.']);
            
        };
    } else {
        
        http_response_code(400); 
        echo json_encode(['Os dados foram recebidos em branco.']);
    }
} else {
    
    http_response_code(400); 
    echo json_encode(['Os dados do formulário não foram enviados.']);
}
