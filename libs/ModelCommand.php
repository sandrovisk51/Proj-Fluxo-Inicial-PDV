<?php

namespace Libs;

use \PDO;

class ModelCommand
{

    private $cn;
    private $tb;

    //building the connection
    public function __construct($connection, $table)
    {
        $this->cn = $connection;
        $this->tb = $table;
    }

    //extracting data from array
    public function extractData(array $data)
    {
        $columns = implode(', ', array_keys($data));
        $placeholders = implode(', ', array_fill(0, count($data), '?'));

        return compact('columns', 'placeholders');
    }

    //extracting data from array in search mode
    public function extractDataSearch(array $data, $index = 0)
    {
        $dataFilter = ['=', '>', '<', '>=', '<=', '<>'];

        $columnsX  = implode(" ILIKE ? OR ", array_keys($data)) . " ILIKE ? ";
        $columnsY  = implode(" = ? AND ", array_keys($data)) . " = ?";
        $columnsZ  = implode(" $dataFilter[$index]  ? AND ", array_keys($data)) . " $dataFilter[$index]  ?";

        return compact('columnsX', 'columnsY', 'columnsZ');
    }

    //extracting data from array in update mode
    public function extractDataUpdate(array $data)
    {
        $columnCustom = implode(', ', array_map(function ($column) {
            return "$column = ?";
        }, array_keys($data)));

        return $columnCustom;
    }

    //adding a new record
    public function register(array $data)
    {
        try {
            $activeColumns = $this->extractData($data);

            $table =  $this->tb;

            $sql = sprintf("INSERT INTO $table (%s) VALUES (%s)", $activeColumns['columns'], $activeColumns['placeholders']);

            $stmt = $this->cn->prepare($sql);
            $stmt->execute(array_values($data));

            $lastInsertedId = $this->cn->lastInsertId();

            return $lastInsertedId;
        } catch (\PDOException $e) {
            return false;
        }
    }

    //locating information to be edited
    public function edit(array $data)
    {
        try {

            $activeColumns = $this->extractDataSearch($data);

            $table =  $this->tb;

            $sql = sprintf("SELECT * FROM $table WHERE %s", $activeColumns['columnsY']);

            $stmt = $this->cn->prepare($sql);
            $stmt->execute(array_values($data));

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            return false;
        }
    }

    //updating a record
    public function update(array $data)
    {
        try {
            $table = $this->tb;
            $id    = $data['id'];
            unset($data['id']);

            $updateData = $this->extractDataUpdate($data);

            $data['id'] = $id;

            $sql = sprintf("UPDATE %s SET %s WHERE id = ?", $table, $updateData);


            $stmt = $this->cn->prepare($sql);
            $stmt->execute(array_values($data));

            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }

    //deleting a record
    public function delete($id)
    {
        try {
            $table = $this->tb;

            $stmt = $this->cn->prepare("DELETE FROM $table WHERE id = ?");
            $stmt->execute([$id]);
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }

    //adding a new record dynamic
    public function registerDynamic(array $data)
    {
        try {
            $activeColumns = $this->extractData($data);

            $table =  $this->tb;

            // Start the transaction
            $this->cn->beginTransaction();

            $sql = sprintf("INSERT INTO $table (%s) VALUES (%s)", $activeColumns['columns'], $activeColumns['placeholders']);

            $stmt = $this->cn->prepare($sql);
            $stmt->execute(array_values($data));

            $lastInsertedId = $this->cn->lastInsertId();

            // Confirm the transaction
            $this->cn->commit();

            return $lastInsertedId;
        } catch (\PDOException $e) {
            // In case of error, perform rollback
            if ($this->cn->inTransaction()) {
                $this->cn->rollBack();
            }
            return false;
        }
    }
    
    //generates a general luster
    public function list($order)
    {
        try {

            $table =  $this->tb;

            $sql = sprintf("SELECT * FROM $table ORDER BY $order ASC");

            $stmt = $this->cn->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            return false;
        }
    }

    //generate dynamic list
    public function listDynamic(array $filters, int $index)
    {
        try {

            $activeColumns = $this->extractDataSearch($filters,  $index);

            $table =  $this->tb;

            $sql = sprintf("SELECT * FROM $table WHERE %s", $activeColumns['columnsZ']);

            $stmt = $this->cn->prepare($sql);
            $stmt->execute(array_values($filters));

            return  $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (\PDOException $e) {
            return false;
        }
    }

    //counting records
    public function countRecords(array $filters, int $index)
    {
        try {

            $activeColumns = $this->extractDataSearch($filters,  $index);

            $table =  $this->tb;

            $sql = sprintf("SELECT COUNT(*) as qtd FROM $table WHERE %s", $activeColumns['columnsZ']);

            $stmt = $this->cn->prepare($sql);
            $stmt->execute(array_values($filters));

            $result =  $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $result[0]['qtd'] ?? 0;
        } catch (\PDOException $e) {
            return false;
        }
    }

    //search records
    public function search(array $data)
    {
        try {

            $activeColumns = $this->extractDataSearch($data);

            $searchConditions = array_values($data);
            $searchValues = [];

            foreach ($searchConditions as $value) {
                $searchValues[] = "%{$value}%";
            }

            $table =  $this->tb;

            $sql = sprintf("SELECT * FROM $table WHERE %s", $activeColumns['columnsX']);

            $stmt = $this->cn->prepare($sql);
            $stmt->execute(array_values($searchValues));

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            return false;
        }
    }
}
