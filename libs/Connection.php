<?php
namespace Libs;

use \PDO;

class Connection {
    private $host       = 'localhost';
    private $user       = 'postgres';
    private $password   = 'postgre';
    private $bank       = 'db_estoque';

    protected $connection;

    public function __construct() {
        $this->connection = new PDO("pgsql:host=$this->host;dbname=$this->bank", $this->user, $this->password);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getConnection() {
        return $this->connection;
    }
}
?>