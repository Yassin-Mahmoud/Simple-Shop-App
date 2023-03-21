<?php

namespace MyApp\classes;

class products{
  public $id;
  public $sku;
  public $name;
  public $price;
  public $size;
  public $weight;
  public $width;
  public $length;
  public $height;
  public $dimensions;
  static protected $database;
  static protected $columns = [];

  static public function setDatabase($database) {
    self::$database = $database;
  }

  /* save product to database */
  public function save() {
    $attributes = $this->attributes();
    $sql = "INSERT INTO products (" . join(', ', array_keys($attributes)) . ") VALUES ('" . join("', '", array_values($attributes)) . "')";
    $result = self::$database->query($sql);
    return $result;
  }

  /* delete product from database */
  static public function delete() {
    $productSku = implode("', '", $_POST['deleteCheck']);

    $sql = "DELETE FROM products WHERE sku IN ('" . $productSku . "');";
    $result = self::$database->query($sql);

    if ($result) {
      header("Location: index.php");
    } else {
      echo 'Database failed to delete products.';
    }
  }

  /* select all products from the database */
   static public function selectAll() {
    $sql = "SELECT * FROM products";
    $result = self::$database->query($sql);
    if (!$result) {
      exit("Database failed to fetch products");
    }

    $array = [];
    while ($data = $result->fetch_assoc()) {
      $array[] = self::dbDataToObject($data);
    }
    $result->free();
    return $array;
  }

  /* get attributes and values from the class */
  public function attributes() {
    $attributes = [];
    foreach (static::$columns as $column) {
      if ($column == 'id') {
        continue;
      }
      $attributes[$column] = $this->$column;
    };
    return $attributes;
  }

  /* change db data into object */
  static protected function dbDataToObject($data) {
    $object = new self;
    foreach ($data as $property => $value) {
      if (property_exists($object, $property)) {
        $object->$property = $value;
      };
    }
    return $object;
  }

}

?>