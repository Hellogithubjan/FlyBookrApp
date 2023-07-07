<?php include_once 'header.php';
require '../helpers/init_conn_db.php'; ?>

<link rel="stylesheet" href="../assets/css/admin.css">
<link href="https://fonts.googleapis.com/css2?family=Assistant:wght@200;300&family=Poiret+One&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Cinzel&display=swap" rel="stylesheet">
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<style>
  body {
    background-color: #ffffff;
  }

  td {

    font-size: 18px !important;
  }

  p {
    font-size: 35px;
    font-weight: 100;
    font-family: 'product sans';
  }

  .main-section {
    width: 100%;
    text-align: center;
    padding: 0px 5px;
    margin-left: -450px;
    margin-top: -30px;
  }

  .dashbord {
    width: 48%;
    display: inline-block;
    color: #fff;
    margin-top: 40px;
    margin-left: 30px;
    -webkit-box-shadow: 0px 3px 6px 2px rgba(133, 133, 133, 1);
    -moz-box-shadow: 0px 3px 6px 2px rgba(133, 133, 133, 1);
    box-shadow: 0px 3px 6px 2px rgba(133, 133, 133, 1);
  }

  .icon-section i,
  .icon-section ion-icon {
    font-size: 30px;
    padding: 10px;
    border: 1px solid #fff;
    border-radius: 50%;
    margin-top: -25px;
    margin-bottom: 10px;
    background-color: #34495E;
  }

  .icon-section p {
    margin: 0px;
    font-size: 20px;
    padding-bottom: 10px;
  }

  .dashbord .icon-section:hover {
    background-color: #c2e6f5;
    cursor: pointer;
    color: black;
  }

  .dashbord-1,
  .dashbord-2,
  .dashbord-3,
  .dashbord-4 {
    height: 30%;
  }

  .dashbord-2 .icon-section,
  .dashbord-2 .icon-section i {
    background-color: #04c2af;
  }

  .dashbord-1 .icon-section,
  .dashbord-1 .icon-section i {
    background-color: #0c85e9;
  }

  .dashbord-4 .icon-section,
  .dashbord-4 .icon-section i {
    background-color: rgb(132, 180, 244);
  }

  .dashbord-3 .icon-section,
  .icon-section ion-icon {
    background-color: #11d5a6;
  }
  .tables{
    position: absolute;
    bottom: 0px;
    top: 80px;
    left: 640px;
    width: 55%;
  }
  .card{
    height: 23.5%;
  }
  .heading-table{
    font-size: 15px;
    font-weight: bold;
    font-family: "poppins",sans-serif;
  }
  th{
    font-size: 15px;
  }
</style>


