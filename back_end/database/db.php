<?php

class Database
{
    protected $conn;
    public $dbname = 'expensetracker';

    public function init()
    {
        $this->conn = new mysqli('localhost','root','');
        $this->conn->query("CREATE DATABASE IF NOT EXISTS $this->dbname");
        $this->conn->query("USE $this->dbname");
    }
}
?>