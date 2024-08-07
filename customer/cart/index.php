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
    <link rel="stylesheet" href="./css/cart.css" />
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
              <a class="nav-link sans-regular size-11" aria-current="page" href="../products/">Menu</a>
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
      <div class="container">
        <div class="row">
          <div class="col-lg-2"></div>
          <div class="col-lg-8 col-md-12 col-sm-12">
            <div class="div-cart-container">
              <h3 class="sans-700">Shopping Cart</h3>
              <div style="height: 30px"></div>
              <div class="div-cart-items">
                <?php
                  $total_checkout_price = 0.00;
                  $has_item = false;
                  if (isset($_SESSION['user_info.email'])) {
                    $fetch_query = "SELECT DISTINCT product_id FROM cart WHERE user_email = '".$_SESSION['user_info.email']."'";
                    $result = $conn->query($fetch_query);
                    if ($result->num_rows > 0) {
                      $has_item = true;
                      while ($row = $result->fetch_assoc()) {
                        $product_id = $row['product_id'];
                        $fetch_query = "SELECT *, count(*) FROM cart WHERE product_id = ".$product_id." AND user_email = '".$_SESSION['user_info.email']."'";
                        $count_result = $conn->query($fetch_query);
                        if ($count_result->num_rows > 0) {
                          $count_result_row = $count_result->fetch_assoc();
                          $cart_id = $count_result_row['id'];
                          $product_count = $count_result_row['count(*)'];
                          $variant_id = $count_result_row['variant_id'];
                          $order_quantity = $count_result_row['order_quantity'];

                          $product_name = "";
                          $fetch_query = "SELECT * FROM products_info WHERE id = ".$product_id." LIMIT 1";
                          $product_info_result = $conn->query($fetch_query);
                          if ($product_info_result->num_rows > 0) {
                            $product_info_row = $product_info_result->fetch_assoc();
                            $product_name = $product_info_row['product_name'];
                          }

                          $fetch_query = "SELECT * FROM variants WHERE id = ".$variant_id." LIMIT 1";
                          $variant_result = $conn->query($fetch_query);
                          $variant_place = '';
                          if ($variant_result->num_rows > 0) {
                            $variant_row = $variant_result->fetch_assoc();
                            $variant_type = $variant_row['variant_type'];
                            $variant_name = $variant_row['variant_name'];
                            $variant_place = '
                              <div style="display: flex; flex-direction: row; sans-regular size-10 color-light-grey">
                                '.$variant_type.':&nbsp;&nbsp;
                                <span class="badge-size color-light-grey sans-regular size-10">
                                  '.$variant_name.'
                                </span>
                              </div>
                            ';
                          }
                          $fetch_query = "SELECT * FROM products_prices WHERE product_id = ".$product_id." AND variant_id = ".$variant_id." LIMIT 1";
                          $prices_result = $conn->query($fetch_query);

                          $fetch_query = "SELECT * FROM promotions WHERE product_id = ".$product_id." LIMIT 1";
                          $promotions_result = $conn->query($fetch_query);

                          $product_price_place = '';
                          $product_total_price = 0.00;

                          if ($prices_result->num_rows > 0) {
                            $prices_row = $prices_result->fetch_assoc();
                            $variant_price = $prices_row['variant_price'];
                            if ($promotions_result->num_rows > 0) {
                              $promotions_row = $promotions_result->fetch_assoc();
                              $promotional_price = $promotions_row['promotional_price'];
                              if ($promotional_price != '0') {
                                $product_total_price = floatval($promotional_price) * $order_quantity;
                                $total_checkout_price += $product_total_price;
                                $product_price_place = '
                                  <div class="div-price-container">
                                    <h5 class="color-dark-grey sans-bold">₱'.$promotional_price.'</h5>
                                    <h6 class="strike-price color-super-light-grey sans-regular">₱'.$variant_price.'</h6>
                                  </div>
                                ';
                              } else {
                                $product_total_price = floatval($variant_price) * $order_quantity;
                                $total_checkout_price += $product_total_price;
                                $product_price_place = '
                                  <div class="div-price-container">
                                    <h5 class="color-dark-grey sans-bold">₱'.$variant_price.'</h5>
                                  </div>
                                ';
                              }
                            } else {
                              $product_total_price = floatval($variant_price) * $order_quantity;
                              $total_checkout_price += $product_total_price;
                              $product_price_place = '
                                <div class="div-price-container">
                                  <h5 class="color-dark-grey sans-bold">₱'.$variant_price.'</h5>
                                </div>
                              ';
                            }
                          }

                          $first_image = '';
                          $second_image = '';
                          $third_image = '';
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
                            <div class="div-cart-item">
                              <img src="../../admin/uploads/'.$first_image.'" class="img-cart-item" />
                              <div class="div-cart-item-info">
                                <h5 class="sans-600 color-dark-grey">
                                  ('.$order_quantity.') '.$product_name.'
                                </h5>
                                '.$variant_place.'
                                '.$product_price_place.'
                              </div>
                              <form action="../actions/delete_cart_item.php" method="POST">
                                <input type="hidden" name="product_id" value="'.$product_id.'" />
                                <input type="hidden" name="customer_email" value="'.$_SESSION['user_info.email'].'" />
                                <div class="div-total-price-action">
                                  <h3 class="color-dark-grey sans-bold">₱'.number_format($product_total_price).'</h3>
                                  <button class="btn btn-sm btn-danger sans-regular" type="submit">
                                    Remove
                                  </button>
                                  <button
                                    class="btn btn-sm btn-primary sans-600"
                                    type="button"
                                    style="margin-top: 8px;"
                                    onclick="onUpdateQuantity(
                                      '."'".$cart_id."'".',
                                      '."'".$product_id."'".',
                                      '."'".$order_quantity."'".'
                                    )">
                                    Edit
                                  </button>
                                </div>
                              </form>
                            </div>
                          ';
                        }
                      }
                    } else {
                      echo '<p class="sans-regular color-dark-grey">No item in the cart.</p>';
                    }
                  }
                ?>
              </div>
            </div>
            <div class="div-checkout-price">
              <div class="div-checkout-action">
                <a href="../checkout/?payment_type=COD">
                  <button
                    class="btn btn-md btn-secondary sans-600"
                    type="submit"
                    name="checkout_type"
                    value="checkout"
                    <?php if (!$has_item) echo "disabled"; ?>>
                    <i class="fa-regular fa-credit-card"></i>&nbsp;&nbsp;Checkout
                  </button>
                </a>
              </div>
              <h5 class="sans-regular color-dark-grey">Total: <b>₱<?php echo number_format($total_checkout_price); ?></b></h5>
            </div>
          </div>
          <div class="col-lg-2"></div>
        </div>
      </div>
      <div id="contact-us" class="div-contact-us">
        <div class="container">
          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
              <h3 class="sans-600 color-dark-grey">Contact Us</h3>
              <form action="../actions/contact_us.php" method="POST">
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
                  min="0"
                  max="11"
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
                <a class="nav-link sans-regular size-11 footer-nav-link" aria-current="page" href="../../">Home (Homepage)</a>
              </li>
              <li class="nav-item" style="padding-left: 0px !important;">
                <a class="nav-link sans-regular size-11 footer-nav-link" aria-current="page" href="../products/">Menu (Products)</a>
              </li>
              <li class="nav-item" style="padding-left: 0px !important;">
                <a class="nav-link sans-regular size-11 footer-nav-link" aria-current="page" href="../../index.php#reviews">Reviews (Testimonials)</a>
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
      id="staticUpdateQuantity" 
      data-bs-backdrop="static" 
      data-bs-keyboard="false" 
      tabindex="-1" 
      aria-labelledby="staticBackdropLabel" 
      aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <form action="../actions/update_cart.php" method="POST">
          <input id="cart_id" type="hidden" name="cart_id" />
          <input id="product_id" type="hidden" name="product_id" />
          <input type="hidden" name="user_email" value="<?php if (isset($_SESSION['user_info.email'])) echo $_SESSION['user_info.email']; ?>" />
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5 sans-600" id="staticBackdropLabel">Update Quantity</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div style="width: 400px;">
                <label for="product_quantity" class="sans-600" style="margin-bottom: 8px;">Product Quantity</label>
                <input
                  type="number"
                  name="product_quantity"
                  id="product_quantity"
                  placeholder="Quantity (eg. 1)"
                  class="form-control sans-600"
                  required
                  value="1"
                />
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary sans-600" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary sans-600" id="btn-add-to-cart-order">Update Cart</button>
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
      
    });
  </script>
  <script type="text/javascript">
    const onUpdateQuantity = (cart_id, product_id, quantity) => {
      $('#staticUpdateQuantity').modal('show');
      $('#product_quantity').val(quantity);
      $('#product_id').val(product_id);
      $('#cart_id').val(cart_id);
    }
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
      if (isset($_SESSION['cart.message'])) {
        echo '
          window.onload = () => {
            setTimeout(() => {
              alertMessage("'.$_SESSION['cart.message'].'");
            }, 500);
          };
        ';
        unset($_SESSION['cart.message']);
      }
    ?>
  </script>
</html>
