<?php
namespace MyApp\classes;
use MyApp\classes\products;
class dvd extends products{
  static protected $columns = ['id', 'sku', 'name', 'price', 'size'];
  public function __construct($inputs=[]) {
    $this->sku = $inputs['sku'];
    $this->name = $inputs['name'];
    $this->price = $inputs['price'];
    $this->size = $inputs['size'];
  }
}

?>