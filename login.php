<?php include_once 'helpers/helper.php'; ?>

<?php subview('header.php'); ?>
<link rel="stylesheet" href="assets/css/form.css">
<?php
if (isset($_GET['pwd'])) {
  if ($_GET['pwd'] == 'updated') {
    echo "<script>alert('Your password has been reset!!');</script>";
  }
}
?>
<?php
if (isset($_GET['error'])) {
  if ($_GET['error'] === 'invalidcred') {
    echo '<script>alert("Invalid Credentials")</script>';
  } else if ($_GET['error'] === 'wrongpwd') {
    echo '<script>alert("Wrong Password")</script>';
  } else if ($_GET['error'] === 'sqlerror') {
    echo "<script>alert('Database error')</script>";
  }
}
if (isset($_COOKIE['Uname']) && isset($_COOKIE['Upwd'])) {
  require 'helpers/init_conn_db.php';
  $email_id = $_POST['user_id'];
  $password = $_POST['user_pass'];
  $sql = 'SELECT * FROM Users WHERE username=? OR email=?;';
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header('Location: views/login.php?error=sqlerror');
    exit();
  } else {
    mysqli_stmt_bind_param($stmt, 'ss', $_COOKIE['Uname'], $_COOKIE['Uname']);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($result)) {
      $pwd_check = password_verify($_COOKIE['Upwd'], $row['password']);
      if ($pwd_check == false) {
        setcookie('Uname', '', time() - 3600);
        setcookie('Upwd', '', time() - 3600);
        header('Location: views/login.php?error=wrongpwd');
        exit();
      } else if ($pwd_check == true) {
        session_start();
        $_SESSION['userId'] = $row['user_id'];
        $_SESSION['userUid'] = $row['username'];
        $_SESSION['userMail'] = $row['email'];
        header('Location: views/index.php?login=success');
        exit();
      } else {
        header('Location: views/login.php?error=invalidcred');
        exit();
      }
    }
    header('Location: views/login.php?error=invalidcred');
    exit();
  }
  header('Location: views/login.php?error=invalidcred');
  exit();
  mysqli_stmt_close($stmt);
  mysqli_close($conn);
}
?>
<style>
  body {
    font-family: "Poppins", sans-serif;
  }

  input {
    border: 0px !important;
    border-bottom: 2px solid #838383 !important;
    color: black !important;
    border-radius: 0px !important;
    font-weight: bold !important;
    background-color: white !important;
    border: none;
    border-bottom: 2px solid black;
  }

  *:focus {
    outline: none !important;
  }

  label {
    color: black !important;
    font-size: 19px;
  }

  h5.form-name {
    color: #838383;
    font-family: 'Courier New', Courier, monospace;
    font-weight: 50;
    margin-bottom: 0px !important;
    margin-top: 10px;
  }

  h5 {
    color: #ffffff;
    font-weight: bold;
    font-size: 22px;
    font-family: 'Montserrat', sans-serif;
  }

  a:hover {
    text-decoration: none;
  }

  h1 {
    font-size: 46px !important;
    margin-bottom: 20px;
    font-family: 'product sans' !important;
    font-weight: bolder;
    color: black;
  }

  div.form-out {
    background-color: white !important;
    padding: 40px;
    margin-top: 60px;
    border: 3px #04c2af solid;
    border-radius: 20px;
  }

  .input-group {
    position: relative;
    display: inline-block;
    width: 100%;
    background-color: white !important;
  }

  select {
    float: right;
    font-weight: bold !important;
    color: #838383 !important;
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
  }

  .buton:hover {
    background: #0c85e9;
    text-decoration: none;
  }

</style>
<main>
  <div class="container mt-0">
    <div class="row">
      <div class="col-md-3"></div>
      <div class=" form-out col-md-6">
        <h1 >Sign In</h1>

        <form method="POST" class=" text-center" action="includes/login.inc.php">

          <div class="form-row">
            <div class="col-1 p-0 mr-1">
              <i class="fa fa-user " style="float: right;margin-top:35px;color:black"></i>
            </div>
            <div class="col-10 mb-2">
              <div class="input-group">
                <label for="user_id" s>Username/ Email</label>
                <input type="text" name="user_id" id="user_id" required>
              </div>
            </div>
            <div class="col-1 p-0 mr-1">
              <i class="fa fa-lock " style="float:right;margin-top:35px;color:black"></i>
            </div>
            <div class="col-10">
              <div class="input-group">
                <label for="user_pass">Password</label>
                <input type="password" name="user_pass" id="user_pass" required>
              </div>
            </div>
          </div>

          <div class="row mt-5">
            <div class="col">
              <button name="login_but" type="submit" class="buton">
                <div>
                  <i class="fa fa-lg fa-arrow-right"></i> &nbsp Login
                </div>
              </button>
            </div>
          </div>
          <div class="row mt-4">
            <div class="col">
              Don't have an account?<a style="color:#0c85e9;font-weight:bold" href="register.php"> Register</a>
            </div>
          </div>

        </form>
      </div>
      <div class="col-md-3"></div>
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