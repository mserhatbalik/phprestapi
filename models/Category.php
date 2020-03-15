<?php

class Category
{
  // DB Properties
  private $conn;
  private $table = 'categories';

  // Category Properties
  public $id;
  public $name;
  public $created_at;

  public function __construct($db)
  {
    $this->conn = $db;
  }

  public function read()
  {
    $query = 'SELECT * FROM ' . $this->table;

    $stmt = $this->conn->prepare($query);

    $stmt->execute();
    return $stmt;
  }

  public function readSingle()
  {
    $query = 'SELECT * FROM ' . $this->table .
      ' WHERE id = :id';

    $stmt = $this->conn->prepare($query);

    $stmt->bindValue(':id', $this->id);

    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $this->id = $row['id'];
    $this->name = $row['name'];
    $this->created_at = $row['created_at'];
  }
}
