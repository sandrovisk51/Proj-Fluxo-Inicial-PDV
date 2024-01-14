<?php

require_once __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/../procs/category.php';


try {

    header("Content-Type: application/json; charset=UTF-8");

    //returns the list of categories by name
    $listCategory = $category->listCategory('name_category');

    //Creates a json of the listed categories
    http_response_code(200);
    echo json_encode($listCategory);

} catch (Exception $e) {

    http_response_code(400);
    echo json_encode(['Ocorreu um erro ao listar categorias.']);
}
