<?php
session_start();
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href='//fonts.googleapis.com/css?family=Open+Sans:400,300italic,300,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
  <link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
  <link href="https://fonts.googleapis.com/css2?family=Italianno&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://kit.fontawesome.com/44f557ccce.js"></script>
  <!-- Bootstrap CSS -->

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <title>FLYBOOKR.com</title>
    <link rel="icon" type="image/x-icon" href="../assets/images/logo.ico">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="icon" href="../assets/images/brand.png" type="image/x-icon">
</head>
<style>
  body {
    font-family: "Poppins", sans-serif;
  }

  h5:hover {
    color: rgb(12, 133, 233);
  }

  .logo {
    width: 80px;
    height: 80px;
    padding: 0;
    margin: 0;
  }

  .ml-2 {
    color: black;
  }
  
  
</style>

<body>

  <nav class="navbar navbar-expand-lg navbar-dark" style="margin-top: 20px;">
    <a class="navbar-brand" href="index.php" style="display: flex;">
      <img class="logo" src="../assets/images/logo.png">
      <h5 style="margin-left:-5px;
            margin-top:20px;
            font-size:25px;
            color:black;
            font-weight:600;
            font-family:Poppins,sans-serif">FLYBOOKR.com</h5>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">

      <?php
      if (isset($_SESSION['adminId'])) { ?>
        <ul class="navbar-nav mr-auto">

          <li class="nav-item">
            <a class="nav-link" href="index.php">
              <h5 class="ml-2"> Dashboard</h5>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="flight.php">
              <h5 class="ml-2"> Create Flight</h5>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="all_flights.php">
              <h5 class="ml-2">Flights</h5>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="list_airlines.php">
              <h5 class="ml-2">Airlines</h5>
            </a>
          </li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li class="nav-item">
            <div class="dropdown mt-2">
              <button class="btn" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="display:flex;" >
                <i class="ml-1 fa fa-plus"></i>
                <h5 class="ml-2"> Add Flights</h5>
              </button>
              <div class="dropdown-menu">
                <form class="px-2 py-2" action="../includes/admin/airline.inc.php" method="post">
                  <div class="form-group">
                    <input type="text" class="form-control" name="airline" placeholder="Airlines Name">
                    <input type="number" class="form-control mt-3" name="seats" placeholder="Total Seats">
                  </div>
                  <button type="submit" name="air_but" class="btn btn-primary w-100">Submit</button>
                </form>
              </div>
            </div>
          </li>
          <li class="nav-item  p-1 ">
            <a class="nav-link" href="">
              <i class="ml-1 fa fa-user" style="color: black;"></i>
              <span class="nav_link" style="font-size: 20px;color:black">
                <?php echo  $_SESSION['adminUname']; ?>
              </span>
            </a>
          </li>
        </ul>
        <form action="../includes/logout.inc.php" method="POST">
          <button class="btn btn-outline-dark m-4" type="submit">
            Logout </button>
        </form>
    </div>
  <?php } ?>


  </nav>