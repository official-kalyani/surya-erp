<?php require_once('../../auth.php'); ?>
<?php require_once('../../config.php'); ?>
<?php
if(isset($_POST['m_re'])) {
  if(isset($_POST['id']))
  {
  $id_fetch = $_POST['id'];
  // echo $name;
  // echo $id_fetch;

  

$query_fetch = mysqli_query($con,"SELECT * FROM `aset_stock_entry_maintain` WHERE  vechile_id = '$id_fetch'");
$query_fetch_data = mysqli_fetch_object($query_fetch);
}
?>
<div class="row">
<!-- <form name="form" method="post" class="forms-sample" enctype="multipart/form-data" > -->
  <div class="row">
  
        
          <div class="col-lg-3">
          <div class="form-group">

                      <label for="duration">Duration[In Days]:</label>

                            <input type="text" class="form-control" name="duration" id="duration" onkeypress="return validateNumber(event);"  value="<?php if(isset($_POST['id'])){echo $query_fetch_data->duration;}?>" >           
                    </div>
          </div>
            <!-- <div class="col-lg-3">
          <div class="form-group">

                      <label for="days_interval"> Present Reading:</label>

                            <input type="text" class="form-control" name="days_interval" id="days_interval"  >           
                    </div>
          </div> -->

            <div class="col-lg-3">
          <div class="form-group">

                      <label for="km_interval">Duration[In Km]:</label>

                            <input type="text" class="form-control" name="km_interval" id="km_interval" onkeypress="return validateNumber(event);" value="<?php if(isset($_POST['id'])){echo $query_fetch_data->km_interval;}?>" >           
                    </div>
          </div>
           <!-- <div class="col-lg-3">
          <div class="form-group">

                      <label for="present_reading">Present Reading Date:</label>

                            <input type="text" class="form-control" name="present_reading" id="present_reading"  >           
                    </div>
          </div> -->


          
        
        
    </div> 
<!-- </form> -->

  </div>
  <script type="text/javascript">
    
  </script>
<?php } ?>