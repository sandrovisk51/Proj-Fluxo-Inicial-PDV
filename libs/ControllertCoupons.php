<?php

namespace Libs;

class ControllertCoupons
{
    private $cn;
    private $commandModel;


    //establishing connection with database
    public function __construct($table)
    {
        $this->cn = new Connection();
        $this->commandModel = new ModelCommand($this->cn->getConnection(), $table);
    }

    //entering coupon data
    public function registerCupomData(array $data)
    {
        return $this->commandModel->registerDynamic($data);
    }

}
