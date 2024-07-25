<?php
  session_start();
  include('./utils/connections.php');
  if (
    isset($_SESSION['user_credentials.username']) &&
    isset($_SESSION['user_credentials.type'])
  ) {
    if ($_SESSION['user_credentials.type'] != "customer") {
      header('Location: ./admin/');
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
    <link rel="stylesheet" href="./assets/css/global.css" />
    <link rel="stylesheet" href="./assets/css/index.css" />
    <style>
      .badge-size {
        border: 1px solid var(--light-grey);
        border-radius: 0px;
        padding-inline: 10px;
        padding-block: 0px;
        padding-top: 1px;
        text-transform: uppercase;
      }
    </style>
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
              <a class="nav-link sans-600 size-11 active" aria-current="page" href="./">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link sans-regular size-11" aria-current="page" href="./customer/products/">Menu</a>
            </li>
            <li class="nav-item">
              <a class="nav-link sans-regular size-11" aria-current="page" href="#reviews">Reviews</a>
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
      <div>
        <img src="./assets/images/home_background.png" class="img-background" />
        <div class="background-overlay">
          <h2 id="sub-description" class="color-white sans-italic-600">" Satisfying your palates since 2019. "</h2>
          <p class="color-white sans-italic">17 stores nationwide and counting!</p>
          <button class="btn btn-lg btn-primary sans-600" type="button">Order Now!</button>
        </div>
      </div>
      <div id="menu" style="margin-top: 50px;">
        <div class="container">
          <h2 class="color-dark-grey sans-bold" style="text-align: center;">Best Sellers</h2>
          <p class="color-light-grey sans-regular" style="text-align: center;">
            Experience the ultimate taste of summer with our 5.5 summer promo
          </p>
          <div class="row" style="margin-top: 60px;">
            <?php
              $fetch_query = "SELECT * FROM best_sellers LIMIT 4";
              $best_sellers_result = $conn->query($fetch_query);
              if ($best_sellers_result->num_rows > 0) {
                while ($best_sellers_row = $best_sellers_result->fetch_assoc()) {
                  $product_id = $best_sellers_row['product_id'];
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
                    LEFT JOIN promotions AS PM ON PI.id = PM.product_id WHERE PI.id = ".$product_id." LIMIT 1";
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
                      // get product variants
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
                      $images_result = $conn->query($fetch_query);
                      if ($images_result->num_rows > 0) {
                        while ($images_row = $images_result->fetch_assoc()) {
                          $product_image = $images_row['product_image'];
                          array_push($products_images, $product_image);
                        }
                      }
                      $first_image = '';
                      if (count($products_images) > 0) {
                        $first_image = array_values($products_images)[0];
                      }
                      // get product category
                      $fetch_query = "SELECT * FROM products_categories WHERE product_id = ".$product_id." LIMIT 1";
                      $category_result = $conn->query($fetch_query);
                      $local_category_id = 0;
                      $local_category_name = "";
                      $local_category_description = "";
                      if ($category_result->num_rows > 0) {
                        $category_row = $category_result->fetch_assoc();
                        $local_category_id = $category_row['category_id'];
                        $fetch_query = "SELECT * FROM categories WHERE id = ".$local_category_id." LIMIT 1";
                        $category_details_result = $conn->query($fetch_query);
                        if ($category_details_result->num_rows > 0) {
                          $category_details_row = $category_details_result->fetch_assoc();
                          $local_category_name = $category_details_row['category_name'];
                          $local_category_description = $category_details_row['category_description'];
                        }
                      }
                      if ($is_buy_x_take_x == 1) {
                        echo '
                          <div class="col-lg-3 col-md-4 col-sm-12 div-product-info">
                            <img
                              src="./admin/uploads/'.$first_image.'"
                              class="img-product"
                              onClick="onProductClick(
                                '."".$local_category_id.",".'
                                '."'".$local_category_name."',".'
                                '."'".$local_category_description."',".'
                                '."".$product_id."".'
                              )"
                            />
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
                              <img
                                src="./admin/uploads/'.$first_image.'"
                                class="img-product"
                                onClick="onProductClick(
                                  '."".$local_category_id.",".'
                                  '."'".$local_category_name."',".'
                                  '."'".$local_category_description."',".'
                                  '."".$product_id."".'
                                )"
                              />
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
                              <img
                                src="./admin/uploads/'.$first_image.'"
                                class="img-product"
                                onClick="onProductClick(
                                  '."".$local_category_id.",".'
                                  '."'".$local_category_name."',".'
                                  '."'".$local_category_description."',".'
                                  '."".$product_id."".'
                                )"
                              />
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
            ?>
          </div>
          <div class="row" style="margin-top: 80px;">
            <div class="col-lg-4 col-md-6 col-sm-12">
              <a href="https://web.facebook.com/photo/?fbid=870942155049580&set=a.561026276041171&_rdc=1&_rdr" target="_blank">
                <img src="./admin/uploads/447499471_870942151716247_4633608610290246237_n.jpg" class="img-product-deals" />
              </a>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
              <a href="https://web.facebook.com/photo/?fbid=893342806142848&set=a.561026276041171" target="_blank">
                <img src="./admin/uploads/450094224_892550539555408_1373547862024909865_n.jpg" class="img-product-deals" />
              </a>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
              <a href="https://web.facebook.com/photo/?fbid=853057170171412&set=a.561026272707838&_rdc=1&_rdr" target="_blank">
                <img src="./admin/uploads/442372498_853031390173990_2800767280777839313_n.jpg" class="img-product-deals" />
              </a>
            </div>
          </div>
        </div>
      </div>
      <div id="our-products" class="div-our-products">
        <div class="container">
          <h2 class="color-dark-grey sans-bold" style="text-align: center;">Our Products</h2>
          <p class="color-light-grey sans-regular" style="text-align: center;">
            Don't miss out! Grab yours today at your fave Icylicious Store.
          </p>
          <div class="row" style="margin-top: 60px;">
            <?php
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
                LEFT JOIN promotions AS PM ON PI.id = PM.product_id LIMIT 4";
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
                  // get product variants
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
                  $images_result = $conn->query($fetch_query);
                  if ($images_result->num_rows > 0) {
                    while ($images_row = $images_result->fetch_assoc()) {
                      $product_image = $images_row['product_image'];
                      array_push($products_images, $product_image);
                    }
                  }
                  $first_image = '';
                  if (count($products_images) > 0) {
                    $first_image = array_values($products_images)[0];
                  }
                  // get product category
                  $fetch_query = "SELECT * FROM products_categories WHERE product_id = ".$product_id." LIMIT 1";
                  $category_result = $conn->query($fetch_query);
                  $local_category_id = 0;
                  $local_category_name = "";
                  $local_category_description = "";
                  if ($category_result->num_rows > 0) {
                    $category_row = $category_result->fetch_assoc();
                    $local_category_id = $category_row['category_id'];
                    $fetch_query = "SELECT * FROM categories WHERE id = ".$local_category_id." LIMIT 1";
                    $category_details_result = $conn->query($fetch_query);
                    if ($category_details_result->num_rows > 0) {
                      $category_details_row = $category_details_result->fetch_assoc();
                      $local_category_name = $category_details_row['category_name'];
                      $local_category_description = $category_details_row['category_description'];
                    }
                  }
                  if ($is_buy_x_take_x == 1) {
                    echo '
                      <div class="col-lg-3 col-md-4 col-sm-12 div-product-info">
                        <img
                          src="./admin/uploads/'.$first_image.'"
                          class="img-product"
                          onClick="onProductClick(
                            '."".$local_category_id.",".'
                            '."'".$local_category_name."',".'
                            '."'".$local_category_description."',".'
                            '."".$product_id."".'
                          )"
                        />
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
                          <img
                            src="./admin/uploads/'.$first_image.'"
                            class="img-product"
                            onClick="onProductClick(
                              '."".$local_category_id.",".'
                              '."'".$local_category_name."',".'
                              '."'".$local_category_description."',".'
                              '."".$product_id."".'
                            )"
                          />
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
                          <img
                            src="./admin/uploads/'.$first_image.'"
                            class="img-product"
                            onClick="onProductClick(
                              '."".$local_category_id.",".'
                              '."'".$local_category_name."',".'
                              '."'".$local_category_description."',".'
                              '."".$product_id."".'
                            )"
                          />
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
            ?>
          </div>
          <div style="width: 100%; display: flex; flex-direction: column; align-items: center; justify-content: center; margin-top: 30px;">
            <a href="./customer/products">
              <button class="btn btn-lg btn-primary sans-600" type="button">
                View More Products
              </button>
            </a>
          </div>
        </div>
      </div>
      <div id="reviews" style="margin-top: 70px;">
        <div class="container">
          <h2 class="color-dark-grey sans-bold" style="text-align: center;">Reviews</h2>
          <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel" style="margin-top: 50px;">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <h4 class="sans-600 color-dark-grey">Francis Alex Verdan</h4>
                <div style="height: 15px;"></div>
                <p class="sans-italic color-super-light-grey">
                  " Thank you for your gracious staff and wonderful spirit you bring to your customers.<br/>
                  A business is remembered more for their kindness they share towards others than the products they sell sometimes. "
                </p>
              </div>
              <div class="carousel-item">
                <h4 class="sans-600 color-dark-grey">Aizel Domingo Torno</h4>
                <div style="height: 15px;"></div>
                <p class="sans-italic color-super-light-grey">
                  " Sarap talaga lalo na ng Mango graham smootie sarap balik balikan lalo na kung malapit lang ako,<br/>
                  bundok pa kase samin eh kaya bihira lang makabili. "
                </p>
              </div>
              <div class="carousel-item">
                <h4 class="sans-600 color-dark-grey">Yhen Selafar</h4>
                <div style="height: 15px;"></div>
                <p class="sans-italic color-super-light-grey">
                  " Sarap mag refresh dito (icy), nakakapawi ng uhaw lalo na sa init ng panahon.<br/>
                  Tara na't mag icy "
                </p>
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
        </div>
      </div>
      <div id="contact-us" class="div-contact-us">
        <div class="container">
          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
              <h3 class="sans-600 color-dark-grey">Contact Us</h3>
              <form action="./customer/actions/contact_us.php" method="POST">
                <div style="display: flex; gap: 10px; margin-top: 20px;">
                  <div style="flex: 1">
                    <input
                      type="text"
                      placeholder="First Name"
                      name="firstname"
                      required
                      class="form-control sans-regular"
                    />
                  </div>
                  <div style="flex: 1">
                    <input
                      type="text"
                      placeholder="Last Name"
                      name="lastname"
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
                  name="mobile"
                  required
                  class="form-control sans-regular"
                  style="margin-top: 10px;"
                  min="0"
                  max="11"
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
              <img src="./assets/images/about_us_logo.png" class="img-about-us" />
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
                <a class="nav-link sans-regular size-11 footer-nav-link" aria-current="page" href="./customer/menu/">Menu (Products)</a>
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
        <form action="./customer/actions/login.php" method="POST">
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
        <form action="./customer/actions/signup.php" method="POST">
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
                  min="0"
                  max="11"
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
      $('#btn-shopping-cart').click(() => {
        window.location.href = "./customer/cart";
      });
      $("#btn-profile").click(() => {
        window.location.href = "./customer/account";
      });
    });
  </script>
  <script type="text/javascript">
    const onProductClick = (
      category_id,
      category_name,
      category_description,
      product_id
    ) => {
      if (
        category_id === undefined ||
        category_name === undefined ||
        category_description === undefined
      ) {
        window.location.href = `./customer/info/?id=${product_id}`;
      } else {
        window.location.href = `./customer/info/?id=${product_id}&category_id=${category_id}&category_name=${category_name}&category_description=${category_description}`;
      }
    };
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
    ?>
  </script>
</html>
