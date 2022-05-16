<?php

class City
{
    private $data_base;
    private $table_name = "city";

    public $id;
    public $name;

    public function __construct($db) //создание экземпляра класса City, подключение к необходимой базе данных
    {
        $this->data_base = $db;
    }

    function get()
    {
        $query = "SELECT * fROM ". $this -> table_name;
        $statement = $this -> data_base -> prepare($query);
        $statement -> execute();

        return ($statement);


    }

    function create ()
    {
        $query = "INSERT INTO ". $this -> table_name . " SET name = :name";
        $statement = $this -> data_base -> prepare($query);
        $statement -> bindParam(":name", $this -> name);



        if ($statement->execute()){
            return true;
        }
        print_r($statement->errorInfo());
        return false;

    }

    function update ()
    {
        $query = " UPDATE ". $this->table_name. " SET name=:name WHERE id=:id ";
        $statement = $this->data_base->prepare($query);
        $statement->bindParam(":name", $this->name);
        $statement->bindParam(":id", intval($this->id));

        if ($statement->execute()){
            return true;
        }
        print_r($statement->errorInfo());
        return false;

    }

    function delete()
    {
        $query = "DELETE FROM ". $this->table_name. " WHERE id=:id";
        $statement = $this->data_base->prepare($query);

        $statement->bindParam(':id',intval($this->id));

        if ($statement->execute())
        {
            return true;
        }
        print_r($statement->errorInfo());
        return false;

    }

}
