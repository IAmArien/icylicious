<?php
  session_start();
  include('../../utils/connections.php');
  if (
    !isset($_SESSION['user_credentials.username']) &&
    !isset($_SESSION['user_credentials.type'])
  ) {
    header('Location: ../');
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Admin / User Management </title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    >
    <link href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap5.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/global.css" />
    <link rel="stylesheet" href="./css/users.css" />
  </head>
  <body>
    <div class="sidebar-container">
      <div class="div-tm-title background-color-light-grey">
        <h4 class="h4-tm-title sans-700 color-dark-grey background-color-yellow">ICYLICIOUS&trade;</h4>
      </div>
      <div class="div-sidebar-logo">
        <i class="fa-solid fa-circle-user color-white" style="font-size: 30pt; margin-top: -8px"></i>
        <div>
          <h4 class="color-white sans-700 h6-title-name">
            <?php
              echo $_SESSION['user_info.first_name']." ".$_SESSION['user_info.last_name'];
            ?>
          </h4>
          <p class="color-yellow sans-regular p-title-email">
            <?php
              echo $_SESSION['user_info.email'];
            ?>
          </p>
        </div>
      </div>
      <div class="div-siderbar-menu-links">
        <button
          id="btn-dashboard"
          class="btn btn-outline-success btn-sm
            sans-regular 
            background-color-super-light-grey 
            border-color-super-light-grey 
            color-white 
            btn-menu 
            btn-menu-unselected"
          type="button">
          <i class="fa-solid fa-gauge-high"></i><span style="padding-left: 16px">Dashboard</span>
        </button>
        <button
          id="btn-user-management"
          class="btn btn-outline-success btn-sm
            sans-700 
            background-color-yellow 
            border-color-yellow 
            color-dark-grey 
            btn-menu 
            btn-menu-selected"
          type="button">
          <i class="fa-solid fa-users"></i><span style="padding-left: 13px">User Management</span>
        </button>
        <button 
          id="btn-categories"
          class="btn btn-outline-success btn-sm
            sans-regular 
            background-color-super-light-grey 
            border-color-super-light-grey 
            color-white 
            btn-menu 
            btn-menu-unselected"
          type="button">
          <i class="fa-solid fa-layer-group"></i><span style="padding-left: 16px">Product Categories</span>
        </button>
        <button 
          id="btn-products" 
          class="btn btn-outline-success btn-sm
            sans-regular 
            background-color-super-light-grey 
            border-color-super-light-grey 
            color-white 
            btn-menu 
            btn-menu-unselected"
          type="button">
          <i class="fa-solid fa-gifts"></i><span style="padding-left: 15px">Product Management</span>
        </button>
        <button
          id="btn-variants"
          class="btn btn-outline-success btn-sm
            sans-regular 
            background-color-super-light-grey 
            border-color-super-light-grey 
            color-white 
            btn-menu 
            btn-menu-unselected"
          type="button">
          <i class="fa-solid fa-tags"></i><span style="padding-left: 19px">Product Variants</span>
        </button>
        <button 
          id="btn-orders" 
          class="btn btn-outline-success btn-sm
            sans-regular 
            background-color-super-light-grey 
            border-color-super-light-grey 
            color-white 
            btn-menu 
            btn-menu-unselected"
          type="button">
          <i class="fa-solid fa-cart-shopping"></i><span style="padding-left: 16px">Orders</span>
        </button>
        <button 
          id="btn-settings" 
          class="btn btn-outline-success btn-sm
            sans-regular 
            background-color-super-light-grey 
            border-color-super-light-grey 
            color-white 
            btn-menu 
            btn-menu-unselected"
          type="button">
          <i class="fa-solid fa-gear"></i><span style="padding-left: 19px">Settings</span>
        </button>
      </div>
      <div class="div-siderbar-profile-links">
        <button
          class="btn btn-outline-success btn-sm
            sans-regular 
            color-white 
            btn-menu 
            btn-menu-unselected
            btn-logout"
          style="border: 0px"
          type="button">
          <i class="fa-solid fa-right-from-bracket"></i><span style="padding-left: 19px">Logout</span>
        </button>
      </div>
    </div>
    <div class="content">
      <nav class="navbar navbar-expand-lg navbar-light bg-body-tertiary">
        <div class="container-fluid">
          <a class="navbar-brand sans-regular color-dark-grey a-navbar-path" href="#" style="cursor: default;">
            &nbsp;&nbsp;&nbsp;<i class="fa-solid fa-bars" style="cursor: pointer"></i>
            &nbsp;&nbsp;&nbsp;&nbsp;<b>Admin</b>&nbsp;
            <i class="fa-solid fa-chevron-right"></i>
            &nbsp;User Management
          </a>
        </div>
      </nav>
      <div>
        <div class="content-wrapper">
          <div class="div-content-title">
            <div class="div-content-title-labels">
              <h4 class="color-dark-grey sans-600" style="font-size: 13pt;">
                Manage users
              </h4>
              <p class="color-super-light-grey sans-regular" style="font-size: 10pt;">
                Add, update, remove, and view users' information.
              </p>
            </div>
            <div class="div-content-title-actions">
              <button
                data-bs-toggle="modal"
                data-bs-target="#staticAddNewUser"
                class="btn btn-outline-primary btn-sm sans-400"
                type="button">
                <i class="fa-solid fa-circle-plus"></i>&nbsp;&nbsp;Add New User
              </button>
            </div>
          </div>
          <div style="margin-top: 20px;">
            <table id="data" class="table table-striped" style="width:100%">
              <thead>
                <tr>
                  <th class="sans-bold">(Full Name)</th>
                  <th class="sans-bold">(Email)</th>
                  <th class="sans-bold">(Mobile No.)</th>
                  <th class="sans-bold">(Address)</th>
                  <th class="sans-bold">(Gender)</th>
                  <th class="sans-bold">(Actions)</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $fetch_user_info = "
                    SELECT 
                    UI.id,
                    UI.first_name,
                    UI.last_name,
                    UI.email,
                    UI.phone,
                    UI.address,
                    UI.gender,
                    UI.birth_date
                    FROM user_info AS UI 
                    INNER JOIN user_credentials AS UC 
                    ON UI.id = UC.user_id 
                    AND UC.type = 'customer'";
                  $result = $conn->query($fetch_user_info);
                  if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                      $user_id = $row['id'];
                      $first_name = $row['first_name'];
                      $last_name = $row['last_name'];
                      $fullname = $first_name . ' ' . $last_name;
                      $email = $row['email'];
                      $mobile_no = $row['phone'];
                      $address = $row['address'];
                      $gender = $row['gender'];
                      $b_date = $row['birth_date'];
                      echo '
                        <tr>
                          <td class="sans-600">
                            '.$fullname.'
                          </td>
                          <td class="sans-regular" style="color: #2392f4">
                            <a href="mailto:'.$email.'" 
                              class="sans-regular"
                              style="color: #2392f4">'.$email.'</a>
                          </td>
                          <td class="sans-regular">
                            '.$mobile_no.'
                          </td>
                          <td class="sans-regular">
                            '.$address.'
                          </td>
                          <td class="sans-regular">
                            '.$gender.'
                          </td>
                          <td>
                            <button
                              data-bs-toggle="modal"
                              data-bs-target="#staticEditUser"
                              onclick="onEditUser(
                                '."'".$user_id."',".'
                                '."'".$first_name."',".'
                                '."'".$last_name."',".'
                                '."'".$email."',".'
                                '."'".$mobile_no."',".'
                                '."'".$address."',".'
                                '."'".$gender."',".'
                                '."'".$b_date."'".'
                              )"
                              class="btn btn-outline-primary btn-sm 
                                sans-400 
                                color-white"
                              type="button">
                              <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                            <button
                              onclick="onDeleteUser('."'".$email."'".')"
                              class="btn btn-outline-primary btn-sm 
                                sans-400 
                                color-white"
                              type="button">
                              <i class="fa-solid fa-trash"></i>
                            </button>
                          </td>
                        </tr>
                      ';
                    }
                  }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div
      class="modal fade" 
      id="staticDeleteUser" 
      data-bs-backdrop="static" 
      data-bs-keyboard="false" 
      tabindex="-1" 
      aria-labelledby="staticBackdropLabel" 
      aria-hidden="true">
      <div class="modal-dialog modal-md modal-dialog-centered">
        <form action="../actions/delete_user.php" method="POST">
          <input id="delete-ue" type="hidden" name="email" />
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5 sans-600" id="staticBackdropLabel">Delete This User?</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <p class="sans-regular size-14">Are you sure you want to delete this user?. It cannot be undone.</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary sans-600" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary sans-600">Delete Account</button>
            </div>
          </div>
        </form>
      </div>
    </div>
    <div
      class="modal fade" 
      id="staticAddNewUser" 
      data-bs-backdrop="static" 
      data-bs-keyboard="false" 
      tabindex="-1" 
      aria-labelledby="staticBackdropLabel" 
      aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <form action="../actions/add_user.php" method="POST">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5 sans-600" id="staticBackdropLabel">Add New User</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <p class="sans-regular">Fill up all the fields in this form to create an account.</p>
              <div style="display: flex; gap: 10px">
                <div style="flex: 1">
                  <input type="text" placeholder="First Name" name="first_name" required class="sans-regular">
                </div>
                <div style="flex: 1">
                  <input type="text" placeholder="Last Name" name="last_name" required class="sans-regular">
                </div>
              </div>
              <input type="email" placeholder="Email Address (eg. myemail@gmail.com)" name="email" required class="sans-regular">
              <input type="text" placeholder="Mobile No. (eg. +639__)" name="phone" required class="sans-regular">
              <input type="text" placeholder="Address (eg. Ayala Makati, Metro Manila, Philippines)" name="address" required class="sans-regular">
              <div style="display: flex; gap: 10px; margin-top: 8px">
                <div style="flex: 1; display: flex; flex-direction: column">
                  <label for="birth_date" class="sans-600">Select Gender</label>
                  <select class="form-select sans-regular gender-select" name="gender" style="flex: 1">
                    <option value="Male" selected>Male</option>
                    <option value="Female">Female</option>
                    <option value="Others">Others</option>
                  </select>
                </div>
                <div style="flex: 1">
                  <label for="birth_date" class="sans-600">Birth Date</label>
                  <input type="date" placeholder="Birth Date" name="birth_date" required class="sans-regular">
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary sans-600" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary sans-600">Register Account</button>
            </div>
          </div>
        </form>
      </div>
    </div>
    <div
      class="modal fade" 
      id="staticEditUser" 
      data-bs-backdrop="static" 
      data-bs-keyboard="false" 
      tabindex="-1" 
      aria-labelledby="staticBackdropLabel" 
      aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <form action="../actions/update_user.php" method="POST">
          <input id="edit-ui" type="hidden" name="user_id" />
          <input id="edit-ue" type="hidden" name="user_email" />
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5 sans-600" id="staticBackdropLabel">Edit User</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <p class="sans-regular">Fill up all the fields in this form to update this account.</p>
              <div style="display: flex; gap: 10px">
                <div style="flex: 1">
                  <input id="edit-fn" type="text" placeholder="First Name" name="first_name" required class="sans-regular">
                </div>
                <div style="flex: 1">
                  <input id="edit-ln" type="text" placeholder="Last Name" name="last_name" required class="sans-regular">
                </div>
              </div>
              <input id="edit-ea" type="email" placeholder="Email Address (eg. myemail@gmail.com)" name="email" required readonly class="sans-regular is_readonly">
              <input id="edit-pn" type="text" placeholder="Mobile No. (eg. +639__)" name="phone" required class="sans-regular">
              <input id="edit-ad" type="text" placeholder="Address (eg. Ayala Makati, Metro Manila, Philippines)" name="address" required class="sans-regular">
              <div style="display: flex; gap: 10px; margin-top: 8px">
                <div style="flex: 1; display: flex; flex-direction: column">
                  <label for="birth_date" class="sans-600">Select Gender</label>
                  <select id="edit-gd" class="form-select sans-regular gender-select" name="gender" style="flex: 1">
                    <option value="Male" selected>Male</option>
                    <option value="Female">Female</option>
                    <option value="Others">Others</option>
                  </select>
                </div>
                <div style="flex: 1">
                  <label for="birth_date" class="sans-600">Birth Date</label>
                  <input id="edit-bd" type="date" placeholder="Birth Date" name="birth_date" required class="sans-regular">
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary sans-600" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary sans-600">Update Account</button>
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
  <script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
  <script src="https://cdn.datatables.net/2.0.5/js/dataTables.bootstrap5.js"></script>
  <script type="text/javascript">
    $(document).ready(() => {
      $('#btn-dashboard').click(() => {
        window.location.href = "../dashboard";
      });
      $('#btn-user-management').click(() => {
        window.location.href = "./";
      });
      $('#btn-categories').click(() => {
        window.location.href = "../categories";
      });
      $('#btn-products').click(() => {
        window.location.href = "../products";
      });
      $('#btn-variants').click(() => {
        window.location.href = "../variants";
      });
      $('#btn-orders').click(() => {
        window.location.href = "../orders";
      });
      $('#btn-settings').click(() => {
        window.location.href = "../settings";
      });
      $('.btn-logout').click(() => {
        window.location.href = "../actions/logout.php";
      });
      $('#data').dataTable({
        'bLengthChange': true,
        'searching': true
      });
    });
  </script>
  <script type="text/javascript">
    const onDeleteUser = (email) => {
      $('#staticDeleteUser').modal('show');
      $('#delete-ue').val(email);
    }
    const onEditUser = (
      user_id,
      first_name,
      last_name,
      email,
      phone,
      address,
      gender,
      birth_date
    ) => {
      $('#edit-ui').val(user_id);
      $('#edit-ue').val(email);
      $('#edit-fn').val(first_name);
      $('#edit-ln').val(last_name);
      $('#edit-ea').val(email);
      $('#edit-pn').val(phone);
      $('#edit-ad').val(address);
      $('#edit-gd').val(gender);
      $('#edit-bd').val(birth_date);
    }
  </script>    
</html>
