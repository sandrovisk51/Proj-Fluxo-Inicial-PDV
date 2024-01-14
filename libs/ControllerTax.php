<?php

namespace Libs;

class ControllerTax
{
    private $cn;
    private $commandModel;


    //establishing connection with database
    public function __construct($table)
    {
        $this->cn = new Connection();
        $this->commandModel = new ModelCommand($this->cn->getConnection(), $table);
    }

    //tax list
    public function listTax($order)
    {
        return $this->commandModel->list($order);
    }

    //inserting a tax
    public function registerTax(array $data)
    {
        return $this->commandModel->register($data);
    }

    //editing a tax
    public function editTax(array $data)
    {
        return $this->commandModel->edit($data);
    }

    //update a tax
    public function updateTax(array $data)
    {
        return $this->commandModel->update($data);
    }

    //delete a tax
    public function deleteTax($id)
    {
        return $this->commandModel->delete($id);
    }

    //calculate tax and price 
    public function calculateTax($productData, $lotsData, $taxData, $qtd){

        $idItem       = $productData[0]['id'];
        $nameItem     = $productData[0]['name'];
        $priceItem    = preg_replace('/[^\d.,]/i', '', $lotsData[0]['sale_value']);
        $totalItem    = number_format($priceItem * $qtd, 2, ".", ",");
        $taxItem      = $taxData[0]['percentage'];
        $totalTaxItem = number_format(($taxItem * $qtd) * $totalItem / 100, 2, ".", ",");
    
        return [
            'id_item'          => $idItem,
            'name_item'        => $nameItem,
            'price_item'       => $priceItem,
            'qtd_item'         => $qtd,
            'total_value_item' => $totalItem,
            'total_tax_item'   => $totalTaxItem,
        ];

        
    }
}
