<?php
  session_start();
  include('../../utils/connections.php');
  if (
    isset($_SESSION['user_credentials.username']) &&
    isset($_SESSION['user_credentials.type'])
  ) {
    if ($_SESSION['user_credentials.type'] != "customer") {
      header('Location: ../../admin/');
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>ICYLICIOUS&trade;</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    >
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/global.css" />
    <link rel="stylesheet" href="./css/info.css" />
  </head>
  <body>
    <nav class="navbar navbar-expand-lg fixed-top bg-dark">
      <div class="container">
        <a class="navbar-brand sans-600 color-white" href="./">ICYLICIOUS&trade;</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fa-solid fa-bars color-white"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link sans-regular size-11" aria-current="page" href="../../">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link sans-600 size-11 active" aria-current="page" href="../products/">Menu</a>
            </li>
            <li class="nav-item">
              <a class="nav-link sans-regular size-11" aria-current="page" href="../../index.php#reviews">Reviews</a>
            </li>
            <li class="nav-item">
              <a class="nav-link sans-regular size-11" aria-current="page" href="#contact-us">Contact Us</a>
            </li>
          </ul>
          <form class="d-flex">
            <?php
              if (isset($_SESSION['user_credentials.type'])) {
                $credentials = $_SESSION['user_credentials.type'];
                $cart_quantity = "";
                if (isset($_SESSION['user_info.email'])) {
                  $fetch_query = "SELECT * FROM cart WHERE user_email = '".$_SESSION['user_info.email']."'";
                  $result = $conn->query($fetch_query);
                  if ($result->num_rows > 0) {
                    $order_quantity = 0;
                    while ($cart_row = $result->fetch_assoc()) {
                      $order_quantity += intval($cart_row['order_quantity']);
                    }
                    $cart_quantity = " (". strval($order_quantity) . ") ";
                  }
                }
                if ($credentials === "customer") {
                  echo '
                    <button
                      id="btn-profile"
                      class="btn btn-sm btn-primary sans-500"
                      type="button">
                      <i class="fas fa-user-circle"></i>&nbsp;&nbsp;Account
                    </button>&nbsp;&nbsp;
                    <button
                      id="btn-shopping-cart"
                      class="btn btn-sm btn-outline-primary sans-500"
                      type="button">
                      <i class="fa fa-shopping-cart"></i>&nbsp;&nbsp;Shopping Cart'.$cart_quantity.'
                    </button>
                  ';
                } else {
                  echo '
                    <button
                      data-bs-toggle="modal"
                      data-bs-target="#staticLogin"
                      class="btn btn-sm btn-primary sans-500"
                      type="button">
                      Login
                    </button>&nbsp;&nbsp;
                    <button
                      data-bs-toggle="modal"
                      data-bs-target="#staticSignUp"
                      class="btn btn-sm btn-outline-primary sans-500"
                      type="button">
                      Sign Up
                    </button>
                  ';
                }
              } else {
                echo '
                  <button
                    data-bs-toggle="modal"
                    data-bs-target="#staticLogin"
                    class="btn btn-sm btn-primary sans-500"
                    type="button">
                    Login
                  </button>&nbsp;&nbsp;
                  <button
                    data-bs-toggle="modal"
                    data-bs-target="#staticSignUp"
                    class="btn btn-sm btn-outline-primary sans-500"
                    type="button">
                    Sign Up
                  </button>
                ';
              }
            ?>
          </form>
        </div>
      </div>
    </nav>
    <div class="content-wrapper">
      <form action="../actions/checkout.php" method="POST">
        <input
          type="hidden"
          name="category_id"
          value="<?php if (isset($_GET['category_id'])) echo $_GET['category_id']; ?>"
        />
        <input
          type="hidden"
          name="category_name"
          value="<?php if (isset($_GET['category_name'])) echo $_GET['category_name']; ?>"
        />
        <input
          type="hidden"
          name="category_description"
          value="<?php if (isset($_GET['category_description'])) echo $_GET['category_description']; ?>"
        />
        <input
          type="hidden"
          name="product_id"
          value="<?php if (isset($_GET['id'])) echo $_GET['id']; else echo 0; ?>"
        />
        <input
          type="hidden"
          name="customer_email"
          value="<?php if (isset($_SESSION['user_info.email'])) echo $_SESSION['user_info.email']; ?>"
        />
        <div class="container" style="padding-top: 50px;">
          <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-12">
              <?php
                $first_image = '';
                $second_image = '';
                $third_image = '';
                if (isset($_GET['id'])) {
                  $product_id = $_GET['id'];
                  // get product images
                  $products_images = array();
                  $fetch_query = "SELECT product_image FROM products_images WHERE product_id = ".$product_id."";
                  $images_result = $conn->query($fetch_query);
                  if ($images_result->num_rows > 0) {
                    while ($images_row = $images_result->fetch_assoc()) {
                      $product_image = $images_row['product_image'];
                      array_push($products_images, $product_image);
                    }
                  }
                  if (count($products_images) == 1) {
                    $first_image = array_values($products_images)[0];
                  } else if (count($products_images) == 2) {
                    $first_image = array_values($products_images)[0];
                    $second_image = array_values($products_images)[1];
                  } else if (count($products_images) == 3) {
                    $first_image = array_values($products_images)[0];
                    $second_image = array_values($products_images)[1];
                    $third_image = array_values($products_images)[2];
                  }
                  echo '
                    <img 
                      id="img-selected-product" 
                      src="../../admin/uploads/'.$first_image.'" 
                      class="img-selected-product"
                    />
                  ';
                }
              ?>
              <div class="div-img-product-selection">
                <?php
                  if ($first_image !== '') {
                    echo '
                      <div id="div-select-product-1" class="div-img-select-product active">
                        <img
                          id="img-select-product-1"
                          src="../../admin/uploads/'.$first_image.'" 
                          class="img-product-selection"
                        />
                      </div>
                    ';
                  } else {
                    echo '
                      <div class="div-img-select-product-inactive">
                      </div>
                    ';
                  }
                  if ($second_image !== '') {
                    echo '
                      <div id="div-select-product-2" class="div-img-select-product">
                        <img
                          id="img-select-product-2" 
                          src="../../admin/uploads/'.$second_image.'" 
                          class="img-product-selection"
                        />
                      </div>
                    ';
                  } else {
                    echo '
                      <div class="div-img-select-product-inactive">
                      </div>
                    ';
                  }
                  if ($third_image !== '') {
                    echo '
                      <div id="div-select-product-3" class="div-img-select-product">
                        <img
                          id="img-select-product-3"
                          src="../../admin/uploads/'.$third_image.'" 
                          class="img-product-selection"
                        />
                      </div>
                    ';
                  } else {
                    echo '
                      <div class="div-img-select-product-inactive">
                      </div>
                    ';
                  }
                ?>
              </div>
            </div>
            <div class="col-lg-7 col-md-7 col-sm-12 div-product-content">
              <h2 class="sans-700 color-dark-grey">
                <?php
                  if (isset($_GET['id'])) {
                    $product_id = $_GET['id'];
                    $fetch_query = "SELECT * FROM products_info WHERE id = ".$product_id."";
                    $result = $conn->query($fetch_query);
                    if ($result->num_rows > 0) {
                      $row = $result->fetch_assoc();
                      $product_name = $row['product_name'];
                      echo $product_name;
                    }
                  }
                ?>
              </h2>
              <p class="sans-regular color-super-light-grey">
                <?php
                  if (isset($_GET['id'])) {
                    $product_id = $_GET['id'];
                    $fetch_query = "SELECT * FROM products_info WHERE id = ".$product_id."";
                    $result = $conn->query($fetch_query);
                    if ($result->num_rows > 0) {
                      $row = $result->fetch_assoc();
                      $product_description_no_rn = str_replace('\r\n', '<br/>', $row['product_description']);
                      $product_description_no_sl = str_replace('\\', '', $product_description_no_rn);
                      $product_description_no_sn = str_replace('\n', '<br/>', $product_description_no_sl);
                      $product_description = $product_description_no_sn;
                      echo $product_description;
                    }
                  }
                ?>
              </p>
              <?php
                if (isset($_GET['id'])) {
                  $product_id = $_GET['id'];
                  $fetch_query = "SELECT 
                    PP.variant_id, 
                    PP.variant_price,
                    VT.variant_type, 
                    VT.variant_name  
                    FROM products_prices AS PP 
                    INNER JOIN variants AS VT 
                    ON PP.variant_id = VT.id 
                    WHERE product_id = ".$product_id."";
                  $result = $conn->query($fetch_query);
                  if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $variant_name = $row['variant_name'];
                    $variant_type = $row['variant_type'];
                    $variant_price = $row['variant_price'];
                    $variant_label = '
                      <div style="display: flex; flex-direction: row; sans-regular size-10 color-light-grey">
                        '.$variant_type.':&nbsp;&nbsp;
                        <span class="badge-size color-light-grey sans-regular size-10">
                          '.$variant_name.'
                        </span>
                      </div>
                      <div style="height: 20px;"></div>
                    ';
                    echo $variant_label;
                    if (isset($_SESSION['user_credentials.username'])) {
                      echo '
                        <div class="div-quantity">
                          <button id="quantity_add" type="button" class="btn btn-sm btn-success">
                            &nbsp;<i class="fa-solid fa-plus"></i>&nbsp;
                          </button>
                          <input
                            id="it_product_quantity"
                            type="text"
                            name="product_quantity"
                            readonly
                            value="1"
                            class="form-control sans-600"
                            style="width: 75px; text-align: center;"
                          />
                          <button id="quantity_minus" type="button" class="btn btn-sm btn-secondary">
                            &nbsp;<i class="fa-solid fa-minus"></i>&nbsp;
                          </button>
                        </div>
                      ';
                    }
                    $fetch_query = "SELECT * FROM promotions WHERE product_id = ".$product_id."";
                    $result = $conn->query($fetch_query);
                    if ($result->num_rows > 0) {
                      $row = $result->fetch_assoc();
                      $is_buy_x_take_x = $row['is_buy_x_take_x'];
                      $buy_x_of = $row['buy_x_of'];
                      $take_x_of = $row['take_x_of'];
                      $promotional_price = $row['promotional_price'];
                      if ($is_buy_x_take_x == 1) {
                        echo '
                          <div class="div-price-container" style="margin-top: 20px;">
                            <h3 class="color-dark-grey sans-bold">₱'.$variant_price.'</h3>
                          </div>
                        ';
                      } else {
                        echo '
                          <div class="div-price-container" style="margin-top: 20px;">
                            <h3 class="color-dark-grey sans-bold">₱'.$promotional_price.'</h3>
                            <h5 class="strike-price color-super-light-grey sans-regular">₱'.$variant_price.'</h5>
                          </div>
                        ';
                      }
                    }
                  }
                }
              ?>
              <?php
                if (isset($_SESSION['user_credentials.username'])) {
                  echo '
                    <div style="padding-top: 20px;">
                      <button
                        class="btn btn-lg btn-primary sans-600"
                        type="submit"
                        name="checkout_type"
                        value="add_to_cart">
                        <i class="fa-solid fa-cart-plus"></i>&nbsp;&nbsp;Add to Cart
                      </button>&nbsp;
                      <button
                        class="btn btn-lg btn-secondary sans-600"
                        type="submit"
                        name="checkout_type"
                        value="checkout">
                        <i class="fa-regular fa-credit-card"></i>&nbsp;&nbsp;Checkout
                      </button>
                    </div>
                  ';
                } else {
                  echo '<p class="sans-regular color-dark-grey">Login to place an order for this product.</p>';
                }
              ?>
            </div>
          </div>
        </div>
      </form>
      <div style="margin-top: 70px;"></div>
      <hr/>
      <div id="our-products" class="div-our-products" style="margin-top: 15px;">
        <div class="container">
          <h2 class="color-dark-grey sans-bold">
            <?php
              if (isset($_GET['category_name'])) {
                $selected_category_name = $_GET['category_name'];
                echo $selected_category_name;
              } else {
                echo 'Related Products';
              }
            ?>
          </h2>
          <p class="color-light-grey sans-regular">
            <?php
              if (isset($_GET['category_description'])) {
                $selected_category_description = $_GET['category_description'];
                echo $selected_category_description;
              } else {
                echo "Don't miss out! Grab yours today at your fave Icylicious Store.";
              }
            ?>
          </p>
          <div class="row" style="margin-top: 30px;">
            <?php
              $category_id = 0;
              if (isset($_GET['category_id'])) {
                $category_id = $_GET['category_id'];
              }
              if ($category_id == 0) {
                $fetch_query = "SELECT 
                  PI.id, 
                  PI.product_name, 
                  PI.product_description,
                  PP.variant_price,
                  PP.variant_id, 
                  PM.promotional_price,
                  PM.is_buy_x_take_x,
                  PM.buy_x_of,
                  PM.take_x_of 
                  FROM products_info AS PI INNER JOIN products_prices AS PP ON PI.id = PP.product_id
                  LEFT JOIN promotions AS PM ON PI.id = PM.product_id";
                  $result = $conn->query($fetch_query);
                if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                    $product_id = $row['id'];
                    $product_name = $row['product_name'];
                    $product_variant_id = $row['variant_id'];
                    $product_description_no_rn = str_replace('\r\n', '<br/>', $row['product_description']);
                    $product_description_no_sl = str_replace('\\', '', $product_description_no_rn);
                    $product_description_no_sn = str_replace('\n', '<br/>', $product_description_no_sl);
                    $product_description = $product_description_no_sn;
                    $variant_price = $row['variant_price'];
                    $is_buy_x_take_x = $row['is_buy_x_take_x'];
                    $promotional_price = $row['promotional_price'];
                    $fetch_query = "SELECT variant_type, variant_name FROM variants WHERE id = ".$product_variant_id."";
                    $variant_result = $conn->query($fetch_query);
                    $variant_label = '';
                    if ($variant_result->num_rows > 0) {
                      $variant_row = $variant_result->fetch_assoc();
                      $variant_name = $variant_row['variant_name'];
                      $variant_type = $variant_row['variant_type'];
                      $variant_label = '
                        <div style="display: flex; flex-direction: row; sans-regular size-10 color-light-grey">
                          '.$variant_type.':&nbsp;&nbsp;
                          <span class="badge-size color-light-grey sans-regular size-10">
                            '.$variant_name.'
                          </span>
                        </div>
                        <div style="height: 20px;"></div>
                      ';
                    }
                    // get product images
                    $products_images = array();
                    $fetch_query = "SELECT product_image FROM products_images WHERE product_id = ".$product_id."";
                    $image_result = $conn->query($fetch_query);
                    if ($image_result->num_rows > 0) {
                      while ($images_row = $image_result->fetch_assoc()) {
                        $product_image = $images_row['product_image'];
                        array_push($products_images, $product_image);
                      }
                    }
                    $first_image = "";
                    if (count($products_images) > 0) {
                      $first_image = array_values($products_images)[0];
                    }
                    if ($is_buy_x_take_x == 1) {
                      echo '
                        <div class="col-lg-3 col-md-4 col-sm-12 div-product-info">
                          <img src="../../admin/uploads/'.$first_image.'" class="img-product" />
                          <div style="height: 20px;"></div>
                          '.$variant_label.'
                          <h4 class="color-dark-grey size-13 sans-700">
                            '.$product_name.'
                          </h4>
                          <p class="color-light-grey size-10 sans-regular">
                            '.$product_description.'
                          </p>
                          <div class="div-price-container">
                            <h3 class="color-dark-grey sans-bold">₱'.$variant_price.'</h3>
                          </div>
                        </div>
                      ';
                    } else {
                      echo '
                        <div class="col-lg-3 col-md-4 col-sm-12 div-product-info">
                          <img src="../../admin/uploads/'.$first_image.'" class="img-product" />
                          <div style="height: 20px;"></div>
                          '.$variant_label.'
                          <h4 class="color-dark-grey size-13 sans-700">
                            '.$product_name.'
                          </h4>
                          <p class="color-light-grey size-10 sans-regular">
                            '.$product_description.'
                          </p>
                          <div class="div-price-container">
                            <h3 class="color-dark-grey sans-bold">₱'.$promotional_price.'</h3>
                            <h5 class="strike-price color-super-light-grey sans-regular">₱'.$variant_price.'</h5>
                          </div>
                        </div>
                      ';
                    }
                  }
                }
              } else {
                $fetch_query = "SELECT product_id FROM products_categories WHERE category_id = ".$category_id."";
                $result = $conn->query($fetch_query);
                if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                    $product_id = $row['product_id'];
                    $fetch_query = "SELECT 
                      PI.id, 
                      PI.product_name, 
                      PI.product_description,
                      PP.variant_price,
                      PP.variant_id, 
                      PM.promotional_price,
                      PM.is_buy_x_take_x,
                      PM.buy_x_of,
                      PM.take_x_of 
                      FROM products_info AS PI 
                      INNER JOIN products_prices AS PP ON PI.id = PP.product_id 
                      LEFT JOIN promotions AS PM ON PI.id = PM.product_id 
                      WHERE PI.id = ".$product_id."";
                    $product_result = $conn->query($fetch_query);
                    if ($product_result->num_rows > 0) {
                      while ($row = $product_result->fetch_assoc()) {
                        $product_name = $row['product_name'];
                        $product_variant_id = $row['variant_id'];
                        $product_description_no_rn = str_replace('\r\n', '<br/>', $row['product_description']);
                        $product_description_no_sl = str_replace('\\', '', $product_description_no_rn);
                        $product_description_no_sn = str_replace('\n', '<br/>', $product_description_no_sl);
                        $product_description = $product_description_no_sn;
                        $variant_price = $row['variant_price'];
                        $is_buy_x_take_x = $row['is_buy_x_take_x'];
                        $promotional_price = $row['promotional_price'];
                        $fetch_query = "SELECT variant_type, variant_name FROM variants WHERE id = ".$product_variant_id."";
                        $variant_result = $conn->query($fetch_query);
                        $variant_label = '';
                        if ($variant_result->num_rows > 0) {
                          $variant_row = $variant_result->fetch_assoc();
                          $variant_name = $variant_row['variant_name'];
                          $variant_type = $variant_row['variant_type'];
                          $variant_label = '
                            <div style="display: flex; flex-direction: row; sans-regular size-10 color-light-grey">
                              '.$variant_type.':&nbsp;&nbsp;
                              <span class="badge-size color-light-grey sans-regular size-10">
                                '.$variant_name.'
                              </span>
                            </div>
                            <div style="height: 20px;"></div>
                          ';
                        }
                        // get product images
                        $products_images = array();
                        $fetch_query = "SELECT product_image FROM products_images WHERE product_id = ".$product_id."";
                        $image_result = $conn->query($fetch_query);
                        if ($image_result->num_rows > 0) {
                          while ($images_row = $image_result->fetch_assoc()) {
                            $product_image = $images_row['product_image'];
                            array_push($products_images, $product_image);
                          }
                        }
                        $first_image = "";
                        if (count($products_images) > 0) {
                          $first_image = array_values($products_images)[0];
                        }
                        if ($is_buy_x_take_x == 1) {
                          echo '
                            <div class="col-lg-3 col-md-4 col-sm-12 div-product-info">
                              <img src="../../admin/uploads/'.$first_image.'" class="img-product" />
                              <div style="height: 20px;"></div>
                              '.$variant_label.'
                              <h4 class="color-dark-grey size-13 sans-700">
                                '.$product_name.'
                              </h4>
                              <p class="color-light-grey size-10 sans-regular">
                                '.$product_description.'
                              </p>
                              <div class="div-price-container">
                                <h3 class="color-dark-grey sans-bold">₱'.$variant_price.'</h3>
                              </div>
                            </div>
                          ';
                        } else {
                          if ($promotional_price == "") {
                            echo '
                              <div class="col-lg-3 col-md-4 col-sm-12 div-product-info">
                                <img src="../../admin/uploads/'.$first_image.'" class="img-product" />
                                <div style="height: 20px;"></div>
                                '.$variant_label.'
                                <h4 class="color-dark-grey size-13 sans-700">
                                  '.$product_name.'
                                </h4>
                                <p class="color-light-grey size-10 sans-regular">
                                  '.$product_description.'
                                </p>
                                <div class="div-price-container">
                                  <h3 class="color-dark-grey sans-bold">₱'.$variant_price.'</h3>
                                </div>
                              </div>
                            ';
                          } else {
                            echo '
                              <div class="col-lg-3 col-md-4 col-sm-12 div-product-info">
                                <img src="../../admin/uploads/'.$first_image.'" class="img-product" />
                                <div style="height: 20px;"></div>
                                '.$variant_label.'
                                <h4 class="color-dark-grey size-13 sans-700">
                                  '.$product_name.'
                                </h4>
                                <p class="color-light-grey size-10 sans-regular">
                                  '.$product_description.'
                                </p>
                                <div class="div-price-container">
                                  <h3 class="color-dark-grey sans-bold">₱'.$promotional_price.'</h3>
                                  <h5 class="strike-price color-super-light-grey sans-regular">₱'.$variant_price.'</h5>
                                </div>
                              </div>
                            ';
                          }
                        }
                      }
                    }
                  }
                }
              }
            ?>
          </div>
        </div>
      </div>
      <div id="contact-us" class="div-contact-us">
        <div class="container">
          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
              <h3 class="sans-600 color-dark-grey">Contact Us</h3>
              <form action="./actions/contact_us.php" method="POST">
                <div style="display: flex; gap: 10px; margin-top: 20px;">
                  <div style="flex: 1">
                    <input
                      type="text"
                      placeholder="First Name"
                      name="first_name"
                      required
                      class="form-control sans-regular"
                    />
                  </div>
                  <div style="flex: 1">
                    <input
                      type="text"
                      placeholder="Last Name"
                      name="last_name"
                      required
                      class="form-control sans-regular"
                    />
                  </div>
                </div>
                <input
                  type="email"
                  placeholder="Email Address (eg. myemail@gmail.com)"
                  name="email"
                  required
                  class="form-control sans-regular"
                  style="margin-top: 10px;"
                />
                <input
                  type="number"
                  placeholder="Mobile No. (eg. +639__)"
                  name="phone"
                  required
                  class="form-control sans-regular"
                  style="margin-top: 10px;"
                />
                <input
                  type="text"
                  placeholder="Subject"
                  name="subject"
                  required
                  class="form-control sans-regular"
                  style="margin-top: 10px;"
                />
                <label for="description" class="sans-600" style="margin-top: 10px;">Description (Intent)</label>
                <textarea
                  name="description" 
                  class="form-control sans-regular" 
                  rows="5" 
                  required 
                  style="margin-top: 7px;"></textarea>
                <button
                  class="btn btn-lg btn-primary sans-600"
                  type="submit"
                  style="margin-top: 30px;">
                  Submit
                </button>
                &nbsp;
                <button
                  class="btn btn-lg btn-outline-primary btn-reset sans-600"
                  type="reset"
                  style="margin-top: 30px;">
                  Reset
                </button>
              </form>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
              <img src="../../assets/images/about_us_logo.png" class="img-about-us" />
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="div-sub-footer">
      <div class="container">
        <div class="row">
          <div class="col-lg-3 col-md-4 col-sm-12">
            <h4 class="color-white sans-600 size-14">About Us</h4>
            <p class="color-light-white sans-regular size-11">
              Satisfying your palates since 2019. From Maranon St., San Narciso, Philippines, we offer in-store
              pickup. Experience the ultimate taste of ICY.<br/>
              Follow us on <a class="color-yellow" href="https://web.facebook.com/icyliciousph">Facebook</a>
              for more exclusive updates.
            </p>
          </div>
          <div class="col-lg-1"></div>
          <div class="col-lg-2 col-md-4 col-sm-12">
            <h4 class="color-white sans-600 size-14">Page Links</h4>
            <ul class="navbar-nav">
              <li class="nav-item" style="padding-left: 0px !important;">
                <a class="nav-link sans-regular size-11 footer-nav-link" aria-current="page" href="./">Home (Homepage)</a>
              </li>
              <li class="nav-item" style="padding-left: 0px !important;">
                <a class="nav-link sans-regular size-11 footer-nav-link" aria-current="page" href="./customer/products/">Menu (Products)</a>
              </li>
              <li class="nav-item" style="padding-left: 0px !important;">
                <a class="nav-link sans-regular size-11 footer-nav-link" aria-current="page" href="#reviews">Reviews (Testimonials)</a>
              </li>
              <li class="nav-item" style="padding-left: 0px !important;">
                <a class="nav-link sans-regular size-11 footer-nav-link" aria-current="page" href="#contact-us">Contact Us (Reach out!)</a>
              </li>
            </ul>
          </div>
          <div class="col-lg-1"></div>
          <div class="col-lg-2 col-md-4 col-sm-12">
            <h4 class="color-white sans-600 size-14">Social Links</h4>
            <ul class="navbar-nav">
              <li class="nav-item" style="padding-left: 0px !important;">
                <a class="nav-link sans-regular size-11 footer-nav-link" aria-current="page" href="./">Facebook</a>
              </li>
              <li class="nav-item" style="padding-left: 0px !important;">
                <a class="nav-link sans-regular size-11 footer-nav-link" aria-current="page" href="./">Instagram</a>
              </li>
              <li class="nav-item" style="padding-left: 0px !important;">
                <a class="nav-link sans-regular size-11 footer-nav-link" aria-current="page" href="./">Twitter (X)</a>
              </li>
              <li class="nav-item" style="padding-left: 0px !important;">
                <a class="nav-link sans-regular size-11 footer-nav-link" aria-current="page" href="-./">Google E-mail</a>
              </li>
            </ul>
          </div>
          <div class="col-lg-3 col-md-4 col-sm-12 div-account-buttons">
            <button
              data-bs-toggle="modal"
              data-bs-target="#staticLogin"
              class="btn btn-lg btn-primary sans-500"
              type="button">
              Login
            </button>
            <button
              data-bs-toggle="modal"
              data-bs-target="#staticSignUp"
              class="btn btn-lg btn-outline-primary sans-500"
              type="button">
              Sign Up
            </button>
          </div>
        </div>
      </div>
    </div>
    <div class="div-footer">
      <h6 class="sans-regular" style="padding-top: 7px;">&#169; 2024 All rights reserved.</h6>
    </div>
    <div
      class="modal fade" 
      id="staticLogin" 
      data-bs-backdrop="static" 
      data-bs-keyboard="false" 
      tabindex="-1" 
      aria-labelledby="staticBackdropLabel" 
      aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <form action="../actions/login.php" method="POST">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5 sans-600" id="staticBackdropLabel">Login</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <input type="hidden" name="type" value="customer" />
              <div style="width: 400px; display: flex; flex-direction: column; gap: 10px">
                <input
                  type="email"
                  placeholder="Email Address (eg. myemail@gmail.com)"
                  name="username"
                  required
                  class="form-control sans-regular"
                />
                <input
                  type="password"
                  placeholder="Password"
                  name="password"
                  required
                  class="form-control sans-regular"
                />
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary sans-600">Login</button>
            </div>
          </div>
        </form>
      </div>
    </div>
    <div
      class="modal fade" 
      id="staticSignUp" 
      data-bs-backdrop="static" 
      data-bs-keyboard="false" 
      tabindex="-1" 
      aria-labelledby="staticBackdropLabel" 
      aria-hidden="true">
      <div class="modal-dialog modal-md modal-dialog-centered">
        <form action="../actions/signup.php" method="POST">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5 sans-600" id="staticBackdropLabel">Sign Up</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div style="width: 600px; display: flex; flex-direction: column; gap: 10px;">
                <p class="sans-regular">Fill up all the fields in this form to create an account.</p>
                <div style="display: flex; gap: 10px">
                  <div style="flex: 1">
                    <input
                      type="text"
                      placeholder="First Name"
                      name="first_name"
                      required
                      class="form-control sans-regular"
                    />
                  </div>
                  <div style="flex: 1">
                    <input
                      type="text"
                      placeholder="Last Name"
                      name="last_name"
                      required
                      class="form-control sans-regular"
                    />
                  </div>
                </div>
                <input
                  type="email"
                  placeholder="Email Address (eg. myemail@gmail.com)"
                  name="email"
                  required
                  class="form-control sans-regular"
                />
                <input
                  type="number"
                  placeholder="Mobile No. (eg. +639__)"
                  name="phone"
                  required
                  class="form-control sans-regular"
                />
                <input
                  type="text"
                  placeholder="Address (eg. Ayala Makati, Metro Manila, Philippines)"
                  name="address"
                  required
                  class="form-control sans-regular"
                />
                <div style="display: flex; gap: 10px; margin-top: 8px">
                  <div style="flex: 1; display: flex; flex-direction: column">
                    <label for="birth_date" class="sans-600">Select Gender</label>
                    <select class="form-control form-select sans-regular gender-select" name="gender" style="flex: 1">
                      <option value="Male" selected>Male</option>
                      <option value="Female">Female</option>
                      <option value="Others">Others</option>
                    </select>
                  </div>
                  <div style="flex: 1">
                    <label for="birth_date" class="sans-600">Birth Date</label>
                    <input type="date" placeholder="Birth Date" name="birth_date" required class="form-control sans-regular">
                  </div>
                </div>
                <div style="display: flex; gap: 10px">
                  <div style="flex: 1">
                    <input
                      type="password"
                      placeholder="New Password"
                      name="new_password"
                      required
                      class="form-control sans-regular"
                    />
                  </div>
                  <div style="flex: 1">
                    <input
                      type="password"
                      placeholder="Confirm Password"
                      name="password"
                      required
                      class="form-control sans-regular"
                    />
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary sans-600" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary sans-600">Sign Up</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </body>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://kit.fontawesome.com/b2e03e5a6f.js" crossorigin="anonymous"></script>
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous">
  </script>
  <script type="text/javascript">
    $(document).ready(() => {
      $('#btn-profile').click(() => {
        window.location.href = "../account";
      });
      $('#btn-shopping-cart').click(() => {
        window.location.href = "../cart";
      });
      $('#quantity_add').click(() => {
        const quantity = $('#it_product_quantity').val();
        if (quantity) {
          const newQuantity = Number(quantity) + 1;
          // $('#it_product_quantity').val(newQuantity.toString());
          $('#it_product_quantity').attr('value', newQuantity.toString());
        }
      });
      $('#quantity_minus').click(() => {
        const quantity = $('#it_product_quantity').val();
        if (quantity) {
          const newQuantity = Number(quantity) - 1;
          if (newQuantity >= 1) {
            // $('#it_product_quantity').val(newQuantity.toString());
            $('#it_product_quantity').attr('value', newQuantity.toString());
          }
        }
      });
    });
  </script>
  <script type="text/javascript">
    $(document).ready(() => {
      $('#div-select-product-1').click(() => {
        const img = $('#img-select-product-1').attr('src');
        if (img !== undefined && img !== "") {
          $('#div-select-product-1').addClass('active');
          $('#div-select-product-2').removeClass('active');
          $('#div-select-product-3').removeClass('active');
          $('#img-selected-product').attr('src', img);
        }
      });
      $('#div-select-product-2').click(() => {
        const img = $('#img-select-product-2').attr('src');
        if (img !== undefined && img !== "") {
          $('#div-select-product-1').removeClass('active');
          $('#div-select-product-2').addClass('active');
          $('#div-select-product-3').removeClass('active');
          $('#img-selected-product').attr('src', img);
        }
      });
      $('#div-select-product-3').click(() => {
        const img = $('#img-select-product-3').attr('src');
        if (img !== undefined && img !== "") {
          $('#div-select-product-1').removeClass('active');
          $('#div-select-product-2').removeClass('active');
          $('#div-select-product-3').addClass('active');
          $('#img-selected-product').attr('src', img);
        }
      });
    });
  </script>
  <script type="text/javascript">
    const alertMessage = (message) => {
      window.alert(message);
    };
    <?php
      if (
        isset($_SESSION['errors.type']) &&
        isset($_SESSION['errors.title']) &&
        isset($_SESSION['errors.message'])
      ) {
        echo '
          window.onload = () => {
            setTimeout(() => {
              alertMessage("'.$_SESSION['errors.message'].'");
            }, 500);
          };
        ';
        unset($_SESSION['errors.type']);
        unset($_SESSION['errors.title']);
        unset($_SESSION['errors.message']);
      }
      if (isset($_SESSION['contact_us'])) {
        echo '
          window.onload = () => {
            setTimeout(() => {
              alertMessage("'.$_SESSION['contact_us'].'");
            }, 500);
          };
        ';
        unset($_SESSION['contact_us']);
      }
      if (isset($_SESSION['sign_up'])) {
        echo '
          window.onload = () => {
            setTimeout(() => {
              alertMessage("'.$_SESSION['sign_up'].'");
            }, 500);
          };
        ';
        unset($_SESSION['sign_up']);
      }
      if (
        isset($_SESSION['checkout.message']) &&
        isset($_SESSION['checkout.quantity'])
      ) {
        echo '
          window.onload = () => {
            setTimeout(() => {
              alertMessage("'.$_SESSION['checkout.message'].'");
            }, 500);
          };
        ';
        unset($_SESSION['checkout.message']);
        unset($_SESSION['checkout.quantity']);
      }
    ?>
  </script>
</html>