<main>
  <?php if (isset($_SESSION['adminId'])) { ?>
    <div class="container">
      <div class="main-section">
        <div class="dashbord dashbord-1">
          <div class="icon-section">
            <i class="fa fa-users" aria-hidden="true"></i><br>
            <h5>Total Passengers</h5>
            <p><?php include 'psngrcnt.php'; ?></p>
          </div>
        </div>
        <div class="dashbord dashbord-2">
          <div class="icon-section">
            <i class="fa fa-money" aria-hidden="true"></i><br>
            <h5>Amount Credited</h5>
            <p>₹ <?php include 'amtcnt.php'; ?></p>
          </div>

        </div>
        <div class="dashbord dashbord-3">
          <div class="icon-section">
            <ion-icon name="ticket-outline" aria-hidden="true"></ion-icon><br>
            <h5>Booked Flights</h5>
            <p><?php include 'flightscnt.php'; ?></p>
          </div>

        </div>

        <div class="dashbord dashbord-4">
          <div class="icon-section">
            <i class="fa fa-plane fa-rotate-180" aria-hidden="true"></i><br>
            <h5>Available Airlines</h5>
            <p><?php include 'airlcnt.php'; ?></p>
          </div>

        </div>

      </div>

      <div class="tables">
        <div class="card mt-4" id="flight">
          <div class="card-body">
            <p class="heading-table">Today's Flights</p>
            <table class="table-sm table table-hover table-borderless">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Arrival</th>
                  <th scope="col">Departure</th>
                  <th scope="col">Destination</th>
                  <th scope="col">Source</th>
                  <th scope="col">Airlines</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php
                $curr_date = (string)date('y-m-d');
                $curr_date = '20' . $curr_date;
                $sql = "SELECT * FROM Flight WHERE DATE(departure)=?";
                $stmt = mysqli_stmt_init($conn);
                mysqli_stmt_prepare($stmt, $sql);
                mysqli_stmt_bind_param($stmt, 's', $curr_date);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                while ($row = mysqli_fetch_assoc($result)) {
                  if ($row['status'] == '') {
                    echo '     
                <td scope="row">
                  <a href="pass_list.php?flight_id=' . $row['flight_id'] . '" style="text-decoration:underline;">
                  ' . $row['flight_id'] . ' </a> </td>
                <td>' . $row['arrival'] . '</td>
                <td>' . $row['departure'] . '</td>
                <td>' . $row['Destination'] . '</td>
                <td>' . $row['source'] . '</td>
                <td>' . $row['airline'] . '</td> 
                <th class="options">
                  <div class="dropdown">
                    <a class="text-reset text-decoration-none" href="#" 
                      id="dropdownMenuButton" data-toggle="dropdown" 
                        aria-haspopup="true" aria-expanded="false">
                      
                      <i class="fa fa-ellipsis-v"></i> </td>
                    </a>  
                    <div class="dropdown-menu">
                      <form class="px-4 py-3"  action="../includes/admin/admin.inc.php" method="post">
                        <input type="hidden" type="number" name="flight_id" 
                          value=' . $row['flight_id'] . '>
                        <div class="form-group">
                          <label for="exampleDropdownFormEmail1">Enter time in min.                              
                          </label>
                          <input type="number" class="form-control" name="issue" 
                            placeholder="Eg. 120">
                        </div>  
                        <button type="submit" name="issue_but" 
                          class="btn btn-danger btn-sm">Submit issue</button>
                        <div class="dropdown-divider"></div>
                        <button type="submit" name="dep_but" 
                          class="btn btn-primary btn-sm">Departed</button>
                      </form>
                    </div>
                  </div>  
                </th>                
              </tr> ';
                  }
                } ?>
              </tbody>
            </table>

          </div>
        </div>

        <!-- <div class="card" id="issue">
        <div class="card-body">
          <div class="dropdown" style="float: right;">
            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fa fa-filter"></i>
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" href="#flight">Today's flight</a>
              <a class="dropdown-item" href="#issue">Today's flight issues</a>
              <a class="dropdown-item" href="#dep">Flights departed today</a>
              <a class="dropdown-item" href="#arr">Flights arrived today</a>
            </div>
          </div>
          <p class="text-secondary">Today's Flight Issues</p>
          <table class="table-sm table table-hover table-bordered">
            <thead class="thead-dark">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Arrival</th>
                <th scope="col">Departure</th>
                <th scope="col">Destination</th>
                <th scope="col">Source</th>
                <th scope="col">Airline</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <?php
                $curr_date = (string)date('y-m-d');
                $curr_date = '20' . $curr_date;
                $sql = "SELECT * FROM Flight WHERE DATE(departure)=?";
                $stmt = mysqli_stmt_init($conn);
                mysqli_stmt_prepare($stmt, $sql);
                mysqli_stmt_bind_param($stmt, 's', $curr_date);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                while ($row = mysqli_fetch_assoc($result)) {
                  if ($row['status'] == 'issue') {
                    echo '              
                <td scope="row">
                  <a href="pass_list.php?flight_id=' . $row['flight_id'] . '">
                  ' . $row['flight_id'] . ' </a> </td>
                <td>' . $row['arrivale'] . '</td>
                <td>' . $row['departure'] . '</td>
                <td>' . $row['Destination'] . '</td>
                <td>' . $row['source'] . '</td>
                <td>' . $row['airline'] . '</td> 
                <th class="options">
                  <div class="dropdown">
                    <a class="text-reset text-decoration-none" href="#" 
                      id="dropdownMenuButton" data-toggle="dropdown" 
                        aria-haspopup="true" aria-expanded="false">
                      
                      <i class="fa fa-ellipsis-v"></i> </td>
                    </a>  
                    <div class="dropdown-menu">
                      <form class="px-4 py-3"  action="../includes/admin/admin.inc.php" method="post">
                        <input type="hidden" type="number" name="flight_id" 
                          value=' . $row['flight_id'] . '>  
                        <button type="submit" name="issue_soved_but" 
                          class="btn btn-danger btn-sm">Issue Solved!</button>
                      </form>
                    </div>
                  </div>  
                </th>                
              </tr> ';
                  }
                } ?>
            </tbody>
          </table>

        </div>
      </div> -->

        <div class="card" id="dep">
          <div class="card-body">

            <p class="heading-table">Flights Departed Today</p>
            <table class="table-sm table table-hover table-bordered">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Arrival</th>
                  <th scope="col">Departure</th>
                  <th scope="col">Destination</th>
                  <th scope="col">Source</th>
                  <th scope="col">Airline</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <?php
                  $curr_date = (string)date('y-m-d');
                  $curr_date = '20' . $curr_date;
                  $sql = "SELECT * FROM Flight WHERE DATE(departure)=?";
                  $stmt = mysqli_stmt_init($conn);
                  mysqli_stmt_prepare($stmt, $sql);
                  mysqli_stmt_bind_param($stmt, 's', $curr_date);
                  mysqli_stmt_execute($stmt);
                  $result = mysqli_stmt_get_result($stmt);
                  while ($row = mysqli_fetch_assoc($result)) {
                    if ($row['status'] == 'dep') {
                      echo '              
                <td scope="row">
                  <a href="pass_list.php?flight_id=' . $row['flight_id'] . '">
                  ' . $row['flight_id'] . ' </a> </td>
                <td>' . $row['arrivale'] . '</td>
                <td>' . $row['departure'] . '</td>
                <td>' . $row['Destination'] . '</td>
                <td>' . $row['source'] . '</td>
                <td>' . $row['airline'] . '</td> 
                <th class="options">
                  <div class="dropdown">
                    <a class="text-reset text-decoration-none" href="#" 
                      id="dropdownMenuButton" data-toggle="dropdown" 
                        aria-haspopup="true" aria-expanded="false">
                      
                      <i class="fa fa-ellipsis-v"></i> </td>
                    </a>  
                    <div class="dropdown-menu">
                      <form class="px-4 py-3"  action="../includes/admin/admin.inc.php" method="post">
                        <input type="hidden" type="number" name="flight_id" 
                          value=' . $row['flight_id'] . '>  
                        <button type="submit" name="arr_but" 
                          class="btn btn-danger">Arrived</button>
                      </form>
                    </div>
                  </div>  
                </th>                
              </tr> ';
                    }
                  } ?>
              </tbody>
            </table>

          </div>
        </div>

        <div class="card mb-4" id="arr">
          <div class="card-body">

            <p class="heading-table">Flights Arrived Today</p>
            <table class="table-sm table table-hover table-bordered">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Arrival</th>
                  <th scope="col">Departure</th>
                  <th scope="col">Destination</th>
                  <th scope="col">Source</th>
                  <th scope="col">Airline</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <?php
                  $curr_date = (string)date('y-m-d');
                  $curr_date = '20' . $curr_date;
                  $sql = "SELECT * FROM Flight WHERE DATE(departure)=?";
                  $stmt = mysqli_stmt_init($conn);
                  mysqli_stmt_prepare($stmt, $sql);
                  mysqli_stmt_bind_param($stmt, 's', $curr_date);
                  mysqli_stmt_execute($stmt);
                  $result = mysqli_stmt_get_result($stmt);
                  while ($row = mysqli_fetch_assoc($result)) {
                    if ($row['status'] == 'arr') {
                      echo '              
                <td scope="row">
                  <a href="pass_list.php?flight_id=' . $row['flight_id'] . '">
                  ' . $row['flight_id'] . ' </a> </td>
                <td>' . $row['arrivale'] . '</td>
                <td>' . $row['departure'] . '</td>
                <td>' . $row['Destination'] . '</td>
                <td>' . $row['source'] . '</td>
                <td>' . $row['airline'] . '</td>                
              </tr> ';
                    }
                  } ?>
              </tbody>
            </table>

          </div>
        </div>
      </div>
    </div>
  <?php } ?>
</main>
<?php include_once 'footer.php'; ?>