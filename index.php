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
                    $cart_quantity = " (". strval($result->num_rows) . ") ";
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
            <div class="col-lg-3 col-md-4 col-sm-12 div-product-info">
              <img src="./assets/images/summer_promo_5_5_1.png" class="img-product" />
              <div style="height: 20px;"></div>
              <h4 class="color-dark-grey size-13 sans-700">
                BUY 1 TAKE 1 - LARGE NUTTY-OREO NUTELLA SMOOTHIE WITH PEARLS
              </h4>
              <p class="color-light-grey size-10 sans-regular">
                Experience the ultimate taste of summer with our 5.5 Summer Promo!
                Available at all Icylicious Stores.
              </p>
              <div class="div-price-container">
                <h3 class="color-dark-grey sans-bold">₱255.00</h3>
                <h5 class="strike-price color-super-light-grey sans-regular">₱270.00</h5>
              </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-12 div-product-info">
              <img src="./assets/images/summer_promo_5_5_2.png" class="img-product" />
              <div style="height: 20px;"></div>
              <h4 class="color-dark-grey size-13 sans-700">
                1 LARGE BUBBLE MILK TEA
              </h4>
              <p class="color-light-grey size-10 sans-regular">
                Experience the ultimate taste of summer with our 5.5 Summer Promo!
                Available at all Icylicious Stores.
              </p>
              <div class="div-price-container">
                <h3 class="color-dark-grey sans-bold">₱55.00</h3>
                <h5 class="strike-price color-super-light-grey sans-regular">₱70.00</h5>
              </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-12 div-product-info">
              <img src="./assets/images/summer_promo_5_5_3.png" class="img-product" />
              <div style="height: 20px;"></div>
              <h4 class="color-dark-grey size-13 sans-700">
                P55 EACH (ANY FLAVOR OF YOUR CHOICE WHEN YOU BUY 2 REGULAR MILK TEAS)
              </h4>
              <p class="color-light-grey size-10 sans-regular">
                Experience the ultimate taste of summer with our 5.5 Summer Promo!
                Available at all Icylicious Stores.
              </p>
              <div class="div-price-container">
                <h3 class="color-dark-grey sans-bold">₱55.00</h3>
              </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-12 div-product-info">
              <img src="./assets/images/summer_promo_5_5_4.png" class="img-product" />
              <div style="height: 20px;"></div>
              <h4 class="color-dark-grey size-13 sans-700">
                BUY 1 TAKE 1 REGULAR CHOCO CHIP SMOOTHIE PEARLS
              </h4>
              <p class="color-light-grey size-10 sans-regular">
                Experience the ultimate taste of summer with our 5.5 Summer Promo!
                Available at all Icylicious Stores.
              </p>
              <div class="div-price-container">
                <h3 class="color-dark-grey sans-bold">₱155.00</h3>
                <h5 class="strike-price color-super-light-grey sans-regular">₱170.00</h5>
              </div>
              <!-- <button class="btn btn-md btn-outline-primary sans-600 btn-add-to-cart" type="button" style="width: 100%;">
                <i class="fa-solid fa-cart-plus"></i>&nbsp;&nbsp;Add to cart
              </button> -->
            </div>
          </div>
          <div class="row" style="margin-top: 80px;">
            <div class="col-lg-4 col-md-6 col-sm-12">
              <img src="./assets/images/best_deals_1.png" class="img-product-deals" />
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
              <img src="./assets/images/best_deals_2.png" class="img-product-deals" />
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
              <img src="./assets/images/best_deals_3.png" class="img-product-deals" />
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
            <div class="col-lg-3 col-md-4 col-sm-12 div-product-info">
              <img src="./assets/images/summer_promo_5_5_1.png" class="img-product" />
              <div style="height: 20px;"></div>
              <h4 class="color-dark-grey size-13 sans-700">
                BUY 1 TAKE 1 - LARGE NUTTY-OREO NUTELLA SMOOTHIE WITH PEARLS
              </h4>
              <p class="color-light-grey size-10 sans-regular">
                Experience the ultimate taste of summer with our 5.5 Summer Promo!
                Available at all Icylicious Stores.
              </p>
              <div class="div-price-container">
                <h3 class="color-dark-grey sans-bold">₱255.00</h3>
                <h5 class="strike-price color-super-light-grey sans-regular">₱270.00</h5>
              </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-12 div-product-info">
              <img src="./assets/images/summer_promo_5_5_2.png" class="img-product" />
              <div style="height: 20px;"></div>
              <h4 class="color-dark-grey size-13 sans-700">
                1 LARGE BUBBLE MILK TEA
              </h4>
              <p class="color-light-grey size-10 sans-regular">
                Experience the ultimate taste of summer with our 5.5 Summer Promo!
                Available at all Icylicious Stores.
              </p>
              <div class="div-price-container">
                <h3 class="color-dark-grey sans-bold">₱55.00</h3>
                <h5 class="strike-price color-super-light-grey sans-regular">₱70.00</h5>
              </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-12 div-product-info">
              <img src="./assets/images/summer_promo_5_5_3.png" class="img-product" />
              <div style="height: 20px;"></div>
              <h4 class="color-dark-grey size-13 sans-700">
                P55 EACH (ANY FLAVOR OF YOUR CHOICE WHEN YOU BUY 2 REGULAR MILK TEAS)
              </h4>
              <p class="color-light-grey size-10 sans-regular">
                Experience the ultimate taste of summer with our 5.5 Summer Promo!
                Available at all Icylicious Stores.
              </p>
              <div class="div-price-container">
                <h3 class="color-dark-grey sans-bold">₱55.00</h3>
              </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-12 div-product-info">
              <img src="./assets/images/summer_promo_5_5_4.png" class="img-product" />
              <div style="height: 20px;"></div>
              <h4 class="color-dark-grey size-13 sans-700">
                BUY 1 TAKE 1 REGULAR CHOCO CHIP SMOOTHIE PEARLS
              </h4>
              <p class="color-light-grey size-10 sans-regular">
                Experience the ultimate taste of summer with our 5.5 Summer Promo!
                Available at all Icylicious Stores.
              </p>
              <div class="div-price-container">
                <h3 class="color-dark-grey sans-bold">₱155.00</h3>
                <h5 class="strike-price color-super-light-grey sans-regular">₱170.00</h5>
              </div>
              <!-- <button class="btn btn-md btn-outline-primary sans-600 btn-add-to-cart" type="button" style="width: 100%;">
                <i class="fa-solid fa-cart-plus"></i>&nbsp;&nbsp;Add to cart
              </button> -->
            </div>
          </div>
          <button class="btn btn-lg btn-primary sans-600" type="button" style="display: block; margin: auto; margin-top: 30px;">
            View More Products
          </button>
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
