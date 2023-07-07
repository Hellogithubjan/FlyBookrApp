<?php include_once 'header.php'; ?>
<?php include_once 'footer.php';
require '../helpers/init_conn_db.php'; ?>
<?php
if (isset($_POST['del_flight']) and isset($_SESSION['adminId'])) {
  $flight_id = $_POST['flight_id'];
  $sql = 'DELETE FROM Flight WHERE flight_id=?';
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header('Location: ../index.php?error=sqlerror');
    exit();
  } else {
    mysqli_stmt_bind_param($stmt, 'i', $flight_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    // header('Location: all_flights.php');
    echo ("<script>location.href = 'all_flights.php';</script>");
    exit();
  }
}
?>

<style>
  table {
    background-color: white;
  }

  

  a:hover {
    text-decoration: none;
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

  .container-md {
    padding: 0;
    width: 100%;
  }

  .main-border {
    width: 100%;
    height: 20%;
    background: #0c85e9;
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
</style>
<main>
  <?php if (isset($_SESSION['adminId'])) { ?>
    <div class="container-md mt-2">
      <<div class="main-border">
        <h1 class="main-heading">List of all Plying Flights</h1>
    </div>
    <table class="table  table-hover">
      <thead class="text-center">
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Arrival</th>
          <th scope="col">Departure</th>
          <th scope="col">Source</th>
          <th scope="col">Destination</th>
          <th scope="col">Airline</th>
          <th scope="col">Seats</th>
          <th scope="col">Price</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>

        <?php
        $sql = 'SELECT * FROM Flight ORDER BY flight_id DESC';
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        while ($row = mysqli_fetch_assoc($result)) {
          echo "
                  <tr class='text-center'>                  
                    <td scope='row'>
                      <a href='pass_list.php?flight_id=" . $row['flight_id'] . "'>
                      " . $row['flight_id'] . " </a> </td>
                    <td>" . $row['arrival'] . "</td>
                    <td>" . $row['departure'] . "</td>
                    <td>" . $row['source'] . "</td>
                    <td>" . $row['Destination'] . "</td>
                    <td>" . $row['airline'] . "</td>
                    <td>" . $row['Seats'] . "</td>
                    <td>$ " . $row['Price'] . "</td>
                    <td>
                    <form action='all_flights.php' method='post'>
                      <input name='flight_id' type='hidden' value=" . $row['flight_id'] . ">
                      <button  class='btn' type='submit' name='del_flight'>
                      <i class='text-danger fa fa-trash'></i></button>
                    </form>
                    </td>                  
                  </tr>
                  ";
        }
        ?>

      </tbody>
    </table>

    </div>
  <?php } ?>

</main>