<?php include_once 'helpers/helper.php'; ?>

<?php subview('header.php'); ?>

<style>
    body {
        font-family: "Poppins";
    }

    h3 {
        text-align: center;
        font-weight: normal;
        font-size: 55px;
        margin-top: 20px !important;
        color: black;
    }

    input {
        margin-bottom: 10px;
        border: 0px !important;
        border-bottom: 2px solid #838383 !important;
        color: black !important;
        border-radius: 0px !important;
        font-weight: bold !important;
    }

    label {
        color: black !important;
        font-size: 19px;
    }

    .register {
        margin-top: 3%;
        padding: 3%;
        width: 50%;
    }

    .register-left {
        text-align: center;
        color: #fff;
        margin-top: 4%;
    }

    .register-left input {
        border: none;
        border-radius: 1.5rem;
        padding: 2%;
        width: 60%;
        background: #f8f9fa;
        font-weight: bold;
        color: #383d41;
        margin-top: 30%;
        margin-bottom: 3%;
        cursor: pointer;
    }

    .register-right {
        background: white;
        border: 3px #04c2af solid;
        border-radius: 20px;
        
    }

    .register-left img {
        margin-top: 15%;
        margin-bottom: 5%;
        width: 25%;
        -webkit-animation: mover 2s infinite alternate;
        animation: mover 1s infinite alternate;
    }

    @-webkit-keyframes mover {
        0% {
            transform: translateY(0);
        }

        100% {
            transform: translateY(-20px);
        }
    }

    @keyframes mover {
        0% {
            transform: translateY(0);
        }

        100% {
            transform: translateY(-20px);
        }
    }

    .register-left p {
        font-weight: lighter;
        padding: 12%;
        margin-top: -9%;
    }

    .register .register-form {
        padding: 60px;
        margin-top: 10%;
        width: 120%;
        margin-left: -20px;
    }

    .btnRegister {
        float: right;
        margin-top: 10%;
        border: none;
        border-radius: 1.5rem;
        padding: 2%;
        background: #4e4e4e;
        color: #fff;
        font-weight: 600;
        width: 50%;
        cursor: pointer;
    }

    .register-heading {
        text-align: center;
        margin-top: 8%;
        margin-bottom: -15%;
        color: black;
    }

    h1 {
        font-size: 46px !important;
        margin-bottom: 20px;
        font-family: 'product sans' !important;
        font-weight: bolder;
        color: black;
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
    width: 80%;
    border: 0;
    margin-top: 25px;
    margin-left: -45px;
  }

  .buton:hover {
    background: #0c85e9;
    text-decoration: none;
  }

</style>
<?php
if (isset($_GET['error'])) {
    if ($_GET['error'] === 'invalidemail') {
        echo '<script>alert("Invalid email")</script>';
    } else if ($_GET['error'] === 'pwdnotmatch') {
        echo '<script>alert("Passwords do not match")</script>';
    } else if ($_GET['error'] === 'sqlerror') {
        echo "<script>alert('Database error')</script>";
    } else if ($_GET['error'] === 'usernameexists') {
        echo "<script>alert('Username already exists')</script>";
    } else if ($_GET['error'] === 'emailexists') {
        echo "<script>alert('Email already exists')</script>";
    }
}
?>
<link rel="stylesheet" href="assets/css/form.css">
<main>
    <div class="container-fluid mt-0 register">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10 register-right">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <h1 style="color: black;margin-top: 4%;margin-bottom: -15%;margin-left:4%">Sign Up</h1>
                        <div class="register-form">
                            <form method="POST" action="includes/register.inc.php">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-1 p-0 mr-2">
                                            <i class="fa fa-user" style="float: right;margin-top:35px;"></i>
                                        </div>
                                        <div class="col-md">
                                            <div class="input-group">
                                                <label for="username">Username</label>
                                                <input type="text" name="username" id="username" required />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-1 p-0 mr-2">
                                            <i class="fa fa-envelope " style="float: right;margin-top:35px;"></i>
                                        </div>
                                        <div class="col-md">
                                            <div class="input-group">
                                                <label for="email_id">Email</label>
                                                <input type="text" name="email_id" id="email_id" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row ">
                                        <div class="col-1 p-0 mr-2" >
                                            <i class="fa fa-lock " style="float: right;margin-top:35px;"></i>
                                        </div>
                                        <div class="col-md">
                                            <div class="input-group">
                                                <label for="password"> Password</label>
                                                <input type="password" name="password" id="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter and at least 8 or more characters" />
                                            </div>

                                        </div>
                                    </div>
                                    <div class=" row">

                                        <div class="col-1 p-0 mr-2">
                                            <i class="fa fa-lock " style="float: right;margin-top:35px;"></i>
                                        </div>
                                        <div class="col-md">
                                            <div class="input-group">
                                                <label for="password_repeat">Confirm password</label>
                                                <input type="password" name="password_repeat" id="password_repeat" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button name="signup_submit" type="submit" class="buton">
                                            <div>
                                                <i class="fa fa-lg fa-arrow-right"></i> Register
                                            </div>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-1"></div>
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