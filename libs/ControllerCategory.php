<?php

namespace Libs;

class ControllerCategory
{
    private $cn;
    private $commandModel;


    //establishing connection with database
    public function __construct($table)
    {
        $this->cn = new Connection();
        $this->commandModel = new ModelCommand($this->cn->getConnection(), $table);
    }

    //category list
    public function listCategory($order)
    {
        return $this->commandModel->list($order);
    }

    //inserting a category
    public function registerCategory(array $data)
    {
        return $this->commandModel->register($data);
    }

    //update a category
    public function updateCategory(array $data)
    {
        return $this->commandModel->update($data);
    }

    //delete a category
    public function deleteCategory($id)
    {
        return $this->commandModel->delete($id);
    }
}
