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
    <link rel="icon" type="image/x-icon" href="assets/images/logo.ico">
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
</style>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark" style="margin-top: 20px;">
        <a class="navbar-brand" href="index.php" style="display: flex;">
            <img class="logo" src="assets/images/logo.png">
            <h5 style="margin-left:-5px;
            margin-top:20px;
            font-size:25px;
            color:black;
            font-weight:600;
            font-family:Poppins,sans-serif">FLYBOOKR.com</h5>
        </a>


        <div class="collapse navbar-collapse" id="navbarSupportedContent" style="margin-top: -10px;margin-left:30px">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">
                        <h5 style="color: black;font-weight: bold;font-size: 17px;margin-right:10px;font-family:Poppins,sans-serif" onmouseover="this.style.color='#0c85e9';" onmouseout="this.style.color='black';">Home</h5>
                    </a>
                </li>
                <?php if (isset($_SESSION['userId'])) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="my_flights.php">
                            <h5 style="color: black;font-weight: bold;font-size: 17px;margin-right:10px;font-family:Poppins,sans-serif" onmouseover="this.style.color='#0c85e9';" onmouseout="this.style.color='black';"> My Flights</h5>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="ticket.php">
                            <h5 style="color: black;font-weight: bold;font-size: 17px;margin-right:10px;font-family:Poppins,sans-serif" onmouseover="this.style.color='#0c85e9';" onmouseout="this.style.color='black';"> Tickets</h5>
                        </a>
                    </li>
                <?php } ?>
                <li class="nav-item">
                    <a class="nav-link" href="contactUs.php">
                        <h5 style="color: black;font-weight: bold;font-size: 17px;margin-right:10px;font-family:Poppins,sans-serif" onmouseover="this.style.color='#0c85e9';" onmouseout="this.style.color='black';">Contact</h5>
                    </a>
                </li>
            </ul>
            <?php
            if (isset($_SESSION['userId'])) {
                echo '
                <ul  class="nav navbar-nav navbar-right">
                    <li class="nav-item "style="margin-right:30px;position:relative;top:10px"> 
                            <h5 style="color: #0c85e9;font-weight: bold;font-size: 17px;">
                            <i class="ml-1 fa fa-user "></i>
                            ' . $_SESSION['userUid'] . '
                            </h5>
                    </li>          
                    <li class="nav-item ">
                        <a href="includes/logout.inc.php">
                            <button style="padding:10px;border:2px solid #0c85e9;border-radius:10px;background-color:#fff" >
                                <h5 style="color: black;font-weight: bold;font-size: 17px;"> Logout</h5>                            
                            </button>
                        </a> 
                    </li>  
                </ul>    ';
            } else {
                echo '
                <div class="dropdown "
                    style="margin-right:70px">
                <a class="text-light text-decoration-none dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <b style="color:black; font-size:17px">Login</b>                            
                </a>
                <div class="dropdown-menu w-75" aria-labelledby="dropdownMenuButton" style="position:absolute;left:-55px">
                    <a class="dropdown-item " href="login.php">Passenger</a>
                    <a class="dropdown-item " href="admin/login.php">Administrator</a>
                </div>
                </div>';
            }
            ?>
        </div>
    </nav>