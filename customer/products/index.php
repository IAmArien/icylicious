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
    <link rel="stylesheet" href="./css/products.css" />
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
              <a class="nav-link sans-600 size-11 active" aria-current="page" href="./">Menu</a>
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
                      <i class="far fa-shopping-cart"></i>&nbsp;&nbsp;Shopping Cart
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
      <div class="container" style="padding-top: 20px;">
        <nav class="nav">
          <?php
            $selected_category_name = 'All';
            if (isset($_GET['category_name'])) {
              $selected_category_name = $_GET['category_name'];
              if ($selected_category_name == 'All') {
                echo '<a class="nav-link active color-yellow sans-bold" aria-current="page" href="./">All</a>';
              } else {
                echo '<a class="nav-link color-light-grey sans-500" aria-current="page" href="./">All</a>';
              }
            } else {
              echo '<a class="nav-link active color-yellow sans-bold" aria-current="page" href="./">All</a>';
            }
            $fetch_query = "SELECT * FROM categories ORDER BY id ASC";
            $result = $conn->query($fetch_query);
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                $category_id = $row['id'];
                $category_name = $row['category_name'];
                $category_description = $row['category_description'];
                $active_status = '';
                if ($selected_category_name == $category_name) {
                  $active_status = 'nav-link color-yellow sans-bold active';
                } else {
                  $active_status = 'nav-link color-light-grey sans-500';
                }
                echo '
                  <a
                    class="'.$active_status.'"
                    aria-current="page"
                    href="./?id='.$category_id.'&category_name='.$category_name.'&category_description='.$category_description.'">
                    '.$category_name.'
                  </a>
                ';
              }
            }
          ?>
        </nav>
      </div>
      <div id="our-products" class="div-our-products">
        <div class="container">
          <h2 class="color-dark-grey sans-bold">
            <?php
              if (isset($_GET['category_name'])) {
                $selected_category_name = $_GET['category_name'];
                echo $selected_category_name;
              } else {
                echo 'Our Products';
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
          <div class="row" style="margin-top: 60px;">
            <?php
              $category_id = 0;
              if (isset($_GET['id'])) {
                $category_id = $_GET['id'];
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
                    if ($is_buy_x_take_x == 1) {
                      echo '
                        <div class="col-lg-3 col-md-4 col-sm-12 div-product-info">
                          <img
                            src="../../admin/uploads/'.$first_image.'"
                            class="img-product"
                            onClick="onProductClick(
                              '."".$category_id.",".'
                              '."'".$category_name."',".'
                              '."'".$category_description."',".'
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
                            src="../../assets/images/summer_promo_5_5_1.png"
                            class="img-product"
                            onClick="onProductClick(
                              '."".$category_id.",".'
                              '."'".$category_name."',".'
                              '."'".$category_description."',".'
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
                        if ($is_buy_x_take_x == 1) {
                          echo '
                            <div class="col-lg-3 col-md-4 col-sm-12 div-product-info">
                              <img
                                src="../../admin/uploads/'.$first_image.'"
                                class="img-product"
                                onClick="onProductClick(
                                  '."".$category_id.",".'
                                  '."'".$category_name."',".'
                                  '."'".$category_description."',".'
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
                                src="../../assets/images/summer_promo_5_5_1.png"
                                class="img-product"
                                onClick="onProductClick(
                                  '."".$category_id.",".'
                                  '."'".$category_name."',".'
                                  '."'".$category_description."',".'
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
                  type="pasword"
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
        window.location.href = `../info/?id=${product_id}`;
      } else {
        window.location.href = `../info/?id=${product_id}&category_id=${category_id}&category_name=${category_name}&category_description=${category_description}`;
      }
    };
  </script>
  <script type="text/javascript">
    const alertError = (message) => {
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
              alertError("'.$_SESSION['errors.message'].'");
            }, 500);
          };
        ';
        unset($_SESSION['errors.type']);
        unset($_SESSION['errors.title']);
        unset($_SESSION['errors.message']);
      }
    ?>
  </script>
</html>
