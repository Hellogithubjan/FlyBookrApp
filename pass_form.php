<?php include_once 'helpers/helper.php'; ?>
<?php subview('header.php'); ?>
<link rel="stylesheet" href="assets/css/form.css">
<style>
    .main-col {
        padding: 30px;
        background-color: whitesmoke;
        margin-top: 50px;
    }

    .pass-form {
        background-color: white;
        padding: 20px;
        margin-top: 30px;
    }

    body {
        font-family: "Poppins", sans-serif;
    }

    h1 {
        font-size: 42px !important;
        margin-bottom: 20px;
        font-weight: bolder;
        color: black;
    }

    input {
        border: 0px !important;
        border-bottom: 2px solid #424242 !important;
        color: black !important;
        border-radius: 0px !important;
        font-weight: bold !important;
        margin-bottom: 10px;
    }


    label {
        color: black !important;
        font-size: 19px;
    }

    p{
        margin-top: 30px;
        font-weight: bold;
        font-size: 20px;
    }

    .buton {
    -webkit-border-radius: 6;
    -moz-border-radius: 6;
    border-radius: 6px;
    color: #ffffff;
    font-size: 20px;
    background: #0c85e9;
    padding: 10px 35px 10px 35px;
    text-decoration: none;
    width: 50%;
    border: 0;
  }

  .buton:hover {
    background: #0c85e9;
    text-decoration: none;
  }

    @media screen and (max-width: 900px) {
        body {
            background: #bdc3c7;
            background: -webkit-linear-gradient(to right, #2c3e50, #bdc3c7);
            background: linear-gradient(to right, #2c3e50, #bdc3c7);

        }
    }
    
</style>
<?php
if (isset($_GET['error'])) {
    if ($_GET['error'] === 'invdate') {
        echo '<script>alert("Invalid date of birth")</script>';
    } else if ($_GET['error'] === 'moblen') {
        echo '<script>alert("Invalid contact info")</script>';
    } else if ($_GET['error'] === 'sqlerror') {
        echo "<script>alert('Database error')</script>";
    }
    echo "<script>location.replace(document.referer)</script>";
}
?>
<?php if (isset($_SESSION['userId']) && isset($_POST['book_but'])) {
    $flight_id = $_POST['flight_id'];
    $passengers = $_POST['passengers'];
    $price = $_POST['price'];
    $class = $_POST['class'];
    $type = $_POST['type'];
    $ret_date = $_POST['ret_date'];
?>
    <main>
        <div class="container mb-5">
            <div class="col-md-12 main-col">
                <h1 class="text-center ">Passenger Details</h1>
                <form action="includes/pass_detail.inc.php" class="needs-validation mt-4" method="POST">

                    <input type="hidden" name="type" value=<?php echo $type; ?>>
                    <input type="hidden" name="ret_date" value=<?php echo $ret_date; ?>>
                    <input type="hidden" name="class" value=<?php echo $class; ?>>
                    <input type="hidden" name="passengers" value=<?php echo $passengers; ?>>
                    <input type="hidden" name="price" value=<?php echo $price; ?>>
                    <input type="hidden" name="flight_id" value=<?php echo $flight_id; ?>>
                    <?php for ($i = 1; $i <= $passengers; $i++) {
                        echo '  
            <p>Passenger - '.$i.'</p>
            <div class="pass-form">  
                <div class="form-row">
                    <div class="col-md">
                        <div class="input-group">
                            <label for="firstname' . $i . '">Firstname</label>
                            <input type="text" name="firstname[]" id="firstname' . $i . '" class="pl-0 pr-0" 
                                required style="width: 100%;">
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="input-group">
                            <label for="lastname' . $i . '">Lastname</label>
                            <input type="text" name="lastname[]" id="lastname' . $i . '" class="pl-0 pr-0"
                                required style="width: 100%;">
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md">
                        <div class="input-group">
                            <label for="mobile' . $i . '">Mobile No</label>
                            <input type="number" name="mobile[]" min="0" id="mobile' . $i . '" 
                                required>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="input-group"> 
                            <input id="date" name="date[]" type="date" required>
                        </div>
                    </div>
                </div>
            </div>';
                    }  ?>
                    <div class="col text-center">
                        <button name="pass_but" type="submit" class="buton  mt-4">
                            <div>
                                <i class="fa fa-lg fa-arrow-right"></i>&nbsp Submit
                            </div>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <?php subview('footer.php'); ?>
        <script>
            $(document).ready(function() {
                $('.input-group input').focus(function() {
                    me = $(this);
                    $("label[for='" + me.attr('id') + "']").addClass("animate-label");
                });
                $('.input-group input').blur(function() {
                    me = $(this);
                    if (me.val() == "") {
                        $("label[for='" + me.attr('id') + "']").removeClass("animate-label");
                    }
                });
            });
        </script>
    </main>
<?php } ?>