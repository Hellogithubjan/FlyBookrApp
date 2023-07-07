<?php include_once 'helpers/helper.php'; ?>
<?php subview('header.php'); ?>
<script src="https://kit.fontawesome.com/d70c1f6414.js" crossorigin="anonymous"></script>
<style>
    body {
        font-family: "Poppins", sans-serif;
        overflow-x: hidden;
    }

    h2.brand {
        font-size: 27px !important;
    }

    .vl {
        border-left: 6px solid #424242;
        height: 400px;
    }

    p.head {
        font-family: arial;
        font-size: 17px;
        margin-bottom: 10px;
        color: grey;
    }

    p.txt {
        font-family: arial;
        font-size: 25px;
        font-weight: bolder;
    }

    .out {
        border-radius: 25px;
        border: 1px solid black;
        background-color: white;
        padding-left: 25px;
        padding-right: 0px;
        padding-top: 20px;
    }

    h2 {
        font-weight: lighter !important;
        font-size: 35px !important;
        margin-bottom: 20px;
        font-weight: bolder;
    }

    .text-light2 {
        color: #d9d9d9;
    }

    h3 {
        font-size: 21px !important;
        margin-bottom: 20px;
        font-weight: lighter;
    }

    h1 {
        font-size: 30px !important;
        margin-bottom: 20px;
        font-weight: bold;
    }

    .mb-5 {
        height: 450px;
    }

    .col {
        margin-left: 60px;
    }

    hr {
        margin-right: 15px;
        border-color: bla;
    }
    .buton {
    -webkit-border-radius: 6;
    -moz-border-radius: 6;
    border-radius: 6px;
    color: #ffffff;
    font-size: 20px;
    background: #04c2af;
    padding: 10px 35px 10px 35px;
    text-decoration: none;
    width: 100%;
    border: 0;
    margin-left: -40px;
    margin-top: 10px;
  }

  .buton:hover {
    background: #0c85e9;
    text-decoration: none;
  }
