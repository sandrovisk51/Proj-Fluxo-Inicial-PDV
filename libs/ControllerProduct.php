<?php

namespace Libs;

class ControllerProduct
{
    private $cn;
    private $commandModel;


    //establishing connection with database
    public function __construct($table)
    {
        $this->cn = new Connection();
        $this->commandModel = new ModelCommand($this->cn->getConnection(), $table);
    }

    //inserting a product
    public function registerProduct(array $data)
    {
        return $this->commandModel->register($data);
    }

    //editing product
    public function editProduct(array $data)
    {
        return $this->commandModel->edit($data);
    }

    //search product
    public function searchProduct(array $data)
    {
        return $this->commandModel->search($data);
    }

    //update a product
    public function updateProduct(array $data)
    {
        return $this->commandModel->update($data);
    }

    //count a product
    public function countProduct(array $filters, int $index)
    {
        return $this->commandModel->countRecords($filters, $index);
    }

    //list a product
    public function listProduct($order)
    {
        return $this->commandModel->list($order);
    }

    //delete a product
    public function deleteProduct($id)
    {
        return $this->commandModel->delete($id);
    }
}
