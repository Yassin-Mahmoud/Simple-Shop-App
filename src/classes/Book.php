<?php
namespace MyApp\classes;
use MyApp\classes\products;
class book extends products{
  static protected $columns = ['id', 'sku', 'name', 'price', 'weight'];

  public function __construct($inputs=[]){
    $this->sku = $inputs['sku'];
    $this->name = $inputs['name'];
    $this->price = $inputs['price'];
    $this->weight = $inputs['weight'];
  }
}

?>