</style>
<main>
    <?php if (isset($_SESSION['userId'])) {
        require 'helpers/init_conn_db.php';

        if (isset($_POST['cancel_but'])) {
            $ticket_id = $_POST['ticket_id'];
            $stmt = mysqli_stmt_init($conn);
            $sql = 'SELECT * FROM Ticket WHERE ticket_id=?';
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header('Location: ticket.php?error=sqlerror');
                exit();
            } else {
                mysqli_stmt_bind_param($stmt, 'i', $ticket_id);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                if ($row = mysqli_fetch_assoc($result)) {
                    $sql_pas = 'DELETE FROM Passenger_profile WHERE passenger_id=? 
                ';
                    $stmt_pas = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt_pas, $sql_pas)) {
                        header('Location: ticket.php?error=sqlerror');
                        exit();
                    } else {
                        mysqli_stmt_bind_param($stmt_pas, 'i', $row['passenger_id']);
                        mysqli_stmt_execute($stmt_pas);
                        $sql_t = 'DELETE FROM Ticket WHERE ticket_id=?';
                        $stmt_t = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($stmt_t, $sql_t)) {
                            header('Location: ticket.php?error=sqlerror');
                            exit();
                        } else {
                            mysqli_stmt_bind_param($stmt_t, 'i', $row['ticket_id']);
                            mysqli_stmt_execute($stmt_t);
                        }
                    }
                }
            }
        }

    ?>
        <div class="container mb-5">
            <h1 class=" mt-4 mb-4">E-Tickets</h1>

            <?php
            $stmt = mysqli_stmt_init($conn);
            $sql = 'SELECT * FROM Ticket WHERE user_id=?';
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header('Location: ticket.php?error=sqlerror');
                exit();
            } else {
                mysqli_stmt_bind_param($stmt, 'i', $_SESSION['userId']);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                while ($row = mysqli_fetch_assoc($result)) {
                    $sql_p = 'SELECT * FROM Passenger_profile WHERE passenger_id=?';
                    $stmt_p = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt_p, $sql_p)) {
                        header('Location: ticket.php?error=sqlerror');
                        exit();
                    } else {
                        mysqli_stmt_bind_param($stmt_p, 'i', $row['passenger_id']);
                        mysqli_stmt_execute($stmt_p);
                        $result_p = mysqli_stmt_get_result($stmt_p);
                        if ($row_p = mysqli_fetch_assoc($result_p)) {
                            $sql_f = 'SELECT * FROM Flight WHERE flight_id=?';
                            $stmt_f = mysqli_stmt_init($conn);
                            if (!mysqli_stmt_prepare($stmt_f, $sql_f)) {
                                header('Location: ticket.php?error=sqlerror');
                                exit();
                            } else {
                                mysqli_stmt_bind_param($stmt_f, 'i', $row['flight_id']);
                                mysqli_stmt_execute($stmt_f);
                                $result_f = mysqli_stmt_get_result($stmt_f);
                                if ($row_f = mysqli_fetch_assoc($result_f)) {
                                    $date_time_dep = $row_f['departure'];
                                    $date_dep = substr($date_time_dep, 0, 10);
                                    $time_dep = substr($date_time_dep, 10, 6);
                                    $date_time_arr = $row_f['arrival'];
                                    $date_arr = substr($date_time_arr, 0, 10);
                                    $time_arr = substr($date_time_arr, 10, 6);
                                    if ($row['class'] === 'E') {
                                        $class_txt = 'Economy';
                                    } elseif ($row['class'] === 'B') {
                                        $class_txt = 'Business';
                                    }
                                    echo '
                        <div class="row mb-5" style="width:150%">                                                         
                        <div class="col-8 out" >
                            <div class="row ">                                                     
                                <div class="col">
                                
                                    <h2 class=" mb-0 brand">
                                    <img src="assets/images/logo.png"  height="30px" width="30px" alt="">
                                        FLYBOOKR.com
                                        </h2> 
                                </div>
                                
                            </div>
                            <hr>
                            <div class="row mb-3">  
                                <div class="col">
                                    <p class="head">Airline</p>
                                    <p class=" h5">' . $row_f['airline'] . '</p>
                                </div>            
                                <div class="col">
                                    <p class="head">From</p>
                                    <p class=" h5">' . $row_f['source'] . '</p>
                                </div>
                                <div class="col">
                                    <p class="head">To</p>
                                    <p class=" h5">' . $row_f['Destination'] . '</p>                
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <p class="head">Passenger</p>
                                    <p class=" h5">
                                    ' . $row_p['f_name'] . '' . $row_p['l_name'] . '
                                    </p>                              
                                </div>
                                <div class="col">
                                    <p class="head">Gate</p>
                                    <p class="h5">A22</p>
                                </div>            
                                <div class="col">
                                    <p class="head">Seat</p>
                                    <p class="h5">' . $row['seat_no'] . '</p>
                                </div>   
                            </div>
                            
                            <div class="row">
                                <div class="col">
                                    <p class="head">Departure</p>
                                    <p class="h5">' . $date_dep . '&nbsp&nbsp' . '&nbsp&nbsp ' . $time_dep . '</p>
                                     
                                </div>            
                                <div class="col">
                                    <p class="head">Arrival</p>
                                    <p class="h5">' . $date_arr . ' &nbsp&nbsp' . '&nbsp&nbsp  ' . $time_arr . '</p>
                                    
                                </div>
                                <div class="col">
                                    <p class="head">Class</p>
                                    <p class="h5">' . $class_txt . '</p>
                                </div>                
                            </div>  
                            
                            <div class="row">
                                <div class="col"> 
                                    <form class="px-4 py-3"  action="ticket.php" method="post">
                                        <input type="hidden" name="ticket_id" value=' . $row['ticket_id'] . '>
                                        <button class="buton" name="cancel_but">
                                        <i class="fa fa-trash"></i> &nbsp; Cancel</button>
                                    </form>
                                </div>
                                <div class="col"> 
                                    <form class="px-4 py-3"  action="email_pdf.php" method="post">
                                        <input type="hidden" name="ticket_id" value=' . $row['ticket_id'] . '>
                                        <button class="buton" onclick="myfunction()" name="cancel_but">
                                        <i class="fa-solid fa-envelope"></i> &nbsp; Mail Ticket</button>
                                    </form>
                                </div>
                                <div class="col"> 
                                    <form class="px-4 py-3" action="e_ticket.php" target="_blank" method="post">
                                        <input type="hidden" name="ticket_id" value=' . $row['ticket_id'] . '>
                                        <button class="buton" name="print_but">
                                        <i class="fa fa-print"></i> &nbsp; Print Ticket</button>
                                    </form>   
                                </div> 
                            </div>
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
</main>
<?php } ?>
<?php subview('footer.php'); ?>