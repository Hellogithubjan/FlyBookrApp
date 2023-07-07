<?php include_once 'header.php'; ?>
<?php include_once 'footer.php'; ?>
<?php require '../helpers/init_conn_db.php'; ?>

<link rel="stylesheet" href="../assets/css/flight_form.css">
<link rel="stylesheet" href="../assets/css/form.css">

<?php if(isset($_SESSION['adminId'])) { ?>

<style>
  input {
    border: 0px !important;
    
    color: black !important;
    border-radius: 0px !important;
    font-weight: bold !important;
    background-color: white !important;
    border: none;
     
    width: 90%;
  }
  *:focus {
    outline: none !important;
  }
  label {
    color: black !important;
    font-size: 19px;
  }
  h5.form-name {
    font-weight: 50;
    margin-bottom: 0px !important;
    margin-top: 10px;
  }
  h1 {
    font-size: 39px !important;
    margin-bottom: 40px;
    font-family: 'product sans' !important;
    font-weight: bolder;
    color: black;
  }
  
  div.form-out {
    background-color: white !important;
    padding: 30px;
    margin-top: 20px;
    border: 3px #04c2af solid;
    border-radius: 20px;
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
    width: 30%;
    border: 0;
    margin-left: 400px;
  }

  .buton:hover {
    background: #0c85e9;
    text-decoration: none;
  }
  

  @media screen and (max-width: 900px){
   
    div.form-out {
    padding: 20px;
    background-color: none !important;
    margin-top: 20px;
  }    
}  
</style>
<main>
<div class="container mt-0">
  <div class="row">
    <?php
    if(isset($_GET['error'])) {
        if($_GET['error'] === 'destless') {
            echo "<script>alert('Dest. date/time is less than src.');</script>";
        } else if($_GET['error'] === 'sqlerr') {
          echo "<script>alert('Database error');</script>";
        } else if($_GET['error'] === 'same') {
          echo "<script>alert('Same city specified in source and destination');</script>";
        }
    }
    ?>
      <div class="bg-light form-out col-md-12">
      <h1 >Add Flight Details</h1>

      <form method="POST" class=" " 
        action="../includes/admin/flight.inc.php">

        <div class="form-row mb-4">
          <div class="col-md-3 p-0">
            <h5 class="mb-0 form-name">Departure</h5>
          </div>
          <div class="col">           
            <input type="date"style="border-bottom: 2px solid #838383 !important;" name = "source_date" class="form-control"
            required >
          </div>
          <div class="col">         
            <input type="time"style="border-bottom: 2px solid #838383 !important;" name = "source_time" class="form-control"
              required >
          </div>
        </div>


        <div class="form-row mb-4">
        <div class="col-md-3 ">
            <h5 class="form-name mb-0">Arrival</h5>
          </div>          
          <div class="col">
            <input type="date"style="border-bottom: 2px solid #838383 !important;" name = "dest_date" class="form-control"
            required >
          </div>
          <div class="col">
            <input type="time" style="border-bottom: 2px solid #838383 !important;"name = "dest_time" class="form-control"
            required >
          </div>
        </div>

        <div class="form-row mb-4">
        <div class="col-md-3 ">
            <h5 class="form-name mb-0">Date</h5>
          </div>
          <div class="col">                
            <?php
            $sql = 'SELECT * FROM Cities ';
            $stmt = mysqli_stmt_init($conn);
            mysqli_stmt_prepare($stmt,$sql);         
            mysqli_stmt_execute($stmt);          
            $result = mysqli_stmt_get_result($stmt);    
            echo '<select class="mt-4" name="dep_city" style="border: 0px; border-bottom: 
              2px solid #5c5c5c; background-color: white !important;
              font-weight: bold !important;
              width:100%">
              <option selected>From</option>';
            while ($row = mysqli_fetch_assoc($result)) {
								echo "<option value='{$row['city']}'>{$row['city']}</option>";
            }
            ?>
            </select>             
          </div>
          <div class="col">
              <?php
              $sql = 'SELECT * FROM Cities ';
              $stmt = mysqli_stmt_init($conn);
              mysqli_stmt_prepare($stmt,$sql);         
              mysqli_stmt_execute($stmt);          
              $result = mysqli_stmt_get_result($stmt);    
              echo '<select class="mt-4" name="arr_city" style="border: 0px; border-bottom: 
                2px solid #5c5c5c; background-color: whites !important; 
                font-weight: bold !important;
                width:100%">
                <option selected>To</option>';
              while ($row = mysqli_fetch_assoc($result)) {
								echo "<option value='{$row['city']}'>{$row['city']}</option>";
              }
              ?>
              </select>                
          </div>
        </div>

        <div class="form-row mb-4">
          <div class="col">
            <div class="">
                <label for="dura" style="color: black !important; font-size: 19px;">Duration</label>
                <input type="text" name="dura" id="dura" style="border-bottom: 2px solid #838383 !important;"required />
              </div>              
            </div>            
          <div class="col">
            <div class="">
                <label for="price">Price</label>
                <input type="number" style="border-bottom: 2px solid #838383 !important; width:100%" 
                  name="price" id="price"  required />
              </div>            
          </div>
               
        </div>  
        
        <div class="form-row mb-4">
          <div class="col">
            <div class="">
            <?php
          $sql = 'SELECT * FROM Airline ';
          $stmt = mysqli_stmt_init($conn);
          mysqli_stmt_prepare($stmt,$sql);         
          mysqli_stmt_execute($stmt);          
          $result = mysqli_stmt_get_result($stmt);    
          echo '<select class=" mt-4" name="airline_name" style="border: 0px; border-bottom: 
            2px solid #5c5c5c; background-color: white !important;width:90%;margin: 0;
            padding: 0;font-weight: bold !important;">
            <option selected>Select Airline</option>';
          while ($row = mysqli_fetch_assoc($result)) {
            echo '<option value='. $row['airline_id']  .'>'. 
              $row['name'] .'</option>';
          }
        ?>
        </select>      
              </div>              
            </div>            
          <div class="col"style="margin-top:20px">
          <div class="row" >
                <div class="col"><label for="price">Image</label></div>
                <div class="col"><input type="file" style="border-bottom: 0;margin-left:-200px" 
                  name="img" id="img"  required /></div >
              </div>     
          </div>
               
        </div>

        <button name="flight_but" type="submit" 
          class="buton">
          <div style="font-size: 1.5rem;">
          <i class="fa fa-lg fa-arrow-right"></i> Proceed
          </div>
        </button>
      </form>
    </div>
    </div>
</div>
</main>
<script>
$(document).ready(function(){
  $('.input-group input').focus(function(){
    me = $(this) ;
    $("label[for='"+me.attr('id')+"']").addClass("animate-label");
  }) ;
  $('.input-group input').blur(function(){
    me = $(this) ;
    if ( me.val() == ""){
      $("label[for='"+me.attr('id')+"']").removeClass("animate-label");
    }
  }) ;
});
</script>
<?php } ?>

