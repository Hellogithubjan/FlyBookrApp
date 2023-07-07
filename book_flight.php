<?php include_once 'helpers/helper.php'; ?>
<?php subview('header.php');
require 'helpers/init_conn_db.php';
?>
<link href="https://fonts.googleapis.com/css2?family=Assistant:wght@200&display=swap" rel="stylesheet">
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<style>
  table {
    background-color: white;
  }

  body {
    font-family: "Poppins", sans-serif;
  }

  th {
    font-size: 18px;
  }

  td {
    margin-top: 10px !important;
    font-size: 18px;
    text-align: center;
    color: #424242;
  }

  .main-heading {
    color: white;
    font-weight: 600;
    margin-bottom: 40px;
    padding: 10px;
    font-size: 25px;
    text-align: center;
    word-spacing: 5px;
  }

  .container-md{
    padding: 0;
    width: 100%;
  }

  .main-border {
    width: 100%;
    height: 20%;
    background: #0c85e9;
  }

  ion-icon{
    font-size: 18px;
  }

  
</style>
<main>
  <?php if (isset($_POST['search_but'])) {
    $dep_date = $_POST['dep_date'];
    $ret_date = isset($_POST['ret_date']) ? $_POST['ret_date'] : '';
    $dep_city = $_POST['dep_city'];
    $arr_city = $_POST['arr_city'];
    $type = $_POST['type'];
    $f_class = $_POST['f_class'];
    $passengers = $_POST['passengers'];
    if ($dep_city === $arr_city) {
      header('Location: index.php?error=sameval');
      exit();
    }
    if ($dep_city === '0') {
      header('Location: index.php?error=seldep');
      exit();
    }
    if ($arr_city === '0') {
      header('Location: index.php?error=selarr');
      exit();
    }
  ?>
    <div class="container-md mt-2">
      <div class="main-border">
        <h1 class="main-heading">Flights Plying From <?php echo $dep_city; ?> to <?php echo $arr_city; ?> </h1>
      </div>
      <table class="table  table-hover">
        <thead>
          <tr class="text-center">
            <th scope="col">Airline Logo</th>
            <th scope="col">Airline</th>
            <th scope="col">Departure</th>
            <th scope="col">Arrival</th>
            <th scope="col">Status</th>
            <th scope="col">Amount</th>
            <th scope="col">Buy</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $sql = 'SELECT * FROM Flight WHERE source=? AND Destination =? AND 
                    DATE(departure)=? ORDER BY Price';
          $stmt = mysqli_stmt_init($conn);
          mysqli_stmt_prepare($stmt, $sql);
          mysqli_stmt_bind_param($stmt, 'sss', $dep_city, $arr_city, $dep_date);
          mysqli_stmt_execute($stmt);
          $result = mysqli_stmt_get_result($stmt);
          while ($row = mysqli_fetch_assoc($result)) {
            $price = (int)$row['Price'] * (int)$passengers;
            if ($type === 'round') {
              $price = $price * 2;
            }
            if ($f_class == 'B') {
              $price += 0.5 * $price;
            }
            if ($row['status'] === '') {
              $status = "Flight Available";
              $alert = 'alert-primary';
            } else if ($row['status'] === 'dep') {
              $status = "Departed";
              $alert = 'alert-info';
            } else if ($row['status'] === 'issue') {
              $status = "Delayed";
              $alert = 'alert-danger';
            } else if ($row['status'] === 'arr') {
              $status = "Arrived";
              $alert = 'alert-success';
            }

            echo "
                  <tr class='text-center'>  
                                
                    <td class='td-text'>" . '<img src = "data:image/png;base64,' . base64_encode($row['flight_img']) . '" width = "100px" height = "100px"/>'."</td>
                    <td class='td-text'>" . $row['airline']."</td>
                    <td class='td-text'>" . $row['departure'] . "</td>
                    <td class='td-text'>" . $row['arrival'] . "</td>
                    <td>
                      <div>
                          <div class='alert " . $alert . " text-center mb-0 pt-1 pb-1' 
                              role='alert'>
                              " . $status . "
                          </div>
                      </div>  
                    </td>                   
                    <td>₹ " . $price . "</td>
                    ";
            if (isset($_SESSION['userId']) && $row['status'] === '') {
              echo " <td>
                    <form action='pass_form.php' method='post'>
                    <input name='flight_id' type='hidden' value=" . $row['flight_id'] . ">
                      <input name='type' type='hidden' value=" . $type . ">
                      <input name='passengers' type='hidden' value=" . $passengers . ">
                      <input name='price' type='hidden' value=" . $price . ">
                      <input name='ret_date' type='hidden' value=" . $ret_date . ">
                      <input name='class' type='hidden' value=" . $f_class . ">
                      <button name='book_but' type='submit' 
                      class='btn  mt-0'>
                      <div style=''>
                      <ion-icon name='wallet'></ion-icon>
                      </div>
                    </button>
                    </form>
                    </td>                                                       
                    ";
            } elseif (isset($_SESSION['userId']) && $row['status'] === 'dep') {
              echo "<td>Not Available</td>";
            } else {
              echo "<td>Login to continue</td>";
            }
            echo '</tr> ';
          }
          ?>

        </tbody>
      </table>

    </div>
  <?php } ?>

</main>
<?php subview('footer.php'); ?>
