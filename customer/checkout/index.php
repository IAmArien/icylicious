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
    <link rel="stylesheet" href="./css/checkout.css" />
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8 col-md-12 col-sm-12">
          <?php
            $total_checkout_price = 0.00;
            $has_item = false;
            if (isset($_SESSION['user_info.email'])) {
              $fetch_query = "SELECT DISTINCT product_id FROM cart WHERE user_email = '".$_SESSION['user_info.email']."'";
              $result = $conn->query($fetch_query);
              if ($result->num_rows > 0) {
                $has_item = true;
                if ($result->num_rows > 0) {
                  $has_item = true;
                  while ($row = $result->fetch_assoc()) {
                    $product_id = $row['product_id'];
                    $fetch_query = "SELECT *, count(*) FROM cart WHERE product_id = ".$product_id." AND user_email = '".$_SESSION['user_info.email']."'";
                    $count_result = $conn->query($fetch_query);
                    if ($count_result->num_rows > 0) {
                      $count_result_row = $count_result->fetch_assoc();
                      $product_count = $count_result_row['count(*)'];
                      $variant_id = $count_result_row['variant_id'];
                      $order_quantity = $count_result_row['order_quantity'];
                      $fetch_query = "SELECT * FROM variants WHERE id = ".$variant_id." LIMIT 1";
                      $variant_result = $conn->query($fetch_query);

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
                          } else {
                            $product_total_price = floatval($variant_price) * $order_quantity;
                            $total_checkout_price += $product_total_price;
                          }
                        } else {
                          $product_total_price = floatval($variant_price) * $order_quantity;
                          $total_checkout_price += $product_total_price;
                        }
                      }
                    }
                  }
                } else {
                  echo '<p class="sans-regular color-dark-grey">No item in the cart.</p>';
                }
              }
            }
          ?>
          <form action="../actions/payment.php" method="POST">
            <input type="hidden" name="payment_type" value="<?php if (isset($_GET['payment_type'])) if ($_GET['payment_type'] == 'GCASH') echo 'GCASH'; else echo 'CCDB'; else echo 'CCDB'; ?>" required id="payment_type" />
            <input type="hidden" name="customer_email" value="<?php if (isset($_SESSION['user_info.email'])) echo $_SESSION['user_info.email']; ?>" required />
            <div class="div-cart-container">
              <h3 class="sans-700">Express Checkout</h3>
              <div style="height: 15px"></div>
              <div class="div-checkout-payment-type">
                <button
                  type="button"
                  class="btn btn-md <?php if (isset($_GET['payment_type'])) if ($_GET['payment_type'] == 'GCASH') echo 'btn-secondary'; else echo 'btn-primary'; else echo 'btn-primary'; ?> sans-600"
                  id="btn-cc"
                  style="flex: 1;">
                  Credit / Debit Card Payment
                </button>
                <button
                  type="button"
                  class="btn btn-md <?php if (isset($_GET['payment_type'])) if ($_GET['payment_type'] == 'GCASH') echo 'btn-primary'; else echo 'btn-secondary'; else echo 'btn-secondary'; ?> sans-600"
                  id="btn-gc"
                  style="flex: 1;">
                  Pay thru GCash
                </button>
              </div>
              <div style="height: 15px;"></div>
              <?php
                if (isset($_GET['payment_type'])) {
                  if ($_GET['payment_type'] == 'GCASH') {
                    echo '
                      <div class="div-gc-details" id="div-gc-details">
                        <h6 class="sans-600 color-dark-grey">Pay thru GCash:</h6>
                        <div class="div-form-container">
                          <input
                            type="text"
                            placeholder="GCash reference number. (eg. 21343729349312)"
                            name="credit_card_no"
                            required
                            class="form-control sans-regular"
                          />
                          <div style="display: flex; gap: 10px; margin-top: -10px;">
                            <div style="flex: 1">
                              <input
                                type="hidden"
                                placeholder="Expiration Date (eg. MM/YY)"
                                name="credit_card_exp"
                                required
                                class="form-control sans-regular"
                                value="-"
                              />
                            </div>
                            <div style="flex: 1">
                              <input
                                type="hidden"
                                placeholder="CVV Security Code (eg. 808)"
                                name="credit_card_code"
                                required
                                class="form-control sans-regular"
                                value="0"
                              />
                            </div>
                          </div>
                          <div style="display: flex; gap: 10px;">
                            <div style="flex: 1">
                              <input
                                type="text"
                                placeholder="First Name"
                                name="billing_first_name"
                                required
                                class="form-control sans-regular"
                              />
                            </div>
                            <div style="flex: 1">
                              <input
                                type="text"
                                placeholder="Last Name"
                                name="billing_last_name"
                                required
                                class="form-control sans-regular"
                              />
                            </div>
                          </div>
                          <input
                            type="email"
                            placeholder="Email Address (eg. myemail@gmail.com)"
                            name="billing_email"
                            required
                            class="form-control sans-regular"
                          />
                          <input
                            type="number"
                            placeholder="Mobile No. (eg. +639__)"
                            name="billing_phone"
                            required
                            class="form-control sans-regular"
                          />
                          <input
                            type="hidden"
                            placeholder="Address Address (eg. Ayala Makati, Metro Manila, Philippines)"
                            name="billing_address"
                            required
                            class="form-control sans-regular"
                            value="-"
                          />
                        </div>
                        <div style="height: 35px;"></div>
                        <h6 class="sans-600 color-dark-grey">Shipping address details:</h6>
                        <div class="div-form-container">
                          <div style="display: flex; gap: 10px;">
                            <div style="flex: 1">
                              <input
                                type="text"
                                placeholder="First Name"
                                name="shipping_first_name"
                                class="form-control sans-regular"
                              />
                            </div>
                            <div style="flex: 1">
                              <input
                                type="text"
                                placeholder="Last Name"
                                name="shipping_last_name"
                                class="form-control sans-regular"
                              />
                            </div>
                          </div>
                          <input
                            type="email"
                            placeholder="Email Address (eg. myemail@gmail.com)"
                            name="shipping_email"
                            class="form-control sans-regular"
                          />
                          <input
                            type="number"
                            placeholder="Mobile No. (eg. +639__)"
                            name="shipping_phone"
                            class="form-control sans-regular"
                          />
                          <input
                            type="text"
                            placeholder="Address Address (eg. Ayala Makati, Metro Manila, Philippines)"
                            name="shipping_address"
                            class="form-control sans-regular"
                          />
                        </div>
                      </div>
                    ';
                  } else {
                    echo '
                      <div class="div-cc-details" id="div-cc-details">
                        <h6 class="sans-600 color-dark-grey">Credit / Debit Card details:</h6>
                        <div class="div-form-container">
                          <input
                            type="text"
                            placeholder="Credit / Debit Card No. (eg. 4183-8657-9088-0099)"
                            name="credit_card_no"
                            required
                            class="form-control sans-regular"
                          />
                          <div style="display: flex; gap: 10px;">
                            <div style="flex: 1">
                              <input
                                type="text"
                                placeholder="Expiration Date (eg. MM/YY)"
                                name="credit_card_exp"
                                required
                                class="form-control sans-regular"
                              />
                            </div>
                            <div style="flex: 1">
                              <input
                                type="number"
                                placeholder="CVV Security Code (eg. 808)"
                                name="credit_card_code"
                                required
                                class="form-control sans-regular"
                              />
                            </div>
                          </div>
                        </div>
                        <div style="height: 35px;"></div>
                        <h6 class="sans-600 color-dark-grey">Billing / Payment details:</h6>
                        <div class="div-form-container">
                          <div style="display: flex; gap: 10px;">
                            <div style="flex: 1">
                              <input
                                type="text"
                                placeholder="First Name"
                                name="billing_first_name"
                                required
                                class="form-control sans-regular"
                              />
                            </div>
                            <div style="flex: 1">
                              <input
                                type="text"
                                placeholder="Last Name"
                                name="billing_last_name"
                                required
                                class="form-control sans-regular"
                              />
                            </div>
                          </div>
                          <input
                            type="email"
                            placeholder="Email Address (eg. myemail@gmail.com)"
                            name="billing_email"
                            required
                            class="form-control sans-regular"
                          />
                          <input
                            type="number"
                            placeholder="Mobile No. (eg. +639__)"
                            name="billing_phone"
                            required
                            class="form-control sans-regular"
                          />
                          <input
                            type="text"
                            placeholder="Address Address (eg. Ayala Makati, Metro Manila, Philippines)"
                            name="billing_address"
                            required
                            class="form-control sans-regular"
                          />
                          <div>
                            <input id="same-as-shipping" class="form-check-input" type="checkbox" value="1" id="flexCheckChecked" checked name="same_as_shipping_address">
                            <label class="form-check-label" for="flexCheckChecked">
                              Same as shipping address
                            </label>
                          </div>
                        </div>
                        <div id="div-shipping-details" style="display: none;">
                          <div style="height: 35px;"></div>
                          <h6 class="sans-600 color-dark-grey">Shipping address details:</h6>
                          <div class="div-form-container">
                            <div style="display: flex; gap: 10px;">
                              <div style="flex: 1">
                                <input
                                  type="text"
                                  placeholder="First Name"
                                  name="shipping_first_name"
                                  class="form-control sans-regular"
                                />
                              </div>
                              <div style="flex: 1">
                                <input
                                  type="text"
                                  placeholder="Last Name"
                                  name="shipping_last_name"
                                  class="form-control sans-regular"
                                />
                              </div>
                            </div>
                            <input
                              type="email"
                              placeholder="Email Address (eg. myemail@gmail.com)"
                              name="shipping_email"
                              class="form-control sans-regular"
                            />
                            <input
                              type="number"
                              placeholder="Mobile No. (eg. +639__)"
                              name="shipping_phone"
                              class="form-control sans-regular"
                            />
                            <input
                              type="text"
                              placeholder="Address Address (eg. Ayala Makati, Metro Manila, Philippines)"
                              name="shipping_address"
                              class="form-control sans-regular"
                            />
                          </div>
                        </div>
                      </div>
                    ';
                  }
                } else {
                  echo '
                    <div class="div-cc-details" id="div-cc-details">
                      <h6 class="sans-600 color-dark-grey">Credit / Debit Card details:</h6>
                      <div class="div-form-container">
                        <input
                          type="text"
                          placeholder="Credit / Debit Card No. (eg. 4183-8657-9088-0099)"
                          name="credit_card_no"
                          required
                          class="form-control sans-regular"
                        />
                        <div style="display: flex; gap: 10px;">
                          <div style="flex: 1">
                            <input
                              type="text"
                              placeholder="Expiration Date (eg. MM/YY)"
                              name="credit_card_exp"
                              required
                              class="form-control sans-regular"
                            />
                          </div>
                          <div style="flex: 1">
                            <input
                              type="number"
                              placeholder="CVV Security Code (eg. 808)"
                              name="credit_card_code"
                              required
                              class="form-control sans-regular"
                            />
                          </div>
                        </div>
                      </div>
                      <div style="height: 35px;"></div>
                      <h6 class="sans-600 color-dark-grey">Billing / Payment details:</h6>
                      <div class="div-form-container">
                        <div style="display: flex; gap: 10px;">
                          <div style="flex: 1">
                            <input
                              type="text"
                              placeholder="First Name"
                              name="billing_first_name"
                              required
                              class="form-control sans-regular"
                            />
                          </div>
                          <div style="flex: 1">
                            <input
                              type="text"
                              placeholder="Last Name"
                              name="billing_last_name"
                              required
                              class="form-control sans-regular"
                            />
                          </div>
                        </div>
                        <input
                          type="email"
                          placeholder="Email Address (eg. myemail@gmail.com)"
                          name="billing_email"
                          required
                          class="form-control sans-regular"
                        />
                        <input
                          type="number"
                          placeholder="Mobile No. (eg. +639__)"
                          name="billing_phone"
                          required
                          class="form-control sans-regular"
                        />
                        <input
                          type="text"
                          placeholder="Address Address (eg. Ayala Makati, Metro Manila, Philippines)"
                          name="billing_address"
                          required
                          class="form-control sans-regular"
                        />
                        <div>
                          <input id="same-as-shipping" class="form-check-input" type="checkbox" value="1" id="flexCheckChecked" checked name="same_as_shipping_address">
                          <label class="form-check-label" for="flexCheckChecked">
                            Same as shipping address
                          </label>
                        </div>
                      </div>
                      <div id="div-shipping-details" style="display: none;">
                        <div style="height: 35px;"></div>
                        <h6 class="sans-600 color-dark-grey">Shipping address details:</h6>
                        <div class="div-form-container">
                          <div style="display: flex; gap: 10px;">
                            <div style="flex: 1">
                              <input
                                type="text"
                                placeholder="First Name"
                                name="shipping_first_name"
                                class="form-control sans-regular"
                              />
                            </div>
                            <div style="flex: 1">
                              <input
                                type="text"
                                placeholder="Last Name"
                                name="shipping_last_name"
                                class="form-control sans-regular"
                              />
                            </div>
                          </div>
                          <input
                            type="email"
                            placeholder="Email Address (eg. myemail@gmail.com)"
                            name="shipping_email"
                            class="form-control sans-regular"
                          />
                          <input
                            type="number"
                            placeholder="Mobile No. (eg. +639__)"
                            name="shipping_phone"
                            class="form-control sans-regular"
                          />
                          <input
                            type="text"
                            placeholder="Address Address (eg. Ayala Makati, Metro Manila, Philippines)"
                            name="shipping_address"
                            class="form-control sans-regular"
                          />
                        </div>
                      </div>
                    </div>
                  ';
                }
              ?>
              <div class="div-checkout-price">
                <div class="div-checkout-action">
                  <button
                    class="btn btn-md btn-secondary sans-600"
                    type="submit"
                    name="checkout_type"
                    value="checkout">
                    <i class="fa-regular fa-credit-card"></i>&nbsp;&nbsp;Confirm Payment
                  </button>
                </div>
                <input type="hidden" name="order_total" value="<?php echo $total_checkout_price; ?>" />
                <h5 class="sans-regular color-dark-grey">Total: <b>₱<?php echo number_format($total_checkout_price); ?></b></h5>
              </div>
            </div>
          </form>
        </div>
        <div class="col-lg-2"></div>
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
      let isSameAsShipping = false;
      $('#same-as-shipping').change(() => {
        if (isSameAsShipping) {
          $('#div-shipping-details').css('display', 'none');
          isSameAsShipping = false;
        } else {
          $('#div-shipping-details').css('display', 'block');
          isSameAsShipping = true;
        }
      });
      $('#btn-cc').click(() => {
        window.location.href = "./?payment_type=CCDB";
        // $('#btn-gc').removeClass("btn-primary");
        // $('#btn-gc').addClass("btn-secondary");
        // $('#btn-cc').removeClass("btn-secondary");
        // $('#btn-cc').addClass("btn-primary");
        // $('#div-cc-details').css('display', 'block');
        // $('#div-gc-details').css('display', 'none');
        // $('#payment_type').val('CC DB');
      });
      $('#btn-gc').click(() => {
        window.location.href = "./?payment_type=GCASH";
        // $('#btn-gc').removeClass("btn-secondary");
        // $('#btn-gc').addClass("btn-primary");
        // $('#btn-cc').removeClass("btn-primary");
        // $('#btn-cc').addClass("btn-secondary");
        // $('#div-cc-details').css('display', 'none');
        // $('#div-gc-details').css('display', 'block');
        // $('#payment_type').val('GCASH');
      });
    })
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
