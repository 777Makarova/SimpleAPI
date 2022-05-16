<?php

class User
{

    private $conn;
    private $table_name = "users";

    public $id;
    public $name;
    public $city_id;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    function get()
    {

        $query = "SELECT * FROM " . $this->table_name ;

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;
    }

    function create()
    {

        $query = "INSERT INTO " . $this->table_name . " SET name=:name, city_id=:city_id";

        $stmt = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->city_id = htmlspecialchars(strip_tags($this->city_id));

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":city_id", $this->city_id);

        if ($stmt->execute()) {
            return true;
        }
        print_r($stmt->errorInfo());
        return false;
    }

    function update(){

        $query = " UPDATE " . $this->table_name . " SET name = :name, city_id = :city_id WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->city_id=htmlspecialchars(strip_tags($this->city_id));
//        $this->id=htmlspecialchars(strip_tags($this->id));


        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':city_id', $this->city_id);
        $stmt->bindParam(':id', intval($this->id));


        if ($stmt->execute()) {
            return true;
        }
        print_r($stmt->errorInfo());
        return false;
    }

    function delete(){

        $query = "DELETE FROM " . $this->table_name . " WHERE id =:id";

        $stmt = $this->conn->prepare($query);

//        $this->id=htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(':id',intval($this->id));

        if ($stmt->execute()) {
            return true;
        }
        print_r($stmt->errorInfo());
        return false;
    }

}


