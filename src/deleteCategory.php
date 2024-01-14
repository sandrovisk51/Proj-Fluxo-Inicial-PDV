<?php

require_once __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/../procs/category.php';


if ($id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT)) {

    //delete category
    if ($category->deleteCategory($id)) {

        http_response_code(200);
        echo json_encode(['Categoria deletada com sucesso.']);

    } else {

        http_response_code(400); 
        echo json_encode(['Houve um erro ao deletar esta Categoria.']);

    };
} else {

    http_response_code(400); 
    echo json_encode(['Os dados enviados não são válidos.']);

}
