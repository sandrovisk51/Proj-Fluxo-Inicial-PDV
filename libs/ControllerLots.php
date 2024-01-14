<?php

namespace Libs;

class ControllerLots
{
    private $cn;
    private $commandModel;


    //establishing connection with database
    public function __construct($table)
    {
        $this->cn = new Connection();
        $this->commandModel = new ModelCommand($this->cn->getConnection(), $table);
    }

    //inserting a lot
    public function registerLot(array $data)
    {
        return $this->commandModel->register($data);
    }

    //editing lot
    public function editLot(array $data)
    {
        return $this->commandModel->edit($data);
    }

    //update a lot
    public function updateLot(array $data)
    {
        return $this->commandModel->update($data);
    }

    public function checkLot(array $idProduct)
    {
        $lotData = $this->editLot($idProduct);
        return $lotData[0]['id'] ?? false;
    }

    //create or update batch
    public function updateOrCreateLot(array $data)
    {
        $idProduct['id_product'] = $data['id_product'];
        $idLot = $this->checkLot($idProduct);

        if (is_numeric($idLot)) {
            //updating lot
            $data['id'] = $idLot;
            $this->updateLot($data);
        } else {
            //creating batch
            $data['date_create'] = date('Y-m-d H:i:s');
            $this->registerLot($data);
        }
    }

    //count a product the lots
    public function countLotsProduct(array $filters, int $index)
    {
        return $this->commandModel->countRecords($filters, $index);
    }

    //list of products out of stock
    public function listLotsProductStock(array $filters, int $index)
    {
        return $this->commandModel->listDynamic($filters, $index);
    }
}
