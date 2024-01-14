<?php

namespace Libs;

class ControllerBreakdowns
{
    private $cn;
    private $commandModel;


    //establishing connection with database
    public function __construct($table)
    {
        $this->cn = new Connection();
        $this->commandModel = new ModelCommand($this->cn->getConnection(), $table);
    }

    //inserting a Breakdowns
    public function registerBreakdowns(array $data)
    {
        return $this->commandModel->register($data);
    }

    //editing Breakdowns
    public function editBreakdowns(array $data)
    {
        return $this->commandModel->edit($data);
    }

    //update a Breakdowns
    public function updateBreakdowns(array $data)
    {
        return $this->commandModel->update($data);
    }

    public function checkBreakdowns(array $idProduct)
    {
        $breakdownsData = $this->editBreakdowns($idProduct);
        return $breakdownsData[0]['id'] ?? false;
    }

    //create or update fault
    public function updateOrCreateBreakdown(array $data)
    {
        $idProduct['id_product'] = $data['id_product'];
        $idBreakdowns = $this->checkBreakdowns($idProduct);

        if (is_numeric($idBreakdowns)) {
            //updating Breakdowns
            $data['id'] = $idBreakdowns;
            $this->updateBreakdowns($data);
        } else {
            //creating Breakdowns
            $data['date_create'] = date('Y-m-d H:i:s');
            $this->registerBreakdowns($data);
        }
    }

    //count a breakdowns
    public function countBreakdowns(array $filters, int $index)
    {
        return $this->commandModel->countRecords($filters, $index);
    }

}
