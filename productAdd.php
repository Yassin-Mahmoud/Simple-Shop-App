<?php

use MyApp\classes\DVD;
use MyApp\classes\Book;
use MyApp\classes\Furniture;

include_once("src/init.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $result = '';
  $inputs = [];
  $inputs['sku'] = $_POST['sku'];
  $inputs['name'] = $_POST['name'];
  $inputs['price'] = $_POST['price'];
  $inputs['size'] = $_POST['size'];
  $inputs['weight'] = $_POST['weight'];
  $inputs['width'] = $_POST['width'];
  $inputs['length'] = $_POST['length'];
  $inputs['height'] = $_POST['height'];

  /* to validate SKU */
  global $database;
  $sql = "SELECT * FROM products WHERE sku = '" . $_POST['sku'] . "'";
  $result = $database->query($sql);

  if (mysqli_num_rows($result) > 0 && !is_numeric($_POST['name']) && !empty($_POST['price'])) {
    $sameSkuErr = "* This SKU already exists, please provide a unique SKU for each product.";

  } else {

    if ($_POST['typeSwitcher'] == '1' && !empty($_POST['size'])) {
      $dvd = new dvd($inputs);
      $result = $dvd->save();
    } else if ($_POST['typeSwitcher'] == '2' && !empty($_POST['weight'])) {
      $book = new book($inputs);
      $result = $book->save();
    } else if ($_POST['typeSwitcher'] == '3' && !empty($_POST['width']) && !empty($_POST['length']) && !empty($_POST['height'])) {
      $furniture = new furniture($inputs);
      $result = $furniture->save(); 
    } else {
      $errMsg = "* Please, submit required data.";
    }
  
    if ($result === true) {
      header('Location: index.php');
      exit;
    } else {
  
    }
  
  }


}

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset='utf-8'>
  <meta http-equiv='X-UA-Compatible' content='IE=edge'>
  <title>Product Add</title>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <link rel="stylesheet" href="css/all.min.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="js/all.min.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>
  <style>
  #size_container,
  #weight_container,
  #dimensions_container {
    display: none;
  }

  span {
    color: red;
  }
  </style>
</head>

<body>

  <div class="container">
    <form id="product_form" method="post" action="">
      <!-- Nav -->
      <div class=" form-group row m-lg-2 mt-lg-3">
        <h3 for="colFormLabel" class="col-sm-2 col-lg-10">Product Add</h3>
        <div class="col-sm-10 col-lg-2">
          <button type="submit" name="submit" id="submit" class="btn btn-primary">Save</button>
          <a href="/task/index.php"><button type="button" class="btn btn-primary">Cancel</button></a>
        </div>
      </div>
      <!-- End Nav -->

      <hr>

      <!--  -->
      <div class=" form-group row m-1">
        <label for="colFormLabel" class="col-sm-2 col-form-label col-lg-1">SKU</label>
        <div class="col-sm-10 col-lg-3">
          <input type="text" class="form-control" id="sku" name="sku" pattern="[a-zA-Z0-9]+"
            title="SKU must be only letters &/or numbers" value="<?= $_POST['sku'] ?? '';  ?>" required>
        </div>
        <span class="col-lg-6"><?php echo $sameSkuErr ?></span>
      </div>

      <div class="form-group row m-1">
        <label for="colFormLabel" class="col-sm-2 col-form-label col-lg-1">Name</label>
        <div class="col-sm-10 col-lg-3">
          <input type="text" class="form-control" id="name" name="name" pattern="[A-Za-z ]+"
            title="Name must be only letters." value="<?= $_POST['name'] ?? '';  ?>" required>
        </div>
      </div>

      <div class=" form-group row m-1">
        <label for="colFormLabel" class="col-sm-2 col-form-label col-lg-1">Price</label>
        <div class="col-sm-10 col-lg-3">
          <input type="number" class="form-control" id="price" name="price" step="1"
            value="<?= $_POST['price'] ?? '';  ?>" required>
        </div>
      </div>

      <div class=" form-group row m-lg-1 mt-lg-5">
        <label for="colFormLabel" class="col-sm-2 col-form-label col-lg-2">Type Switcher</label>
        <select class="custom-select col-lg-3" id="productType" name="typeSwitcher">
          <option selected disabled>Choose product type</option>
          <option value="1">DVD</option>
          <option value="2">Book</option>
          <option value="3">Furniture</option>
        </select>
        <span class="col-lg-6"><?php echo $errMsg ?></span>
      </div>
      <!-- -->

      <!--  -->
      <div class="form-group row m-1 mt-lg-5" id="size_container">
        <label for="colFormLabel" class="col-sm-2 col-form-label col-lg-1">Size (MB)</label>
        <div class="col-sm-10 col-lg-3">
          <input type="number" class="form-control" id="size" name="size" step="1">
          <p>Please provide size in (MB)</p>
        </div>
      </div>

      <div class="form-group row m-1 mt-lg-5" id="weight_container">
        <label for="colFormLabel" class="col-sm-2 col-form-label col-lg-2">Weight (KG)</label>
        <div class="col-sm-10 col-lg-3">
          <input type="number" class="form-control" id="weight" name="weight" step="1">
          <p>Please provide weight in (KG)</p>
        </div>
      </div>

      <div class="form-group m-3 mt-lg-5" id="dimensions_container">
        <label for="colFormLabel" class="col-sm-2 col-form-label col-lg-1">Width (CM)</label>
        <div class="col-sm-10 col-lg-3">
          <input type="number" class="form-control" id="width" name="width" step="1">
          <p>Please provide width in (CM)</p>
        </div>

        <label for="colFormLabel" class="col-sm-2 col-form-label col-lg-1">Height (CM)</label>
        <div class="col-sm-10 col-lg-3">
          <input type="number" class="form-control" id="height" name="height" step="1">
          <p>Please provide height in (CM)</p>
        </div>

        <label for="colFormLabel" class="col-sm-2 col-form-label col-lg-1">Length (CM)</label>
        <div class="col-sm-10 col-lg-3">
          <input type="number" class="form-control" id="length" name="length" step="1">
          <p>Please provide length in (CM)</p>
        </div>
      </div>
      <!--  -->

    </form>
  </div>


  <script>
  const switcher = document.getElementById("productType");
  const sizeContainer = document.getElementById("size_container");
  const weightContainer = document.getElementById("weight_container");
  const dimensionsContainer = document.getElementById("dimensions_container");

  switcher.onchange = () => {

    if (switcher.value == "1") {
      sizeContainer.style.display = "block";
      weightContainer.style.display = "none";
      dimensionsContainer.style.display = "none";

    } else if (switcher.value == "2") {
      sizeContainer.style.display = "none";
      weightContainer.style.display = "block";
      dimensionsContainer.style.display = "none";

    } else if (switcher.value == "3") {
      sizeContainer.style.display = "none";
      weightContainer.style.display = "none";
      dimensionsContainer.style.display = "block";
    }
  };
  </script>
</body>

</html>