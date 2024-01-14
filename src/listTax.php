<?php

require_once __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/../procs/tax.php';


try {
    header("Content-Type: application/json; charset=UTF-8");

    //returns the list of tax by name
    $listTax = $tax->listTax('type');

    http_response_code(200);
    //Creates a json of the listed taxes
    echo json_encode($listTax);

} catch (Exception $e) {

    http_response_code(400);
    echo json_encode(['Ocorreu um erro ao listar impostos.']);
}
