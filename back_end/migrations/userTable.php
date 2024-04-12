<?php
include "../database/db.php";

class createUserTable extends Database
{
    public $tblname = 'user';

    public function createTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS $this->tblname(
            id int primary key auto_increment,
            first_name varchar(255) not null,
            last_name varchar(255) not null,
            email varchar(40) not null UNIQUE,
            password varchar(255) not null
        )engine=InnoDB";

        $this->init();
        $this->conn->query($sql);

        if($this->conn->error == " ")
        {
            echo "Table User Unsuccessfully Created \n";
        } else {
            echo "Table User Created Successfully \n";
        }
       
    }
}
$migrate = new createUserTable();
$migrate->createTable();
?>