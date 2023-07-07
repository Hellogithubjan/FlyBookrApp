<?php include_once 'helpers/helper.php'; ?>
<?php subview('header.php'); ?>
<link rel="stylesheet" href="assets/css/form.css">
<script src="https://kit.fontawesome.com/d70c1f6414.js" crossorigin="anonymous"></script>
<style>
  input {
    border: 0px !important;
    border-bottom: 2px solid #828282 !important;
    color: #424242 !important;
    border-radius: 0px !important;
    font-weight: bold !important;
    margin-bottom: 10px;
    color: black !important;
    font-size: 16px;
  }

  label {
    color: black !important;
    font-size: 16px;
  }

  .input-group-addon {
    background-color: transparent;
    border-left: 0;
  }

  h1 {
    font-size: 30px !important;
    margin-bottom: 20px;
    font-weight: bold;
  }

  .cc-number.identified {
    background-repeat: no-repeat;
    background-position-y: 3px;
    background-position-x: 99%;
  }

  .one-card>div {
    height: 150px;
    background-position: center center;
    background-repeat: no-repeat;
   
  }

  .two-card>div {
    height: 80px;
    background-position: center center;
    background-repeat: no-repeat;
    background-size: contain;
    width: 48%;
   
  }

  

  .two-card div.amex-cvc-preview {
    float: right;
  }

  body {
    background: transparent
  }

  textarea:focus,
  textarea.form-control:focus,
  input.form-control:focus,
  input[type=text]:focus,
  input[type=password]:focus,
  input[type=email]:focus,
  input[type=number]:focus,
  [type=text].form-control:focus,
  [type=password].form-control:focus,
  [type=email].form-control:focus,
  [type=tel].form-control:focus,
  [contenteditable].form-control:focus {
    box-shadow: inset 0 -1px 0 #ddd;
  }
</style>
<?php if (isset($_SESSION['userId'])) {   ?>
  <main>
    <?php
    if (isset($_GET['error'])) {
      if ($_GET['error'] === 'sqlerror') {
        echo "<script>alert('Database error')</script>";
      } else if ($_GET['error'] === 'noret') {
        echo "<script>alert('No return flight available')</script>";
      } else if ($_GET['error'] === 'mailerr') {
        echo "<script>alert('Mail error')</script>";
      }
    }
    ?>
    <div class="container-fluid py-3">
      <div class="row">
        <div class="col-12 col-sm-8 col-md-6 col-lg-4 mx-auto">
          <h1>Pay Your Bill</h1>
          <div id="pay-invoice" class="card">
            <div class="card-body">
              <label for="fname">Accepted Cards</label>
              <div class="icon-container">
                <i class="fa fa-cc-visa fa-3x" style="color:navy;"></i>
                <i class="fa fa-cc-amex fa-3x" style="color:blue;"></i>
                <i class="fa fa-cc-mastercard fa-3x" style="color:red;"></i>
                <i class="fa fa-cc-discover fa-3x" style="color:orange;"></i>
                <i class="fa fa-cc-stripe fa-3x" style="color:blue;"></i>
              </div>
              <hr>
              <form action="includes/payment.inc.php" method="post" novalidate="novalidate" class="needs-validation">

                <div class="form-group">
                  <label for="cc-number" class="control-label mb-1"><i class="fa-solid fa-credit-card"></i> Card number</label>
                  <input id="cc-number" name="cc-number" type="tel" class="form-control cc-number identified visa" required autocomplete="off">
                  <span class="invalid-feedback">Enter a valid 12 to 16 digit card number</span>
                </div>
                <div class="row">
                  <div class="form-group col-6">
                    <label for="cc-number" class="control-label mb-1"><i class="fa-solid fa-user"></i> Card Holder's Name</label>
                    <input id="cc-name" name="cc-name" type="text" class="form-control cc-number identified visa" required autocomplete="off">
                  </div>
                  <div class="form-group col-6">
                    <label for="cc-number" class="control-label mb-1"><i class="fa-solid fa-indian-rupee-sign"></i> Total Amount</label>
                    <?php $rupees = $_SESSION['price'] ?>
                    <input  value=<?php echo 'Rs.' . $rupees; ?> type="tel" class="form-control cc-number identified visa" required autocomplete="off">
                  </div>
                </div>
                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                      <label for="cc-exp" class="control-label mb-1"><i class="fa-solid fa-calendar-days"></i> Expiration Date</label>
                      <input id="cc-exp" name="cc-exp" type="tel" class="form-control cc-exp" required placeholder="MM / YY" autocomplete="cc-exp">
                      <span class="invalid-feedback">Enter the expiration date</span>
                    </div>
                  </div>
                  <div class="col-6 ">
                    <label for="x_card_code" class="control-label mb-1"><i class="fa-regular fa-credit-card"></i> CVV</label>
                        <input id="x_card_code" name="x_card_code" type="password" class="form-control cc-cvc" required autocomplete="off">
                  </div>
                </div>

                <br />

                <div class='form-row'>
                  <div class='col-md-12 mb-2'>
                    <button id="payment-button" type="submit" name="pay_but" class="btn btn-lg btn-primary btn-block">
                      <i class="fa fa-lock fa-lg"></i>&nbsp;
                      <span id="payment-button-amount">Pay </span>
                      <span id="payment-button-sending" style="display:none;">Sending…</span>
                    </button>
                  </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
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

    $(function() {
      $('[data-toggle="popover"]').popover()
    })



    $("#payment-button").click(function(e) {

      var form = $(this).parents('form');

      var cvv = $('#x_card_code').val();
      var regCVV = /^[0-9]{3,4}$/;
      var CardNo = $('#cc-number').val();
      var regCardNo = /^[0-9]{12,16}$/;
      var date = $('#cc-exp').val().split('/');
      var regMonth = /^01|02|03|04|05|06|07|08|09|10|11|12$/;
      var regYear = /^20|21|22|23|24|25|26|27|28|29|30|31$/;

      if (form[0].checkValidity() === false) {
        e.preventDefault();
        e.stopPropagation();
      } else {
        if (!regCardNo.test(CardNo)) {

          $("#cc-number").addClass('required');
          $("#cc-number").focus();
          alert(" Enter a valid 10 to 16 card number");
          return false;
        } else if (!regCVV.test(cvv)) {

          $("#x_card_code").addClass('required');
          $("#x_card_code").focus();
          alert(" Enter a valid CVV");
          return false;
        } else if (!regMonth.test(date[0]) && !regMonth.test(date[1])) {

          $("#cc_exp").addClass('required');
          $("#cc_exp").focus();
          alert(" Enter a valid exp date");
          return false;
        }



        form.submit();
      }

      form.addClass('was-validated');
    });
  </script>
  </main>
<?php } ?>