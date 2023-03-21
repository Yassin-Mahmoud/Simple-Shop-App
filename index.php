<?php
use MyApp\classes\products;

include_once("src/init.php");

$getProducts = products::selectAll();

if ($_SERVER["REQUEST_METHOD"] == 'POST' && isset($_POST['delete'])) {
  products::delete();
}

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset='utf-8'>
  <meta http-equiv='X-UA-Compatible' content='IE=edge'>
  <title>Product List</title>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <link rel="stylesheet" href="css/all.min.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="js/all.min.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>
</head>

<body>

  <div class="container">

    <form action="" method="post">
      <!-- Nav -->
      <div class="form-group row m-lg-2 mt-lg-3">
        <h3 for="colFormLabel" class="col-sm-2 col-lg-9">Product List</h3>
        <div class="col-sm-10 col-lg-3">
          <a href="/task/productAdd.php"><button type="button" class="btn btn-primary" name="ADD">Add</button></a>
          <button type="submit" name="delete" id="delete-product-btn" class="btn btn-primary">MASS DELETE</button>
        </div>
      </div>
      <!-- End Nav -->

      <hr>

      <!-- Card -->
      <div class="row">
        <?php foreach ($getProducts as $product) { ?>
        <div class="card text-center bg-white mb-3 m-1" style="max-width: 17.3rem;">

          <!-- Card Header -->
          <div class="card-header row">
            <div class="col-1">
              <input class="delete-checkbox" type="checkbox" name="deleteCheck[]" value="<?= $product->sku ?>">
            </div>
            <span class="col-9 mx-1"><?php echo $product->sku ?></span>
          </div>

          <!-- Card Body -->
          <div class="card-body">
            <h5 class="card-title"><?php echo $product->name ?></h5>
            <span><?php echo $product->price ?> $</span>
            <p class="card-text">
              <?php
                echo $product->size != 0 ? "Size: " . $product->size . " MB" : '';
                echo $product->weight != 0 ? "Weight: " . $product->weight . "KG" : '';
                echo $product->dimensions != '0x0x0' ? "Dimensions: " . $product->dimensions: '';
              ?>
            </p>
          </div>
        </div>
        <?php } ?>
      </div>

    </form>

  </div>


  </nav>
</body>

</html>