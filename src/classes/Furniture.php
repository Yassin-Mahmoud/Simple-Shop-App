<?php

namespace MyApp\classes;
use MyApp\classes\products;

class furniture extends products{
  static protected $columns = ['id', 'sku', 'name', 'price', 'dimensions'];

  public function __construct($inputs=[]){
    $this->sku = $inputs['sku'];
    $this->name = $inputs['name'];
    $this->price = $inputs['price'];
    $this->length = $inputs['length'];
    $this->width = $inputs['width'];
    $this->height = $inputs['height'];
  }

  public function save(){
    $attributes = $this->attributes();
    $dimensions = $this->arrayToString("[$this->height, $this->width, $this->length]");
    $sql = "INSERT INTO products (" . join(", ", array_keys($attributes)) . ") VALUES (";
    $sql .= "'" . $this->sku . "', '" . $this->name . "', '" . $this->price . "', '" . $dimensions . "');";

    $result = self::$database->query($sql);
    return $result;
  }

  protected function arrayToString($dimensionsData) {
    $arr = ['[', ']'];
    $replacedString = str_replace($arr, ' ', $dimensionsData);
    $newArray = explode(', ', $replacedString);
    $string = implode('x', $newArray);
    return $string;
  }
}

?>