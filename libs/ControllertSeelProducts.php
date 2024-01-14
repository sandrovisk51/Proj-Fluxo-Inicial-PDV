<?php

namespace Libs;

class ControllertSeelProducts
{
    private $cn;
    private $commandModel;


    //establishing connection with database
    public function __construct($table)
    {
        $this->cn = new Connection();
        $this->commandModel = new ModelCommand($this->cn->getConnection(), $table);
    }

    //inserting sold products
    public function registerSoldProduct(array $data)
    {
        return $this->commandModel->registerDynamic($data);
    }


}
